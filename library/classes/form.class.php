<?
  class Form
  {
		public $action;
		public $method;
		public $attributes;

		public function start($action = '', $method = '')
		{
			if ($action) $this->action = $action;
			if ($method) $this->method = $method;
			if (!$this->action) $this->action = $_SERVER['PHP_SELF'];
			if (!$this->method) $this->method = "POST";
			echo "<form action='".$this->action."' method='".$this->method."'";
			if ($this->attributes) echo " ".$this->attributes;
			echo ">\n";
			$this->attributes = '';
		}

		public function end()
		{
			echo "</form>\n";
			$this->attributes = '';
		}

		public function label($id, $text, $class = '')
		{
			echo "<label for='$id' class='$class'>$text</label>";
		}

		public function element($name = '', $type = 'text', $value = '', $id = '')
		{
			if ($name && !$id) $id = $name;
			if ($type == 'text' || $type == 'textbox' || $type == 'button'
				|| $type == 'submit' || $type == 'password'
				|| $type == 'image' || $type == 'hidden' || $type == 'checkbox'
				|| $type == 'reset' || $type == 'radio')
			{
				echo "<input type='$type' id='$id' name='$name' value='$value'";
				if ($this->attributes) echo " ".$this->attributes;
				echo ">\n";
			}
			if ($type == 'textarea')
			{
				echo "<textarea name='$name'";
				if ($this->attributes) echo " ".$this->attributes;
				echo ">$value</textarea>\n";
			}
			$this->attributes = '';
		}

		public function startSelect($name, $id = '', $multi = false)
		{
			if (!$id) $id = $name;
			echo "<select name='$name' id='$id'";
			if ($multi) echo " multiple";
			if ($this->attributes) echo " ".$this->attributes;
			echo ">\n";
			$this->attributes = '';
		}

		public function addSelectOption($value, $option = '', $bDefault = false)
		{
			echo "  <option value='$value'";
			if ($bDefault) echo " selected='selected'";
			if ($this->attributes) echo " ".$this->attributes;
			echo ">$option</option>\n";
			$this->attributes = '';
		}

		public function endSelect()
		{
			echo "</select>\n";
		}
  }
?>
