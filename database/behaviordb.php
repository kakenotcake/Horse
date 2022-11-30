<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * ayo
 */
include_once('dbinfo.php');
include_once(dirname(__FILE__).'/../domain/Behavior.php');
/*
 * Add behavior to behavior table: if already there, return false
 */
function add_behavior($behavior) {
    if (!$behavior instanceof Behavior) {
        die("Error: add_behavior type mismatch");
    }
    $con=connect();
    
    $query = "SELECT * FROM behaviordb WHERE title='" . $behavior->get_title() . "';";
    $result = mysqli_query($con,$query);
    
    //if there is no behavior with the title, 
    if ($result == null || mysqli_num_rows($result) == 0) {

        //add it to teh database.
        mysqli_query($con,'INSERT INTO behaviordb VALUES("' .
                $behavior->get_title() . '","' .
                $behavior->get_behaviorLevel() . '");');
        mysqli_close($con);
        return true;
    }
    mysqli_close($con);
    return false;
    
}

//Edit an existing behavior in the database.
//Parameters:
    //$title: the title of the existing behavior
    //$behavior: the Behavior object of the updated behavior.

//Return: true. By this point, we've confirmed that the user can edit the database.
function edit_behavior($title, $behavior) {
    if (!$behavior instanceof Behavior) {
        die("Error: edit_behavior type mismatch");
    }
    $con=connect();

    $query = "UPDATE behaviordb SET title='" . $behavior->get_title() . "', behaviorLevel='" . $behavior->get_behaviorLevel() . "' WHERE title='" . $title . "';";
    $result = mysqli_query($con,$query);

    mysqli_close($con);
    return true;    
}

/*
 * remove a horse from horsedb table. If already there, return false
 */



function remove_behavior($title) {
    /*
    if (!$behavior instanceof Behavior) {
        die("Error: remove_behavior type mismatch");
    }
    */
    $con=connect();
    $query = 'DELETE FROM behaviordb WHERE title = "' . $title . '"';
    $result = mysqli_query($con,$query);
    /*
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $query = 'DELETE FROM horsedb WHERE horseName = "' . $horseName . '"';
    $result = mysqli_query($con,$query);
    */
    mysqli_close($con);
    return true;
}

    /*
     * @return a Horse from horsedb table matching a particular name. 
     * if not in table, return false (0)
     */

//Modify to pass to forms to put existing fields in input!!
function retrieve_behavior($behaviorTitle) {
    $con=connect();

    //Save the rows that have the title
    $query = "SELECT * FROM behaviordb WHERE title='" . $behaviorTitle . "';";
    $result = mysqli_query($con,$query);

    //If the behavior does NOT exist in the database,
    if (mysqli_num_rows($result) != 1) {
        mysqli_close($con);

        //return false to indiciate the retrieval process "failed".
        return false;
    }
    
    //Otherwise, create a Behavior object based on the returned row and return it.
    $result_row = mysqli_fetch_assoc($result);
    $theBehavior = make_a_behavior($result_row);
    return $theBehavior;   
    //return true;
}

    
    /*
     * @return all rows from behaviordb table ordered name
     * if none there, return false
     */

function getall_behaviordb() {
    $con=connect();
    $query = "SELECT * FROM behaviordb ORDER BY title";
    //$query.= " ORDER BY horseName";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $theBehaviors = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $theBehavior = make_a_behavior($result_row);
        $theBehaviors[] = $theBehavior;
    }
    return $theBehaviors;
}

//Create a method to get a specific behavior from the database by the title!


//Get all behavior titles in the database.
//Parameters: None.

//Return: $titles, an array of all of the behavior titles. 

function getall_behavior_titles() {
    $con=connect();

    $query = "SELECT title FROM behaviordb ORDER BY title";
    $result = mysqli_query($con,$query);

    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }

    $result = mysqli_query($con,$query);
    $titles = array();

    while ($result_row = mysqli_fetch_assoc($result)) {
        $titles[] = $result_row['title'];
    }
    
    mysqli_close($con);
    return $titles;
}

//Use this to check if the user can edit or remove from the database.
function get_numBehaviors() {

    if(getall_behavior_titles() == 0 ) {
        return 0;
    }
    
    $numTitles = getall_behavior_titles();
    return count($numTitles);
    /*
    $con=connect();
    $query = "SELECT count(*) FROM behaviordb";

    $result = mysqli_query($con,$query);
    $result_row = mysqli_fetch_assoc($result)
    return $result_row;

    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $theBehaviors = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $theBehavior = make_a_behavior($result_row);
        $theBehaviors[] = $theBehavior;
    }
    return $theBehaviors;
    */
}
 

function make_a_behavior($result_row) {
    $theBehavior = new Behavior(
                $result_row['title'],
                $result_row['behaviorLevel']);
    return $theBehavior;
}


?>