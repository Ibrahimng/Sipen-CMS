<?
	$form = new Form();
	$form->attributes = "name='createform' id='createform'";
?>

<div id="mainpage">
	<? $form->start(); ?>
	<h1>Create Plan Variable</h1>
	<table border='0'>
		<tr>
			<td>
				<? $form->label('name', "Name: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='64' size='20'"; ?>
				<? $form->element('name', 'text', $planVariable->name); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('planid', "Link To Plan: "); ?>
			</td>
			<td>
				<?
					$totalPlans = count($plans->id);
					if ($totalPlans)
					{
						$form->attributes = "size='5'";
						$form->startSelect('planid', 'planid', true);
						for ($i = 0; $i < $totalPlans; $i++)
						{
							$form->addSelectOption($plans->id[$i], $plans->name[$i]);
						}
						$form->endSelect();
					}
					else
					{
						echo "There are no visible plans in the database.\n";
					}
				?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('description', "Description: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='250' size='35'";
					$form->element('description', 'text', $planVariable->description);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?
					$form->label('defaultvalue', "Default Value: ", "slabel");
				?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='32' size='25'";
					$form->element('defaultvalue', 'text', $planVariable->defaultvalue);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?
					$form->label('validation', "Validation Type: ", "slabel");
				?>
			</td>
			<td>
				<?
					$validationTypes = array("username", "text", "password", "digits");						
					$form->startSelect('validation', 'validation', false);
					foreach ($validationTypes as $vt)
					{
						$isDefault = false;
						if ($vt == $planVariable->validation)
							$isDefault = true;
						$form->addSelectOption($vt, $vt, $isDefault);
					}
					$form->endSelect();
				?><br>
				<?
					if ($planValidation->required)
						$form->attributes = "checked";
					$form->element('required', 'checkbox', '1');
					$form->label('required', "Required Field?");
				?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<?
					$form->attributes = "class='sbutton'";
					$form->element('submitButton', 'submit', 'Add Variable');
				?>
			</td>
		</tr>
	</table>
	<? $form->end(); ?>
</div>
