<nav>
    <a href="../household/add">Add Households</a>
<br/>
    <a href="../households">All Households</a>
</nav>

<h1>
	Report for
	<span class="month"><? echo $month_text; ?></span>
	<span class="year"><? echo $year; ?></span>
</h1>

<select name="month" data-placeholder="Month">
<!--
	<option value="1">January</option>
	<option value="2">February</option>
	<option value="3">March</option>
	<option value="4">April</option>
	<option value="5">May</option>
	<option value="6">June</option>
	<option value="7">July</option>
	<option value="8">August</option>
	<option value="9">September</option>
-->
	<option value="10" selected="selected">October</option>
<!--
	<option value="11">November</option>
	<option value="12">December</option>
-->
</select>

<select name="year" data-placeholder="Year">
	<option value="2013" selected="selected">2013</option>
</select>


<fieldset>
	<label for="households_absent">Add: </label>
	<select
		name="households_absent"
		data-placeholder="Select household..."
		style="width: 400px"
		multiple="multiple"
	>
		<?php foreach ($absent_households as $household): ?>
			<option value="<? echo $household['household_id']; ?>">
				<? echo($household['first_name'] . ' ' .
					$household['last_name']); ?>
			</option>
		<?php endforeach; ?>
	</select>
</fieldset>

<h2>Present</h2>
<ul class="present_households">
<?php
foreach ($present_households as $h):
?>
	<li>
		<a href="../household/<? echo $h['household_id']; ?>">
			<?php echo $h['first_name'] . ' ' .
			$h['last_name']; ?>
		</a>
	</li>
<?php
endforeach;
?>
</ul>
