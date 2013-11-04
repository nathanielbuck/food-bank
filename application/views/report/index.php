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

<div class="primary">
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
</div>
<div id="report" class="secondary">
    <h2>Report</h2>
    <h3>Number Served</h3>
    <h4>5. Number of Individuals (by Age)</h4>
    <dl>
        <dt>0&ndash;5</dt>
        <dd id="age-range1"><? echo $report['ageRange1']; ?></dd>
        <dt>6&ndash;12</dt>
        <dd id="age-range2"><? echo $report['ageRange2']; ?></dd>
        <dt>13&ndash;17</dt>
        <dd id="age-range3"><? echo $report['ageRange3']; ?></dd>
        <dt>18&ndash;34</dt>
        <dd id="age-range4"><? echo $report['ageRange4']; ?></dd>
        <dt>35&ndash;59</dt>
        <dd id="age-range5"><? echo $report['ageRange5']; ?></dd>
        <dt>60+</dt>
        <dd id="age-range6"><? echo $report['ageRange6']; ?></dd>
        <dt><strong>Total Individuals</strong></dt>
        <dd id="total-individuals"><? echo $report['total_individuals']; ?></dd>
    </dl>

    <h4>6. Number of Individuals (by Age)</h4>
    <dl>
        <dt>Males</dt>
        <dd id="males"><? echo $report['male']; ?></dd>
        <dt>Females</dt>
        <dd id="females"><? echo $report['female']; ?></dd>
    </dl>
    <dl>
        <dt>7. New Individuals</dt>
        <dd id="new-individuals"><? echo $report['new_individuals']; ?></dd>
        <dt>8. Legally Disabled</dt>
        <dd id="disabled"><? echo $report['disabled']; ?></dd>
        <dt>9. Veterans</dt>
        <dd id="veterans"><? echo $report['veteran']; ?></dd>
        <dt>10. Total Households</dt>
        <dd id="total-households"><? echo $report['total_households']; ?></dd>
        <dt>11. New Households</dt>
        <dd id="new-households"><? echo $report['new_households']; ?></dd>
        <dt>12. Households &ndash; Year to Date</dt>
        <dd id="households-year-to-date"><? echo $report['households_year_to_date']; ?></dd>
    </dl>
</div>
