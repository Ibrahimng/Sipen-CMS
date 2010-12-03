<?
	include("header.php");
	$planVariable = new PlanVariable();
	$plans = new Plan();
  try
  {
		if (!$user->level)
			throw new LoginException("You must be logged in to use this feature.");
		if ($user->level < 2)
			throw new LoginException("You do not have permission to use this feature.  Please log into the Administrator account.");
		list ($planVariable->name, $planVariable->planid,
			$planVariable->validation, $planVariable->required,
			$planVariable->description, $planVariable->defaultvalue)
			= $input->getInputValues('name', 'planid', 'validation', 'required',
			'description', 'defaultvalue');
		if ($planVariable->required) $planVariable->required = 1;
		// Load plans for the select box
		$plans->hidden = 0;
		$plans->find_all('hidden');
		if ($planVariable->name)
		{
			$planVariable->validate();
			$planVariable->save();
			flash("New Variable Created.");
			include("../views/createplanvariable.php");
			redirect("planvariables.php");
		}
		else
		{
			include("../views/createplanvariable.php");
		}
	}
	catch (LoginException $e)
	{
		$redirect = "welcome.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (InputException $e)
	{
		include("../views/createplanvariable.php");
		throw($e);
	}
	catch (Exception $e)
	{
		include("../views/createplanvariable.php");
		throw($e);
	}
?>
