<?php
//Stores a persons attempt in the highscore file.
//Authors Jason Fiduk and Andy Yeung
//Links to the Database
require_once ('/export/home/fidukj40/source_html/web/webProject/Connect.php');
$dbh = ConnectDB();
$name= $_GET['name'];
$time= $_GET['time'];
$correct= $_GET['correct'];
$total= $_GET['total'];
//Checks to see if the name is 3 characters, the time is greater than zero,
//and at least 9 questions have been attempted.
if(strlen($name)==3 && $time >0 && $correct != null && $total >=9)
{
try{
$query = 'INSERT into high_score(name, total_time, num_correct,total_questions) '.
'VALUES(:name,:time, :correct,:total)';
$stmt = $dbh->prepare($query);

$stmt->bindParam(':name',$name);
$stmt->bindParam(':time',$time);
$stmt->bindParam(':correct',$correct);
$stmt->bindParam(':total',$total);
//Executes the query
$stmt->execute();
}
catch(PDOException $e)
    {
        die ('PDO error in adding to high score table ' . $e->getMessage() );
    }

}
?>
