<div id="mainpage">
	<h1>Manage Plans</h1>
	<a href="addplan.php">Add New Plan</a>
<?
	$form = new Form();
	$form->start();
	$totalVars = count($plan->id);
	if ($totalVars)
	{
?>
		<table border='1' class='s_table'>
			</tr>
				<td>
					<b>Name</b>
				</td>
				<td>
					<b>Price</b>
				</td>
				<td width="200">
					<b>Description</b>
				</td>
				<td>
					<b>Period</b>
				</td>
				<td>
					<b>Hidden</b>
				</td>
				<td>
					&nbsp
				</td>
			</tr>
<?
		for ($i = 0; $i < $totalVars; $i++)
		{
?>
			<tr>
				<td><? $form->element('name[]', 'text', $plan->name[$i]); ?></td>
				<td><b>$</b>
				<?
					$form->element('id[]', 'hidden', $plan->id[$i]);
				  $form->attributes = "maxlength='10' size='8'";
          $form->element('price[]', 'text', $plan->price[$i]);
				?>
				</td>
				<td>
				<?
					$form->attributes = "maxlength='200' size='20'";
					$form->element('description[]', 'text', $plan->description[$i]);
				?>
				</td>
				<td>
				<?
					$form->attributes = "maxlength='2' size='2'";
					$form->element('period[]', 'text', $plan->period[$i]);
				?>
				</td>
				<td><?
					if ($plan->hidden[$i])
						$form->attributes = "checked";
					$form->element('hidden['.$i.']', 'checkbox', '1', 's_checkbox');
				?></td>
				<td><a onClick="return confirmDelete();" href="manageplans.php?delete=<? echo $plan->id[$i]; ?>"><img src="images/deletex.png" border="0" width="16" height="16"></a></td>
			</tr>
<?
		}
?>
		</table>
<?
	}
	else
	{
		echo "<br><b>There are currently no plans.</b>";
	}
	$form->attributes = "class='sbutton'";
	$form->element('submitButton', 'submit', 'Update');
	$form->end();
?>
</div>
