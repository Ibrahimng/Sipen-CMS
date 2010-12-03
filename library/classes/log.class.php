<?
  class Log extends DatabaseObject
  {
    public function __construct()
    {
      // This is required or this constructor will override the
      // database object
      parent::__construct();
		}

		public function insert()
		{
			// Override to get IP
			$this->save();
		}

		public function update()
		{
			// Updating existing logs is not permitted so we override this
			// with an insert instead.
			$this->save();
		}

		public function save()
		{
			$this->ip = $_SERVER['REMOTE_ADDR'];
			parent::insert();
		}
  }
?>
