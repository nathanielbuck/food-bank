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
		value="<? if (!empty($_POST)) {
			echo $_POST['proxy_first_name']; } ?>"/>
</fieldset>

<fieldset>
	<label for="last_name">Proxy Last Name</label>
	<input type="input" name="proxy_last_name"
		value="<? if (!empty($_POST)) {
			echo $_POST['proxy_last_name']; } ?>"/>
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

<h3>Members</h3>
<div class="members">
<? //var_dump($birthday); ?>
<?php foreach ($birthday as $i => $b): ?>
<fieldset>
	<input type="input" name="birthday<? echo $i; ?>"
		value="<? echo $b; ?>"
		placeholder="Birthday MM/DD/YYYY"/>

	<select name="sex<? echo $i; ?>"
		placeholder="Sex">
		<option <? if (1 == $sex[$i]) {
			echo('selected="selected"');
		} ?> value="1">Male</option>
		<option <? if (2 == $sex[$i]) {
			echo('selected="selected"');
		} ?> value="2">Female</option>
	</select>
</fieldset>
<?php endforeach; ?>
<?php if (0 == count($birthday)): ?>
<fieldset>
	<input
		type="input"
		name="birthday1"
		placeholder="Birthday MM/DD/YYYY"/>

	<select name="sex1">
		<option value="1">Male</option>
		<option value="2">Female</option>
	</select>
</fieldset>
<?php endif; ?>
	<a href="#" class="add-member">Add Member</a>
	<a
		href="#"
		class="remove-member"
		<?php if (count($birthday) <= 1): ?>
			style="display: none"
		<?php endif; ?>
		>Remove</a>
</div>

<br/>

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

<fieldset>
	<label for="comments">Comments</label>
	<textarea name="comments"><?
		echo $this->input->post('comments');
	?></textarea>
</fieldset>

<input type="submit" name="submit" value="Add Household" />
<script>
	$('.add-member').click(function (e) {
		var $last_fieldset = $(this).closest('.members').find('fieldset:last');
		var $new_fieldset = $last_fieldset.clone();

		var $input = $new_fieldset.find('input');
		var $select = $new_fieldset.find('select');

		var input_num = $input.attr('name').replace(/[A-Za-z$-]/g, '');
		input_num++;

		$input
			.attr('name', 'birthday' + input_num)
			.val('');
		$select
			.attr('name', 'sex' + input_num)
			.val(1);

		$last_fieldset.after($new_fieldset);
		$('.remove-member').show();
		e.preventDefault();
	});
	$('.remove-member').click(function (e) {
		var $members = $(this).closest('.members');
		$members.find('fieldset:last').remove();
		if (1 == $members.find('fieldset').length) {
			$('.remove-member').hide();
		}
		e.preventDefault();
	});
</script>
