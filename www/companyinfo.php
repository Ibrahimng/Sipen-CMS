<?
	include("header.php");
	$company = new Company();
  try
  {
		if (!$user->level)
			throw new LoginException("You must be logged in to use this feature.");
		if ($user->level < 2)
			throw new LoginException("You do not have permission to use this feature.  Please log into the Administrator account.");
		list ($company->name, $company->address, $company->city,
			$company->state, $company->zip, $company->phone, $company->logo)
		= $input->getInputValues('name', 'address', 'city', 'state', 'zip',
			'phone', 'logo');
		$id = $company->exists();
		if ($id) $company->id = $id;
		if ($company->name)
		{
			$company->validate();
			if ($company->save())
				flash("Company Information Updated");
			else
				throw new Exception("Could Not Save To Database.");
		}
		else
		{
			if ($id) $company->load($id);
		}
		include("../views/companyinfo.php");
	}
	catch (LoginException $e)
	{
		$redirect = "companyinfo.php";
		include("../views/login.php");
		throw ($e);
	}
	catch (InputException $e)
	{
		include("../views/companyinfo.php");
		throw($e);
	}
	catch (Exception $e)
	{
		include("../views/companyinfo.php");
		throw($e);
	}
?>
