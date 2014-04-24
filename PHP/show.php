<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
<head>
    <title>Web Database Sample Display</title>
</head> 
<body>

<h1>Data from mytable</h1>
<?php

// access information in directory with no web access
require_once('/export/home/fidukj40/source_html/web/webProject/Connect.php');

// other functions are right here
require_once('DBfuncs.php');


$dbh = ConnectDB();

$phonelist = ListAllPhones($dbh);

echo "<p>High Score:<p>\n";
$counter = 0;
echo "<ul>\n";
foreach ( $phonelist as $number ) {
    $counter++;
    echo "    <li> $number->name, $number->num_correct, $number->total_time ";
    echo "</li>\n";
}
echo "</ul>\n";

echo "<p> $counter record(s) returned.<p>\n";

// uncomment next line for debugging
# echo '<pre>'; print_r($phonelist); echo '</pre>';
?>

<?php include('foot.php'); ?>

</body>
</html>
