<nav>
    <a href="../households">All Households</a>
    <br/>
    <a href="../household/add">Add Household</a>
    <br/>
    <a href="../households/reports">Reports</a>
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
	<a class="edit-link" href="edit/<? echo $household['household_id']; ?>">Edit</a>

	<dl>
        <? if (!empty($household['proxy_first_name']) ||
            !empty($household['proxy_last_name'])): ?>

            <dt>Proxy</dt>
            <dd><? echo $household['proxy_first_name'] . ' ' .
                $household['proxy_last_name']; ?></dd>
        <? endif; ?>

        <dt>Address</dt>
        <dd><? echo $household['address']; ?></dd>

		<? if (!empty($household['phone'])): ?>
			<dt>Phone</dt>
			<dd><? echo $household['phone']; ?></dd>
        <? endif; ?>

        <dt>Collects Food Stamps?</dt>
        <dd><? echo format_bool($household['food_stamps']); ?></dd>

        <dt>Disabled Individuals</dt>
        <dd><? echo $household['disabled']; ?></dd>

        <dt>Veterans</dt>
        <dd><? echo $household['veteran']; ?></dd>
	</dl>

<h2>Household Members &ndash; Birthday and Sex</h2>
<ul>
<? foreach ($household_members as $household_member): ?>
    <li>
        <? echo $household_member['sex']; ?> &ndash;
        <? echo $household_member['birthday']; ?>
    </li>
<? endforeach; ?>
</ul>

<? if (!empty($household['comments'])): ?>
    <h2>Comments</h2>
    <pre><? echo $household['comments']; ?></pre>
<? endif; ?>

<? if (count($income_sources) > 0): ?>
    <h2>Income Sources</h2>
    <ul>
    <?
        foreach ($income_sources as $income_source):
    ?>
            <li>
                <? echo $income_source['income_source']; ?>
            </li>
    <?
        endforeach;
    ?>
    </ul>
<? endif; ?>
</div>
