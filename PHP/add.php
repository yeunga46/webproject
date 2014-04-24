<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
<head>
    <title>Web Database Sample Inserting</title>
</head>

<body>
<?php


// access information in directory with no web access
require_once('/export/home/yeunga46/source_html/web/PHP/Connect.php');

// other functions are right here
require_once('DBfuncs.php');

$dbh = ConnectDB();

// was a name and phone entered?
if ( isset($_GET['name'])   &&  !empty($_GET['name']) ) {

    try {

        $query = 'INSERT INTO high_score (name,total_time,num_correct,total_questions) ' .
                 'VALUES (:name, :time, :correct, :questions)';
        $stmt = $dbh->prepare($query);

        // Copying $_GET[] values to local variables, so nothing
        // happens to values in $_GET[] array.
        // Another way to do this is to use bindValue(), which
        // is pass-by-value, not pass-by-reference.
        $name = "HAL";
		$time = 0;
		$correct = 0;
		$questions = 0;

        // Note each parameter must be bound separately
        $stmt->bindParam(':name', $name);
		$stmt->bindParam(':time', $time);
		$stmt->bindParam(':correct', $correct);
		$stmt->bindParam(':questions', $questions);


        $stmt->execute();
        $inserted = $stmt->rowCount();

        $stmt = null;
    
        echo "<p>inserted $inserted record(s).</p>\n";

    }
    catch(PDOException $e)
    {
        die ('PDO error inserting(): ' . $e->getMessage() );
    }

} else {

    echo "<p>No insertion was requested.</p>\n";

}


$phonelist = ListAllPhones($dbh);

echo "<p>Here is the data in the table now:<p>\n";
$counter = 0;
echo "<ul>\n";
foreach ( $phonelist as $number ) {
    $counter++;
    echo "    <li> $number->name, $number->phone </li>\n";
    // modification: add delete link
}
echo "</ul>\n";

echo "<p> $counter record(s) returned.<p>\n";

// uncomment next line for debugging
# echo '<pre>'; print_r($phonelist); echo '</pre>';



?>

<h1>Add an entry</h1>

<!-- note that not listing an action or a method defaults to
     "this php file runs itself" and "use GET" -->

<form>
    Name: <input type="text" name='name'><br>
    Phone: <input type="text" name='phone'><br>
    <input type="submit">
</form>

<?php include('foot.php'); ?>

</body>
</html>

