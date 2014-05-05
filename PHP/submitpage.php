<?php
echo"<p>Thank you for submitting a question</p>";
require_once ('/export/home/fidukj40/source_html/web/webProject/Connect.php');
$dbh = ConnectDB();
if($_GET['question'] != NULL && $_GET['question'] !="" &&
$_GET['answer'] != NULL && $_GET['answer'] !="")
{

if($_GET['action']=='SE')
{
   try {
        $query = 'INSERT into sub_trivia(question, correct_answer)' .
                       'VALUES (:question,:answer)';
         $question= $_GET['question'];
         $answer= $_GET['answer'];
        // prepare to execute
        $stmt = $dbh->prepare($query);

        $stmt->bindParam('question', $question);
        $stmt->bindParam('answer', $answer);

        $stmt->execute();
        $stmt = null;
     echo" <p>It was submitted successfully!</p>";
     echo" <p>You will be returned to the home page in 3 seconds.</p>";
     header('Refresh: 3; url=index.html');
    }
    catch(PDOException $e)
    {
    echo" <p>It was not submitted.</p>";
        die ('PDO error in submit Fill in ' . $e->getMessage() );
    }
}
if($_GET['action']=='MC')
{
 try {
        $query = 'INSERT into sub_trivia(question,correct_answer,fake1,fake2,fake3)' .
        ' VALUES (:question,:answer, :fake1,:fake2, :fake3)';
         $question= $_GET['question'];
         $answer= $_GET['answer'];
         $fake1= $_GET['fake1'];
         $fake2= $_GET['fake2'];
if($fake2 =="") {$fake2=NULL;}
         $fake3= $_GET['fake3'];
if($fake3 =="") {$fake3=NULL;}


        // prepare to execute
        $stmt = $dbh->prepare($query);

        $stmt->bindParam('question', $question);
        $stmt->bindParam('answer', $answer);
        $stmt->bindParam('fake1', $fake1);
        $stmt->bindParam('fake2', $fake2);
        $stmt->bindParam('fake3', $fake3);

        $stmt->execute();
        $stmt = null;
     echo" <p>It was submitted successfully!</p>";
     echo" <p>You will be returned to the home page in 3 seconds.</p>";
     header('Refresh: 3; url=index.html');
    }
    catch(PDOException $e)
    {
    echo" <p>It was not submitted.</p>";
        die ('PDO error in submit multiple choice ' . $e->getMessage() );
    }

}
}
else{
echo"<p> Your question wasnt submitted. It requires a question and answer</p>";
 header('Refresh: 3; url=submitpage.html');

}
?>
