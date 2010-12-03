<?
	/* This file contains all functions that are used throughout the program by almost
		every script.
	*/
  // Constants to be used elsewhere
  // These are used for the getInputValues function return type
  define("ANY", 0);
  define("REQUIRED", 1); // Flag indicating the field is required
  define("UNIQUE", 2);
  define("ALPHANUMERIC", 4);
  define("ALPHA", 8);
  define("NUMERIC", 16);
  define("INTEGER", 32);
  define("ZIP", 64);
  define("EMAIL", 128);
  define("PASSWORD", 256);
  define("BOOLEAN", 512);
  define("PHONE", 1024);
  define("URL", 2048);
  define("CUSTOM", 4096);
  define("PRICE", 8192);

  require('errorhandling.php');
  require('classes/inflect.class.php');
  require('classes/databaseObject.class.php');
  require('classes/setting.class.php');
  require('classes/planvariable.class.php');
  require('classes/customervariable.class.php');
  require('classes/form.class.php');
  require('classes/user.class.php');
  require('classes/plan.class.php');
  require('classes/customerplan.class.php');
  require('classes/customer.class.php');
  require('classes/company.class.php');
  require('classes/log.class.php');

  require('classes/inputvalidation.php');
  require('classes/input.php');

	// Redirects to a specific page using JavaScript
  function redirect($URL)
  {
    echo "<script language='javascript'>location = '$URL';</script>\n";
  }

	// Define the flash class through CSS for the position of important status
	// messages
  function flash($message)
  {
    echo "<div class='flash'>$message</div>\n";
  }
?>
