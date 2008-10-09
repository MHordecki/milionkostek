# Scaffolding manual

## Table of contents:

1. Introduction  
	1.1. Warning  
	1.2. Requirements  
2. Scaffolding Quickstart  
3. Additional model parameters  
	3.1  $_key_field  
	3.2  $_fields  


# 1. Introduction

First, thanks you for using Scaffolding Module. Interface you're using now is only a mere fronted to more sophiscated Scaffolding library, designed to aid developers in creating admin panels for their models. Making admin panel is tedious work, yet done for every project which uses some kind of database. Scaffolding follows DRY principle - one generic class parses Model and ORM classes, gathers metadata from database and presents it in human-appealing form, providing all CRUD methods. Whatsoever, Scaffolding understands object relationships and facilities in managing them.

Scaffolding Module was inspired by Django Admin Panel, which itself is great and polished application.

## 1.1 Warning  

Scaffolding is still unstable software, and therefore can crash your server, destroy your data and/or burn your house. You have been warned. 

## 1.2 Requirements

+  Working Kohana version (preferably 2.1+, tested on fresh SVN copy as of 2008.03.20)  
+  MySQL Database (you may try using it on others, but you'll probably have to edit Model_Inspector::get_metadata() method)
+  (optional) Markdown library (distributed with Kohana) - Manual beautyfying  

# Scaffolding Quickstart

Ok, so now we'll see how put scaffolding in your controllers.

Assume standard Auth module is turned on, and we want to create management page for roles. Here goes the two-liner:

		$s=new Scaffolding(new Role_Model());
		echo $s->scaffold(func_get_args());

Or even oneliner:

		echo new Scaffolding(new Role_Model())->scaffold(func_get_args());

You're done! Scaffold library will manage parameter list, create menu etc. You'll probably want to package it in some nested template. Just treat scaffold() output as ordinary string and pass it to your View.

In order to being parsable by Scaffolding library, your model must meet special conditions:

+  Table names are plural e.g. users
+  Model names are the singular of the table name(user) with suffix '_Model'. They are also capitalized. So table 'users' correspond to model 'User_Model'
+  Each table has a primary key 'id' (except for join tables)
+  Foreign keys in a table are in the form of {related}_id e.g. user_id, book_id
+  Relationship 'has and belongs to many' need a special table, called join table. It's name is {table1}_{table2} and it's got two foreign keys to both of joined tables.
+ **(changed)** Plural/Singular form is made with aid of inflector helper. Beware of table called 'news', you will end up with model called New_Model.
+	Object relationships are placed as a <del>protected</del> attributes of models (of any visibility, i.e. both protected and private will be recognized), namely:

		+  $has_many (plural)
		+  $belongs_to (singular)
		+  $has_and_belongs_to_many (plural)

	They should be arrays of table names which they point to. Word in parentheses hints in which number they should be typed.  
		**Example**  
		$has_many=array('posts','tokens');  
		$belongs_to=array('user');  
		$has_and_belongs_to_many=array('tags','roles');  

As you can see, they mostly resemble standard Kohana ORM guidelines.

### Important notice  

One of Auth models, User_Token_Model, has weird database table name(tokens instead of user_tokens). This model is ignored by web interface in models list, but not when it comes to relationships with different models. Therefore, when you lanch User_Model management, you will get and database error. To solve that, add the following line to User_Model class definition:

		protected $_fields=array('_tokens'=>array('hide'=>true,'dont_inspect'=>true));

For explanation, see the next section.

# 3. Additional model parameters

When viewing your table, you would probably want to customize column names of your models. What's more, who wants to view password hashes in users list? Scaffold also aids that.

Scaffolding library, apart of $has_many etc. also gathers special *protected* attributes from Model class.

## 3.1 $_key_field

Value: Database table field name of key field.

When editing Models with $belongs_to relationship, Scaffolding creates a dropdown list. Unfortunately, it's usually populated with id's of certain objects. When you specify $_key_field, Scaffolding will use them instead of id field.

### Example

Assume we've got Post_Model:
	class Post_Model extends Model
	{
	...
		protected $belongs_to=array('user');
	...
	}

When edited, dropdown will usually dropdown users' id fields, like:

	-----
	| 1 |
	-----
	| 2 |
	-----
	| 3 |
	-----

However, if you add following line to User_Model

	class User_Model extends ORM
	{
	...
		protected $_key_field='username';
	...
	}

In edit page, ugly dropdown will change to:

	---------
	| Mike  |
	---------
	| Peter |
	---------
	| Bob   |
	---------

Key field as a sql expression

	class User_Model extends ORM
	{
	...
		protected $_key_field="concat(users.firstname, ' ', users.surname)";
	...
	}

## 3.2 $_fields

This attribute affects single fields. It's associative array with field names as keys and associative arrays of options as values.

>  **Important notice**  
	
>  For $has_many and $has_and_belongs_to_many, Scaffolding creates dummy fields '_{tablename}', which resemble relationships and can be used in $_fields.

Following options are supported:

+  'hide' - hide from management list
+  'dont_inspect' - (for relationships) - don't handle this relationship
+  'hide_edit' - hide from edit page
+  'save' - PHP callback. It's launched when value is saved to database, with this value as one and only parameter.

### Example

To bypass User_Token_Model flaw (non-standard compliant database table naming), hide password field from management list and to enable password changing, use the following:

	class User_Model extends ORM
	{		
		...
		protected $_key_field='username';
		protected $_fields=array(
			'_tokens'=>array('hide'=>true,'dont_inspect'=>true),
			'password'=>array('hide'=>true)
			);
		
		function __construct()
		{
			...
			$this->_fields['password']['save']=array(Kohana::instance()->auth,'hash_password');
		}
	}

PHP callback to hash_password() needs to be defined in constructor because of PHP syntax.

With this, you'll see hash in user edit page, but when you change it, Scaffolding will hash it and put correct value to the database.

