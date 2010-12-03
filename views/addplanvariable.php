<?
	$form = new Form();
?>

<div id="mainpage">
	<? $form->start(); ?>
	<table border='0'>
		<tr>
			<td colspan='2'>
				<font size='+1' color='#0000cc'>
					<b>Add Plan Variable</b><br><br>
				</font>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('name', "Variable Name: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='10'"; ?>
				<? $form->element('name', 'text', $planVariable->name); ?>
			</td>
		</tr>
			<td>
				<? $form->label('description', "Last Name: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='64' size='30'"; ?>
				<? $form->element('description', 'text', $planVariable->description); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('validation', "Validation: "); ?>
			</td>
			<td>
				<?
					$form->attributes = "maxlength='64' size='20'";
					$form->startSelect('validation');
					$validations = array('alpha', 'alphanumeric');
					foreach ($validations as $var)
					{
						if ($planVariable->validation == $var)
							$makeDefault = true;
						else
							$makeDefault = false;
						addSelectOption($var, $var, $makeDefault);
					}
					$form->endSelect();
				?>
			</td>
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
