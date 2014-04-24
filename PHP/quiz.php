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
$exclude = array();
$questons = array();
$max = 50;
$n = rand(1,1000);
$i=0;
while( $i <> 20)
{
if(!in_array($n,$exclude) )
{
array_push($exclude,$n);
$questions[$i]= $n;
$n = rand(1,1000);
echo "<p>".$questions[$i]."</p>";
$i = $i +1;
}
}
var_dump($questions);
?>

</i>

