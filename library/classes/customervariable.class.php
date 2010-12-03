<?
  class CustomerVariable extends DatabaseObject
  {
    public function __construct()
    {
      // This is required or this constructor will override the
      // database object
      parent::__construct();
    }
	}
?>
