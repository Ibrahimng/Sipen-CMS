<?
	include("header.php");
	$plan = new Plan();
	$updatePlans = new Plan();
  try
  {
		if (!$user->level)
			throw new LoginException("You must be logged in to use this feature.");
		if ($user->level < 2)
			throw new LoginException("You do not have permission to use this feature.  Please log into the Administrator account.");
		list ($delete) = $input->getInputValues('delete');
		$updatePlans->name = $_POST['name'];
		$updatePlans->id = $_POST['id'];
		$updatePlans->price = $_POST['price'];
		$updatePlans->description = $_POST['description'];
		$updatePlans->period = $_POST['period'];
		$updatePlans->hidden = $_POST['hidden'];
		if ($delete)
		{
			$input->digits($delete, 'Deletion ID of Variable');
			if ($plan->delete($delete))
				flash("Plan (".$delete.") Deleted Successfully");
			else
				throw new Exception("The specified plan could not be removed.");
		}
		if (is_array($updatePlans->id) && $updatePlans->id[0])
		{
			$updatePlans->validate();
			$updatePlans->save_all();
		}
		$plan->load_all();
		include("../views/manageplans.php");
	}
	catch (LoginException $e)
	{
		$redirect = "welcome.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (InputException $e)
	{
		include("../views/manageplans.php");
		throw($e);
	}
	catch (Exception $e)
	{
		include("../views/manageplans.php");
		throw($e);
	}
?>
