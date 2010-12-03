<?
	$form = new Form();
?>

<div id="mainpage">
	<? $form->start(); ?>
	<table border='0'>
		<tr>
			<td colspan='2'>
				<font size='+1' color='#0000cc'>
					<b>Add Plan</b><br><br>
				</font>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('name', "Plan Name: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='32' size='15'"; ?>
				<? $form->element('name', 'text', $plan->name); ?>
			</td>
		</tr>
			<td>
				<? $form->label('description', "Description: "); ?>
			</td>
			<td>
				<? $form->attributes = "maxlength='64' size='25'"; ?>
				<? $form->element('description', 'text', $plan->description); ?>
			</td>
		</tr>
		<tr>
			<td>
				<? $form->label('price', "Price: "); ?>
			</td>
			<td>
				<b>$</b>
				<?
					$form->attributes = "maxlength='10' size='6'";
					$form->element('cash', 'text', $cash);
				?><b>.</b>
				<?
					$form->attributes = "maxlength='2' size='3'";
					$form->element('cents', 'text', $cents);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?
					$form->label('period', "Bill Every: ", "slabel");
				?>
			</td>
			<td>
				<?
					if (!$plan->period) $plan->period = 0;
					$form->attributes = "maxlength='2' size='2'";
					$form->element('period', 'text', $plan->period);
				?> Months
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				<?
					if ($form->hidden == 1)
						$form->attributes = " CHECKED";
					$form->element('hidden', 'checkbox', '1');
				?> Hide Plan
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<?
					$form->attributes = "class='sbutton'";
					$form->element('submitButton', 'submit', 'Add Plan');
				?>
			</td>
		</tr>
	</table>
	<? $form->end(); ?>
</div>
