<nav>
    <a href="household/add">Add Households</a>
</nav>

<h1>Households</h1>

<?php
foreach ($households as $household):
?>
    <a href="household/<? echo $household['household_id']; ?>">
        <?php echo $household['last_name'] . ', ' .
        $household['first_name']; ?>
    </a>
<br/>
<?php
endforeach;
?>
