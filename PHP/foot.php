<!-- foot.php - include for a footer -->

<p>
Things you can do with the phone database: <br>
<a href="./add.php">Add</a>
<a href="./delete.php">Remove</a>
<a href="./search.php">Search</a>
<a href="./show.php">Show All</a>
</p>

<hr>
This file ("<?php echo basename($_SERVER["PHP_SELF"]) ?>") was last modified at:<i>
<?php
    echo strftime("%A, %e %B %Y, %I:%M:%S %p",
                  filemtime ( basename ($_SERVER["PHP_SELF"])));
?>
</i>

