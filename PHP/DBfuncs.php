<?php

/* This file has useful database functions in it for the quiz high score
 * project.
 */

// ListLongest() - return an array of record objects that took longest time
// USAGE: $recordlist = ListLongest($dbh)
// $dbh is database connection
function ListAllPhones($dbh)
{
    // fetch the data
    try {
        // set up query
        $phone_query = "SELECT name,total_time,num_correct,total_questions 
FROM high_score";
        // prepare to execute (this is a security precaution)
        $stmt = $dbh->prepare($phone_query);
        // run query
        $stmt->execute();
        // get all the results from database into array of objects
        $phonedata = $stmt->fetchAll(PDO::FETCH_OBJ);
        // release the statement
        $stmt = null;

        return $phonedata;
    }
    catch(PDOException $e)
    {
        die ('PDO error in ListAllPhones()": ' . $e->getMessage() );
    }
}


// ListLongest() - return an array of record objects that took longest 
// USAGE: $recordlist = ListLongest($dbh)
// $dbh is database connection
function ListLongest($dbh)
{
    // fetch the data
    try {
        // set up query
        $record_query = "SELECT name,total_time,num_correct
 FROM high_score Order by total_time DESC LIMIT 10";
        // prepare to execute (this is a security precaution)
        $stmt = $dbh->prepare($record_query);
        // run query
        $stmt->execute();
        // get all the results from database into array of objects
        $recorddata = $stmt->fetchAll(PDO::FETCH_OBJ);
        // release the statement
        $stmt = null;

        return $recorddata;
    }
    catch(PDOException $e)
    {
        die ('PDO error in ListLongest()": ' . $e->getMessage() );
    }
}

// ListShortest() - return an array of record objects that took shortest
// USAGE: $recordlist = ListShortest($dbh)
// $dbh is database connection
function ListShortest($dbh)
{
    // fetch the data
    try {
        // set up query
        $record_query = "SELECT name,total_time,num_correct
 FROM high_score order by total_time,num_correct LIMIT 10";
        // prepare to execute (this is a security precaution)
        $stmt = $dbh->prepare($record_query);
        // run query
        $stmt->execute();
        // get all the results from database into array of objects
        $recorddata = $stmt->fetchAll(PDO::FETCH_OBJ);
        // release the statement
        $stmt = null;

        return $recorddata;
    }
    catch(PDOException $e)
    {
        die ('PDO error in ListShortest()": ' . $e->getMessage() );
    }
}

// ListMostCorrect() - return an array of record objects that have most correct
// USAGE: $recordlist = ListMostCorrect($dbh)
// $dbh is database connection
function ListMostCorrect($dbh)
{
    // fetch the data
    try {
        // set up query
        $record_query = "SELECT name,total_time,num_correct
 FROM high_score order by num_correct DESC LIMIT 10";
        // prepare to execute (this is a security precaution)
        $stmt = $dbh->prepare($record_query);
        // run query
        $stmt->execute();
        // get all the results from database into array of objects
        $recorddata = $stmt->fetchAll(PDO::FETCH_OBJ);
        // release the statement
        $stmt = null;

        return $recorddata;
    }
    catch(PDOException $e)
    {
        die ('PDO error in ListMostCorrect()": ' . $e->getMessage() );
    }
}

// ListShortestCorrect() - return an array of record objects that have most
//correct in the shortest average time.
// USAGE: $recordlist = ListShortestCorrect($dbh)
// $dbh is database connection
function ListShortestCorrect($dbh)
{
    // fetch the data
    try {
        // set up query
        $record_query = "SELECT name,num_correct, average
 FROM (Select name,num_correct,(total_time/num_correct)as average
From high_score)as score where average >0 order by average  LIMIT 10";
        // prepare to execute (this is a security precaution)
        $stmt = $dbh->prepare($record_query);
        // run query
        $stmt->execute();
        // get all the results from database into array of objects
        $recorddata = $stmt->fetchAll(PDO::FETCH_OBJ);
        // release the statement
        $stmt = null;

        return $recorddata;
    }
    catch(PDOException $e)
    {
        die ('PDO error in ListShortest()": ' . $e->getMessage() );
    }
}


// ListLongestCorrect() - return an array of record objects that have the most
//correct for the amount of time they took.
// USAGE: $recordlist = ListMostCorrect($dbh)
// $dbh is database connection
function ListLongestCorrect($dbh)
{
    // fetch the data
    try {
        // set up query
        $record_query = "SELECT name,num_correct, average
 FROM (Select name,num_correct,(total_time/num_correct)as average
From high_score)as score order by average DESC  LIMIT 10";

        // prepare to execute (this is a security precaution)
        $stmt = $dbh->prepare($record_query);
        // run query
        $stmt->execute();
        // get all the results from database into array of objects
        $recorddata = $stmt->fetchAll(PDO::FETCH_OBJ);
        // release the statement
        $stmt = null;

        return $recorddata;
    }
    catch(PDOException $e)
    {
        die ('PDO error in ListLongestTime()": ' . $e->getMessage() );
    }
}




?>
