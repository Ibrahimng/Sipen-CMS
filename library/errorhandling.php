<?php
  /*************************
   * ERROR HANDLING FUNCTIONS
   ************************/
   function exception_handler($exception)
   {
     diagnose_error($exception->getMessage());
     $GLOBALS['error'] = 1;
   }

   set_exception_handler('exception_handler');

	 function debug($message = '')
   {
     $message = preg_replace("/\n/", "<br>", $message);
     display_error($message, 0);
   }

	function display_error($errmsg = '', $fatal = 0)
  {
    $HTMLErrorMessage = "<div class='error'>$errmsg</div>";
    echo $HTMLErrorMessage;
		include_once('footer.php');
  	if ($fatal) exit(1);
  }

   function diagnose_error($errorString)
   {
		 $errorCode = '';
		 $inputField = '';
     $pattern = "/ERROR::([0-9]+)::(.+)/i";
     if (preg_match($pattern, $errorString, $matches))
     {
       $errorCode = $matches[1];
       $inputField = $matches[2];
     }
     else
     {
       $errorCode  = substr(strstr($errorString, 'ERROR::'), 7);
     }
     if (!$errorCode && !$inputField) display_error("$errorString\n");
     if (!$errorCode && $inputField)
       display_error("The field $inputField is required.  Please supply the required information.");
     if ($errorCode == ALPHANUMERIC)
       display_error("The field $inputField only supports alphanumeric characters.<br>
                      These include the numbers 0 through 9 and the letters A through Z
                      (uppercase or lowercase).");
     if ($errorCode == ALPHA)
       display_error("The field $inputField only supports alphabetical characters.<br>\n
                      Please limit your input from A through Z.");
     if ($errorCode == NUMERIC || $errorCode == INTEGER)
       display_error("The field $inputField only supports numbers.  Please do not include
                      whitespace, letters, or symbols.");
     if ($errorCode == ZIP)
       display_error("The field $inputField should be in the format of NNNNN or
                      NNNNN-NNNN where N represents a number.");
     if ($errorCode == PHONE)
       display_error("The field $inputField must be in NPA-NXX-XXXX format.");
     if ($errorCode == EMAIL)
       display_error("The field $inputField should be an email address.  Please be sure you put this in the proper format.");
     if ($errorCode == PASSWORD)
       display_error("The password field must consist of letters and numbers with no spaces
                      or special characters.");
		 if ($errorCode == URL)
			 display_error("Web site links must begin with http:// and be specified in the proper format.");
		 if ($errorCode == PRICE)
			 display_error("The $inputField you entered must be a price and should not contain the dollar sign.");
     if ($errorCode == UNIQUE)
       display_error("The $inputField you selected is already taken.  Please specify a unique $inputField.");
     if ($errorCode == CUSTOM)
			 display_error("The $inputField you selected does not appear to be valid.  Please try a new value for the field.");
   }
   
?>
