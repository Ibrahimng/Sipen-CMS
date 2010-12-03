<?
	/* Any class that extends to the DatabaseObject class will inherit the ability
		to reference database columns as variables using $class->columnName syntax.
		The class name should be singular.  Inflect() is used to pluralize the class
		name.  The table name should be plural.  So, the User class will have a users
		table.

		All tables must have a primary_key of 'id' that is used as a reference by this class.

		A DBException is thrown by this class whenever a catastrophic failure happens.
	*/
	class DBException extends Exception {};

  abstract class DatabaseObject
  {
		private $_table;
		public $_columns = array();
		private $_data = array();
		public $orderby;
		public $limit;

		public function __construct()
		{
			// Use a plural name for the database
			$this->_table = get_class($this);
			$inflect = new Inflect();
			$this->_table = strtolower($inflect->pluralize($this->_table));
			$this->loadTableColumns();
		}

		public function & __get($name)
		{
			if (!array_key_exists($name, $this->_data))
				$this->_data[$name] = NULL;
			return $this->_data[$name];
		}

		public function __isset($name)
		{
			return isset($this->_data[$name]);
		}

		public function __unset($name)
		{
			unset($this->_data[$name]);
		}

    public function __set($name, $value)
		{
   		$this->_data[$name] = $value;
    }

		public function delete($id)
		{
			$sql = "DELETE FROM ".$this->_table." WHERE `id` = '".esc($id)."'";
			database($sql);
			return true;
		}

    public function insert()
    {
			$values = '';
			$fields = '';
			$this->created_at = date("Y-m-d H:i:s");
      foreach ($this->_columns as $column)
			{
				if ($column != "id")
				{
					$values .= "'".esc($this->$column)."',";
					$fields .= ", ".$column;
				}
			}
			$values = rtrim($values, ',');
			$fields = ltrim($fields, ',');
      $sql = "INSERT INTO ".$this->_table." (".$fields.") VALUES ($values)";
			database($sql);
			$this->id = mysql_insert_id();
			return $this->id;
    }

		public function reset()
		{
			$this->_data = array();
			return true;
		}

		public function save()
		{
			if ($this->id)
				return $this->update();
			else
				return $this->insert();
		}

		public function save_all()
		{
			if (is_array($this->id))
				$totalIDs = count($this->id);
			if ($totalIDs)
			{
				for ($i = 0; $i < $totalIDs; $i++)
				{
					$this->update_element($i);
				}
			}
		}

		public function update_element($i = 0)
		{
			if (!$this->id[$i]) return false;
			$insert = '';
			if (is_array($this->updated_at))
				$this->updated_at[$i] = date("Y-m-d H:i:s");
			foreach ($this->_columns as $column)
			{
				if ($column != "id")
				{
					if (isset($this->{$column}[$i]))
						$insert .= "`".esc($column)."`='".esc($this->{$column}[$i])."',";
				}
			}	
			$insert = rtrim($insert, ',');
			$sql = "UPDATE ".$this->_table." SET ".$insert." WHERE id = '".$this->id[$i]."'";
			database($sql);
			return $this->id[$i];
		}

		public function update()
		{
			if (!$this->id) return false;
			$insert = '';
      $this->updated_at = date("Y-m-d H:i:s");
			foreach ($this->_columns as $column)
			{
				if ($column != "id")
				{
					if (isset($this->$column))
						$insert .= "`".esc($column)."`='".esc($this->$column)."',";
				}
			}
			$insert = rtrim($insert, ',');
			$sql = "UPDATE ".$this->_table." SET ".$insert." WHERE id = '".$this->id."'";
			database($sql);
			return $this->id;
		}

		public function exists($id = '')
		{
			$sql = "SELECT id FROM ".$this->_table;
			if ($id)
				$sql .= " WHERE id = '".esc($id)."'";
			$sql .= " LIMIT 1";
			$sqlResult = database($sql);
			if ($sqlResult && mysql_num_rows($sqlResult))
			{
				$row = mysql_fetch_row($sqlResult);
				$id = $row[0];
				mysql_free_result($sqlResult);
				return $row[0];
			}
			else
			{
				return false;
			}
		}

		public function find($variableArgumentList)
		{
			if (!func_num_args())
				return false;
			$arguments = func_get_args();
			$arguments = array_intersect($arguments, $this->_columns);
			$sql = "SELECT * FROM ".$this->_table." WHERE ";
			foreach ($arguments as $arg => $val)
			{
				$sql .= "`".esc($val)."` = '".esc($this->$val)."' AND ";
			}
			$sql = rtrim($sql, ' AND ');
			return $this->loadVariables($sql);
		}

		public function find_all($variableArgumentList)
		{
			if (!func_num_args())
				return false;
			$arguments = func_get_args();
			$arguments = array_intersect($arguments, $this->_columns);
			$this->convertToArrays();
			$sql = "SELECT * FROM ".$this->_table." WHERE ";
			foreach ($arguments as $arg => $val)
			{
				$sql .= "`".esc($val)."` = '".esc($this->$val)."' AND ";
			}
			$sql = rtrim($sql, ' AND ');
			return $this->loadVariables($sql);
		}

		public function isUnique($variableArgumentList)
		{
			if (!func_num_args())
				return false;
			$arguments = func_get_args();
			$arguments = array_intersect($arguments, $this->_columns);
			$sql = "SELECT * FROM ".$this->_table." WHERE ";
			foreach ($arguments as $arg => $val)
			{
				$sql .= "`".esc($val)."` = '".esc($this->$val)."' AND ";
			}
			$sql = rtrim($sql, ' AND ');
      $sqlResult = database($sql);
			// If something is found, the result is not unique
      if ($sqlResult && mysql_num_rows($sqlResult))
				return false;
			else
				return true;
		}

    public function load($id)
    {
      if (!$id) return false;
      $sql = "SELECT * FROM ".$this->_table." WHERE id = '".esc($id)."'";
			return $this->loadVariables($sql);
    }

		public function load_all()
		{
			$this->convertToArrays();
			$sql = "SELECT * FROM ".$this->_table;
			return $this->loadVariables($sql);
		}

		// Syntax: sql("SELECT * FROM customers WHERE username = ? AND
		// phone = ?", $username, $telephone);
		public function sql($variableArgumentList)
		{
			$argnum = func_num_args();
			if (!$argnum) return false;
			$arguments = func_get_args();
			$sql = $arguments[0]; // First argument is the SQL statement
			if ($argnum > 1)
			{
				for ($i = 1; $i < $argnum; $i++)
				{
					$sql = preg_replace('/\?/', "'".esc($arguments[$i])."'", $sql, 1);
				}
			}
			if (!$sql) return false;
			$this->convertToArrays();
			return $this->loadVariables($sql);
		}

		private function convertToArrays()
		{
			foreach ($this->_columns as $var)
				$this->$var = array();
			return true;
		}

		private function loadVariables($sql)
		{
			if ($this->orderby) $sql .= " ORDER BY ".esc($this->orderby);
			if ($this->limit) $sql .= " LIMIT ".esc($this->limit);
      $sqlResult = database($sql);
			if ($sqlResult && mysql_num_rows($sqlResult))
			{
				while ($r = mysql_fetch_assoc($sqlResult))
				{
					foreach ($this->_columns as $var)
					{
						if (is_array($this->$var))
							array_push($this->{$var}, $r["$var"]);
						else
							$this->$var = $r["$var"];
					}
				}
				mysql_free_result($sqlResult);
				return true;
			}
			return false;
		}

		private function loadTableColumns()
		{
			// Gets the columns from the table that corresponds to the class
			if (!$this->_table) return;
			$sql = "SHOW COLUMNS FROM " . esc($this->_table);
			$sqlResult = database($sql);
			if ($sqlResult)
			{
				while ($r = mysql_fetch_assoc($sqlResult))
				{
					$this->_columns[] = $r['Field'];
				}
				mysql_free_result($sqlResult);
			}
		}
	}
?>
