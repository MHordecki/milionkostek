<?php defined('SYSPATH') or die('No direct script access.');
class Stats_Controller extends Controller 
{
	public function index()
	{
		$v=new View('static/stats');
		$this->view['content']=Markdown($v->render());
		$this->renderskel();
	}

	public function ranking()
	{
		$mod=new Category_Model();

		$opts=$mod->getCats();
			
		$form=new Forge(NULL);
		$form->dropdown('category')->options($opts);
		$form->submit('Odśwież');

		$val=0;

		if($form->validate())
			$val=$form->category->value;

		$actual=$mod->getCatsIdFromFormId($val);
		$db=new Database();

		if($actual===false)
		{
			$actual=0;
		$dbqry=$db->from('users')
			->select('username, id, solved')
			->orderby('solved','desc');
		}
		else
		{
		$dbqry=$db->from('users')
			->select('username, users.id, sum(milion_submissions.solved) as solved')
			->join('submissions','submissions.user_id','users.id','left')
			->groupby('milion_users.id')
			->orderby('solved','desc');
			foreach($actual as $cat)
			{
				$dbqry->orwhere('submissions.category_id',$cat);
			}
			$actual=$form->category->value;
		}

				

		$this->view['form']=$form->render('forge_row');
		$this->view['ranking']=$dbqry->get();
		$this->view['actual_cat']=$mod->getNameFromFormId($val);
		$this->renderskel('ranking');
	}

	public function user($id)
	{
		$usr=new User_Model($id);
		if($usr->id==0) url::redirect('/stats/ranking');
		$this->view['user']=$usr;

		$db=new Database();
		// Tu niestety trzeba z łapki SQL bo API Kohany nie obsługuje przecinków w wywołaniu funkcji concat
		$this->view['cats']=$db->query("SELECT concat(cube,' :: ',method) as name, sum(milion_submissions.solved) as solved FROM milion_categorys LEFT JOIN milion_submissions ON milion_submissions.category_id=milion_categorys.id WHERE milion_submissions.user_id=? GROUP BY name",array($usr->id));
			
		$this->renderskel('user');
	}

	protected function finish_chart($flot,$vals,$twovals,$titles,$startsum)
	{
		$c=new Flot('chart',array('style'=>'height:400px;width:800px;'));
		$dt=new Flot_Dataset();
		$dt2=new Flot_Dataset();
	
		$i=0;
		$sum=$startsum;
		foreach($vals as $k)
		{
			if($twovals)
				$xaxis[]=array($i,$k->valone.'-'.$k->valtwo);
			else
				$xaxis[]=array($i,$k->valone);

			if($sum!==false)
			{
				$sum+=(int)$k->value;
				$dt->add($i+1,$sum);

			}
			$dt2->add($i,(int)$k->value);
				
			$i++;
		}

		
		$c->set('xaxis',array('ticks'=>$xaxis));
		$c->set('legend',array('position'=>'nw'));

		$dt->lines=array('show'=>'true');
		$dt->points=array('show'=>'true');
		$dt2->bars=array('show'=>'true');

		if($startsum!==false)
			$c->add($dt,$titles['sum']);
		$c->add($dt2,$titles['period']);

		$this->view['chart']=$c->render();
		if(!array_key_exists('back',$this->view))
			$this->view['back']='/stats/';
		//$this->view['title']=$titles['title'];
		$v = new View('chart',$this->view);
		echo $v->render();
	}

	protected function getMonthList()
	{
		static $cache=false;
		if($cache) return $cache;		

		$starty=2008;
		$startm=9;
		$endy=(int) strftime('%Y');
		$endm=(int) strftime('%m');
		for($y=$starty;$y<=$endy;$y++)
		{
			$start=($y==$starty) ? $startm : 1;
			$end=($y==$endy) ? $endm : 12;

			for($m=$start;$m<=$end;$m++)
			{
				$ret[]=$y.'-'.$m;
			}
		}
		return $cache=$ret;
		 
	}

	protected function correct_vals($vals,$detailed=false)
	{
		$ret=array();

		if($detailed)
		{
			foreach(range(0,31) as $day)
			{
				$tmp=new stdClass();
				$tmp->valone=$day;
				$tmp->value=0;
				$ret[$day]=$tmp;
			}

			foreach($vals as $val)
			{
				$ret[$val->valone]->value=$val->value;
			}
		} else
		{
			foreach($this->getMonthList() as $year)
			{
				$tmp=new stdClass();
				$tmp->valone=substr($year,0,strpos($year,'-'));
				$tmp->valtwo=substr($year,strpos($year,'-')+1);
				$tmp->value=0;
				$ret[$year]=$tmp;
			}

			foreach($vals as $val)
			{
				$ret[$val->valone.'-'.$val->valtwo]->value=$val->value;
			}

		}

		return $ret;
		
	}

	public function chart_score_monthly()
	{
		$this->chart_score(false);
	}

	public function chart_score($sum=true,$userid=false)
	{
		$mod=new Category_Model();
		
		$form=new Forge(NULL);
		$form->dropdown('period')->options(array_merge(array('Ogólnie'),$this->getMonthList()));
		$form->dropdown('category')->options($mod->getCats());
		$form->submit('Wyślij');

		$db=new Database();
		$qry=new Query($db);

		$qry->from('submissions');
		$qry->select(array('year(created)'=>'valone','month(created)'=>'valtwo','sum(solved)'=>'value'));	
		$qry->groupby('date_format(created,\'%c-%Y\')');
		$qry->orderby(array('valone','valtwo'));


		$detailed=false;

		if($form->validate())
		{
			if($form->period->value!='0')
			{
				$month=$this->getMonthList();
				$month=$month[$form->period->value-1];

				$qry->reset();
				$qry->from('submissions');
				$qry->select(array('day(created)'=>'valone','sum(solved)' =>'value'));
				$qry->groupby('day(created)');
				$qry->orderby('valone');

				$qry->where('year(created)',substr($month,0,strpos($month,'-')));
				$qry->where('month(created)',substr($month,strpos($month,'-')+1));

				$detailed=true;

			}
			$cats=$mod->getCatsIdFromFormId($form->category->value);
			if($cats)
			{
				$or=new Query_Condition($db,'or');
				foreach($cats as $cat)
				{
					$or->add('milion_submissions.category_id',$cat);
				}
				$qry->where($or);
			}
		}

		if($userid!==false)
			$qry->where('user_id',$userid);
		$vals=$db->query($qry->query());

		$vals=$this->correct_vals($vals,$detailed);

		$this->view['form']=$form->render('forge_row');

		$flot=new Flot('chart',array('style'=>'height:400px;width:800px;'));
		$this->finish_chart($flot,$vals,!$detailed,array('title'=>false,'period'=>'Ułożeń w miesiącu','sum'=>'Wynik'),$sum ? 0:false);

	}
	public function chart_user_score($userid)
	{
		$usr=new User_Model($userid);
		if($usr->id==0) url::redirect('/stats/');
		$this->view['title']='Wykres użytkownika '.$usr->username;
		$this->view['back']='/stats/user/'.$userid;

		$this->chart_score(true,$userid);
	}


}
?>
