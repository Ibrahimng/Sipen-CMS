<?
	$form = new Form();
?>

<div id="mainpage">
	<? $form->start(); ?>
	<table border='0'>
		<tr>
			<td colspan='2'>
				<font size='+1' color='#0000cc'>
					<b>Company Information</b><br><br>
				</font>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('name', "Name: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='15'"; ?>
				<? $form->element('name', 'text', $company->name); ?>
			</td>
		</tr>
			<td>
				<? $form->label('address', "Address: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='25'"; ?>
				<? $form->element('address', 'text', $company->address); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('city', "City: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='32' size='20'";
					$form->element('city', 'text', $company->city);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('state', "State: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='32' size='6'";
					$form->element('state', 'text', $company->state);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('zip', "Zip Code: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='14' size='6'";
					$form->element('zip', 'text', $company->zip);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('phone', "Telephone: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='15' size='12'";
					$form->element('phone', 'text', $company->phone);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('logo', "Logo URL: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='250' size='30'";
					$form->element('logo', 'text', $company->logo);
				?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<?
					$form->attributes = "class='sbutton'";
					$form->element('submitButton', 'submit', 'Update Company');
				?>
			</td>
		</tr>
	</table>
	<? $form->end(); ?>
</div>
