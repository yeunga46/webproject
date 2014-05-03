<?php
require_once ('/export/home/fidukj40/source_html/web/webProject/Connect.php');
$dbh = ConnectDB();

$query = 'INSERT into high_score(name, total_time, num_correct,total_questions) '.
'VALUES(:name,:time, :correct,:total)';
$stmt = $dbh->prepare($query);
$name= $_GET['name'];
$time= $_GET['time'];
$correct= $_GET['correct'];
$total= $_GET['total'];

$stmt->bindParam(':name',$name);
$stmt->bindParam(':time',$time);
$stmt->bindParam(':correct',$correct);
$stmt->bindParam(':total',$total);

$stmt->execute();


?>
