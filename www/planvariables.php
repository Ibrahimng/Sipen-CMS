<?
	include("header.php");
	$planVariable = new PlanVariable();
	$updateVars = new PlanVariable();
  try
  {
		if (!$user->level)
			throw new LoginException("You must be logged in to use this feature.");
		if ($user->level < 2)
			throw new LoginException("You do not have permission to use this feature.  Please log into the Administrator account.");
		list ($delete) = $input->getInputValues('delete');
		$updateVars->name = $_POST['name'];
		$updateVars->id = $_POST['id'];
		$updateVars->defaultvalue = $_POST['defaultvalue'];
		$updateVars->description = $_POST['description'];
		$updateVars->required = $_POST['required'];
		if ($delete)
		{
			$input->digits($delete, 'Deletion ID of Variable');
			if ($planVariable->delete($delete))
				flash("Plan Variable (".$delete.") Deleted Successfully");
			else
				throw new Exception("The specified variable could not be removed.");
		}
		if (is_array($updateVars->id) && $updateVars->id[0])
		{
			$updateVars->validate();
			$updateVars->save_all();
		}
		$planVariable->load_all();
		include("../views/planvariables.php");
	}
	catch (LoginException $e)
	{
		$redirect = "welcome.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (InputException $e)
	{
		include("../views/planvariables.php");
		throw($e);
	}
	catch (Exception $e)
	{
		include("../views/planvariables.php");
		throw($e);
	}
?>
