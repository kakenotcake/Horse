<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
    
    //if there is no entry for that title, then add it
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_query($con,'INSERT INTO behaviordb VALUES("' .
                $behavior->get_title() . '","' .
                $behavior->get_behaviorLevel() . '");');
        mysqli_close($con);
        return true;
    }
    mysqli_close($con);
    return false;
    
}
function retrieve_behavior($title) {
    $con=connect();
    $query = "SELECT * FROM behaviordb WHERE title='" . $title . "';";
    $result = mysqli_query($con,$query);
    
    if (mysqli_num_rows($result) != 1) {
        mysqli_close($con);
        return false;
    }
    $result_row = mysqli_fetch_assoc($result);
    $theBehavior = make_a_behavior($result_row);
    return $theBehavior;
}
function make_a_behavior($result_row) {
    $theBehavior = new Behavior(
                   $result_row['title'],
                   $result_row['behaviorLevel']);
    return $theBehavior;
}

