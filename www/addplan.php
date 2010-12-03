<?
	include("header.php");
  try
  {
		$plan = new Plan();
		if (!$user->level)
			throw new LoginException("You must be logged in to use this feature.");
		list ($plan->name, $plan->description, $cash, $cents,
          $plan->period,	$plan->hidden, $plan->plancolor)
					= $input->getInputValues('name',
					'description', 'cash', 'cents', 'period', 'hidden', 'plancolor');
		if (!$cents) $cents = "00";
		$plan->price = $cash.".".$cents;
		if ($plan->name[0])
		{
			// Throws InputException on failure
			$plan->validate();
			if ($plan->save())
				flash("The plan was created successfully.");
			else
				throw new Exception("The plan could not be added to the database.");
		}
		include("../views/addplan.php");
	}
	catch (LoginException $e)
	{
		$redirect = "addplan.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (InputException $e)
	{
		include("../views/addplan.php");
		throw($e);
	}
	catch (Exception $e)
	{
		include("../views/addplan.php");
		throw($e);
	}
?>
