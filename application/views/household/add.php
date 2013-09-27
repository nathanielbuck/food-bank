<nav>
    <a href="../households">All Households</a>
</nav>

<h1>Add a Household</h1>

<?php echo validation_errors(); ?>

<?php echo form_open('household/add'); ?>

<fieldset>
	<label for="first_name">First Name</label>
	<input type="input" name="first_name"
		value="<? echo set_value('first_name'); ?>"/>
</fieldset>

<fieldset>
	<label for="last_name">Last Name</label>
	<input type="input" name="last_name"
		value="<? echo set_value('last_name'); ?>"/>
</fieldset>

<fieldset>
	<label for="proxy_first_name">Proxy First Name</label>
	<input type="input" name="proxy_first_name"
		value="<? echo set_value('proxy_first_name'); ?>"/>
</fieldset>

<fieldset>
	<label for="last_name">Proxy Last Name</label>
	<input type="input" name="proxy_last_name"
		value="<? echo set_value('proxy_last_name'); ?>"/>
</fieldset>

<fieldset>
	<label for="address">Address</label>
	<input type="input" name="address"
		value="<? echo set_value('address'); ?>"/>
</fieldset>

<fieldset>
	<label for="phone">Phone Number</label>
	<input type="input" name="phone"
		value="<? echo set_value('phone'); ?>"/>
</fieldset>

<fieldset>
	<label for="food_stamps">Collects Food Stapms?</label>

	 <label for="food_stamps">Yes</label>
	 <input type="radio" name="food_stamps" value="1"
		<? echo set_radio('food_stamps', '1'); ?>/>

	<label for="food_stamps">No</label>
	<input type="radio" name="food_stamps" value="0"
		<? echo set_radio('food_stamps', '0'); ?>/>
</fieldset>

<fieldset>
	<label for="disabled">Number of Disabled Individuals</label>
	<input type="input" name="disabled"
		value="<? echo set_value('disabled'); ?>"/>
</fieldset>

<fieldset>
	<label for="veteran">Number of Veterans</label>
	<input
		type="input"
		name="veteran"
		value="<? echo set_value('veteran'); ?>"/>
</fieldset>

<?php foreach ($age_ranges as $age_range): ?>
<fieldset>
	<label for="age_range<? echo $age_range['age_range_id']; ?>">
		Number of Individuals Ages <? echo $age_range['min_age']; ?> to
		<? echo $age_range['max_age']; ?>:
	</label>
	<input type="input" name="age_range<? echo $age_range['age_range_id']; ?>"
		value="<? echo set_value('age_range' .
            $age_range['age_range_id']); ?>"/>
</fieldset>
<?php endforeach; ?>

<fieldset>
	<label for="income_sources[]">Income Sources</label>
	<select name="income_sources[]" data-placeholder="Select income sources..." multiple="multiple">
		<?php foreach ($income_sources as $income_source): ?>
			<option
					value="<? echo $income_source['income_source_id']; ?>"
					<? if (!empty($_POST['income_sources']) && in_array(
							$income_source['income_source_id'],
							$_POST['income_sources'])): ?>
						selected="selected"
					<? endif; ?>
					>
				<? echo $income_source['income_source']; ?>
			</option>
		<?php endforeach; ?>
	</select>
</fieldset>

<input type="submit" name="submit" value="Add Household" />
