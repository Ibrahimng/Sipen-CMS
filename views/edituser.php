<?
	$form = new Form();
	$form->attributes = "name='userform' id='userform'";
?>

<div id="mainpage">
	<? $form->start(); ?>
	<h1>Edit User Account: <? echo $currentuser->firstname . " " . $currentuser->lastname; ?></h1>
	<table border='0'>
		<tr>
			<td>
				<? $form->element('id', 'hidden', $currentuser->id); ?>
				<? $form->label('firstname', "First Name: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='15'"; ?>
				<? $form->element('firstname', 'text', $currentuser->firstname); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('lastname', "Last Name: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='15'"; ?>
				<? $form->element('lastname', 'text', $currentuser->lastname); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('phone', "Telephone: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='16' size='15'"; ?>
				<? $form->element('phone', 'text', $currentuser->phone); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('email', "Email: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='128' size='25'"; ?>
				<? $form->element('email', 'text', $currentuser->email); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('address', "Address: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='15'"; ?>
				<? $form->element('address', 'text', $currentuser->address); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('city', "City: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='15'"; ?>
				<? $form->element('city', 'text', $currentuser->city); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('state', "State: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='15'"; ?>
				<? $form->element('state', 'text', $currentuser->state); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('zip', "Zip Code: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='16' size='10'"; ?>
				<? $form->element('zip', 'text', $currentuser->zip); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('username', "Username: "); ?>
			</td>
			<td>
				<b><? echo $currentuser->username; ?></b>
			</td>
		</tr>
		<tr>
			<td>
				<?
					$form->label('newpassword', "Password: ", "slabel");
				?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='32' size='25'";
					$form->element('newpassword', 'password');
				?>(Blank: Unchanged)
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<?
					$form->attributes = "class='sbutton'";
					$form->element('submitButton', 'submit', 'Update');
				?>
			</td>
		</tr>
	</table>
	<? $form->end(); ?>
</div>
