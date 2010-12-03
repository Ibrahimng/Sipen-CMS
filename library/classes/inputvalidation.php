<?
	class InputException extends Exception {};

	class InputValidation
	{
		public $fieldName;
		public $customError;
		public $checkType;

		public function alpha($checkValue, $fieldName = '')
		{
			if (!$checkValue) return true;
			$pattern = '/^[A-Z]+$/i';
			if (preg_match($pattern, $checkValue)) return true;
			$this->checkType = " must consist of only letters.";
			$this->throwError($fieldName);
		}

		public function alphanumeric($checkValue, $fieldName = '')
		{
			if (!$checkValue) return true;
			$pattern = '/^[A-Z0-9]+$/i';
			if (preg_match($pattern, $checkValue)) return true;
			$this->checkType = " must consist of only letters and numbers.";
			$this->throwError($fieldName);
		}

		public function boolean($checkValue, $fieldName = '')
		{
			if ($checkValue == 1) return true;
			if ($checkValue === true) return true;
			if (!$checkValue) return true;
			$this->checkType = " must be a boolean value of true or false.";
			$this->throwError($fieldName);
		}

		public function custom($checkValue, $customPattern, $fieldName = '')
		{
			if (!$checkValue) return true;
			if (preg_match($customPattern, $checkValue)) return true;
			$this->throwError($fieldName);
		}

		public function digits($checkValue, $fieldName = '')
		{
			if (!$checkValue) return true;
			$pattern = '/^[0-9]+$/';
			if (preg_match($pattern, $checkValue)) return true;
			$this->checkType = " must be a positive number.";
			$this->throwError($fieldName);
		}

		public function email($checkValue, $fieldName = '')
		{
			if (!$checkValue) return true;
	    $pattern = '/^[a-z0-9_\-=\.]+@[a-z0-9\-\.]+\.[a-z0-9\-\.]+$/i';
  	  if (preg_match($pattern, $checkValue)) return true;
			$this->checkType = " must be a valid email address in the proper format.";
			$this->throwError($fieldName);
		}

	  public function integer($checkValue, $fieldName = '')
  	{
			if (!$checkValue) return true;
			$pattern = '/^[0-9\-]+$/';
			if (preg_match($pattern, $checkValue)) return true;
			$this->checkType = " should be an integer.";
			$this->throwError($fieldName);
	  }

		public function ip($checkValue, $fieldName = '')
		{
			if (!$checkValue) return true;
				$pattern = '/^([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])\\.([01]?\\d\\d?|2[0-4]\\d|25[0-5])$/';
			if (preg_match($pattern, $checkValue)) return true;
			$this->checkType = " is not a valid IP address.";
			$this->throwError($fieldName);
		}

		public function minMax($checkValue, $minimum = 0, $maximum = 0, $fieldName = '')
		{
			if ($minimum) $this->minimum($checkValue, $minimum, $fieldName);
			if ($maximum) $this->maximum($checkValue, $maximum, $fieldName);
			return true;
		}

		public function maximum($checkValue, $maximum, $fieldName = '')
		{
			if (!$checkValue || strlen($checkValue) <= $maximum) return true;
			$this->checkType = " is too long and must consist of fewer than $maximum characters.";
			$this->throwError($fieldName);
		}

		public function minimum($checkValue, $minimum, $fieldName = '')
		{
			if (strlen($checkValue) >= $minimum) return true;
			$this->checkType = " must be at least $minimum character";
			if ($minimum != 1) $this->checkType .= "s";
			$this->checkType .= " in length.";
			$this->throwError($fieldName);
		}

	  public function money($checkValue, $fieldName = '')
  	{
			return $this->numeric($checkValue, $fieldName);
	  }

	  public function negativeInteger($checkValue, $fieldName = '')
  	{
			if (!$checkValue) return true;
			if ($this->integer($checkValue, $fieldName) &&
				$checkValue < 1) return true;
			$this->checkType = " should be a negative integer.";
			$this->throwError($fieldName);
	  }

	  public function numeric($checkValue, $fieldName = '')
  	{
			if (!$checkValue) return true;
			if (preg_match('/^[0-9\.]+$/', $checkValue)) return true;			
			$this->checkType = " should be a number.";
			$this->throwError($fieldName);
	  }

	  public function password($checkValue, $fieldName = '')
  	{
			if (!$checkValue) return true;
			$this->minimum($checkValue, 6, $fieldName);
  	  $pattern = '/^[0-9a-zA-Z!@#\$\%\^\&\*]+$/';
	    if (preg_match($pattern, $checkValue)) return true;
			$this->checkType = " contains invalid characters.";
			$this->throwError($fieldName);
	  }

	  public function phone($checkValue, $fieldName = '')
  	{
			if (!$checkValue) return true;
  	  $pattern = '/^[0-9\- ]+$/';
	    if (preg_match($pattern, $checkValue)) return true;
			$this->checkType = " should be a telephone number without parentheses.";
			$this->throwError($fieldName);
	  }

		public function price($checkValue, $fieldName = '')
		{
			if (!$checkValue) return true;
			return $this->money($checkValue, $fieldName);
		}

	  public function positiveInteger($checkValue, $fieldName = '')
  	{
			if (!$checkValue) return true;
			if ($this->digits($checkValue, $fieldName)) return true;
			$this->checkType = " should be a positive integer.";
			$this->throwError($fieldName);
	  }

		public function required($checkValue, $fieldName = '')
		{
			if ($checkValue) return true;
			$this->checkType = " is required.";
			$this->throwError($fieldName);
		}

	  public function url($checkValue, $fieldName = '')
  	{
			if (!$checkValue) return true;
  	  $pattern = '/^http:\/\/.+\..+$/';
	    if (preg_match($pattern, $checkValue)) return true;
			$this->checkType = " must be a web address starting with <i>http://</i>.";
			$this->throwError($fieldName);
	  }

	  public function zip($checkValue, $fieldName = '')
  	{
			if (!$checkValue) return true;
	    if (preg_match('/^[0-9]{5}$/', $checkValue) ||
  	     preg_match('/^[0-9]{5}\-[0-9]{4}$/', $checkValue)) return true;
			$this->checkType = " should be a zip code in the format of (XXXXX) or (XXXXX-XXXX).";
			$this->throwError($fieldName);
	  }

		private function throwError($fieldName = '')
		{
			if ($fieldName)
				$this->fieldName = $fieldName;
			if ($this->customError)
				throw new inputException($this->customError);
			if (!$this->checkType)
				$this->checkType = " is not in the proper format.";
			throw new inputException("The " . $this->fieldName . " field " . $this->checkType);
		}
	}
?>
