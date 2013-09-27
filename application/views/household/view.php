<nav>
    <a href="../households">All Households</a>
    <br/>
    <a href="../household/add">Add Households</a>
</nav>

<?php

function format_bool ($bool) {
    if ($bool) {
        return 'Yes';
    }
    return 'No';
}

?>

<div id="household">
	<h1>Household of
		<? echo $household['first_name'] . ' ' .
			$household['last_name'];
		?>
	</h1>
	<dl>
        <dt>Address</dt>
        <dd><? echo $household['address']; ?></dd>

        <dt>Phone</dt>
        <dd><? echo $household['phone']; ?></dd>

        <dt>Collects Food Stamps?</dt>
        <dd><? echo format_bool($household['food_stamps']); ?></dd>

        <dt>Disabled Individuals</dt>
        <dd><? echo $household['disabled']; ?></dd>

        <dt>Veterans</dt>
        <dd><? echo $household['veteran']; ?></dd>
	</dl>

<? if (count($household_members) > 0): ?>
    <h2>Number of Household Members</h2>
    <dl>
    <?
        foreach ($household_members as $household_member):
    ?>
            <dl>
                Ages
                <? echo $household_member['min_age']; ?> &ndash;
                <? echo $household_member['max_age']; ?>
            </dl>
            <dd>
                <? echo $household_member['individuals']; ?>
            </dd>
    <?
        endforeach;
    ?>
    </dl>
<? endif; ?>
</div>
