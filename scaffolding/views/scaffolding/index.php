<p>Welcome to <b>Scaffolding Module</b> v0.3.</p>
<p>If you're new, check <?=html::anchor('scaffolding/manual','Manual');?> section. To start working with your models, check one of them from right menu.</p>

### Important notice  

If you want to use Scaffolding for user management, add the following line to User_Model class:

		protected $_fields=array('_tokens'=>array('hide'=>true,'dont_inspect'=>true));


For explanation read the Manual.

### Changelog

**Version 0.3**

  + Conforms with Kohana ORM conventions
  + Now supports row deletion
  + $belongs_to etc. can be now members of any type, not only protected
  + $_key_field can be now any vald sql expression like count() and so on
  + Pagination
  + Minor bugs fixed
