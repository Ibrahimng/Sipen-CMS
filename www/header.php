<?
  /***** INITIALIZE SESSION *****/
  if (!session_id())
  {
    session_start();
    $session = session_id();
  }
  header("Cache-control: private");
	// Load the configuration settings
	require("../config.settings.php");
  require("../library/db.php");
  // Activate the database
  useDatabase($database_username, $database_password, $database_host, $database_name);
  require("../library/commonfunctions.php");
	/* The settings, inputs, and users are used by all parts of the system */
	$setting = new Setting();
	$input = new Input();
	$user = new User();
	$user->loadSession();
	$hideheader = $_REQUEST['hideheader'];
?>
<html>
  <head>
    <meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css/sipen.css">
    <? include("includes/javascript.php"); ?>
  </head>
<? if ($user->level < 1) $hideheader = 1; ?>
<? if (!$hideheader) { ?>
  <body leftmargin="0" topmargin="0" style="margin-left:0; margin-top:0">

  <div id="siteheader">
		<div id="headerimage">
			<a href="/"><img border="0" src="images/sipenlogo.gif" width="162" height="32"></a>
			<br><b>CMS</b>
		</div>

		<div id="headerlinks">
				<span class='accountlinks'>
					<a href='customersearch.php'>Customer Search</a>
					*
					<a href='addcustomer.php'>Add Customer</a>
					*
					<a href='myaccount.php'>My Account</a>
					<? if ($user->level > 1) { ?>
						*
						<a href='administration.php'>Administration</a>
					<? } ?>
					*
					<a href='login.php?logout=true'>Log Out</a>
	      </span>
		</div>
  </div>
	<div id="leftarea">

	</div>
<? } ?>
