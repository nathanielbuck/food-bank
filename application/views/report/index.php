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

<select name="month" data-placeholder="Month" class="report-date">
    <? foreach ($months as $v => $m) {
        $selected = '';
        if ($month == $v) {
            $selected = ' selected="selected" ';
        }
        echo '<option value="' . $v . '" ' . $selected . '>' . $m . '</option>';
    }?>
</select>

<select name="year" data-placeholder="Year" class="report-date">
    <? for ($y = $start_year; $y <= $year + 1; $y++) {
        $selected = '';
        if ($year == $y) {
            $selected = ' selected="selected" ';
        }
        echo '<option value="' . $y . '" ' . $selected . '>' . $y . '</option>';
    }?>
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
