<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('dbinfo.php');
include_once(dirname(__FILE__).'/../domain/Person.php');

/*
 * add a person to persondb table: if already there, return false
 */

//add a person to phpMyAdmin database
function add_person($person) {
    
    if (!$person instanceof Person) {
        die("Error: add_person userType mismatch");
    }
    
    $con=connect();
    $query = "SELECT * FROM persondb WHERE fullName='" . $person->get_fullName() . "';";
    $result = mysqli_query($con,$query);

    //If there's no row for the person to add,
    if ($result == null || mysqli_num_rows($result) == 0) {
        
        //add the person to the database.
        mysqli_query($con,'INSERT INTO persondb VALUES("' .
                $person->get_firstName() . '","' .
                $person->get_lastName() . '","' .
                $person->get_fullName() . '","' .
                $person->get_phone() . '","' .
                $person->get_email() . '","' .
                $person->get_username() . '","' .
                $person->get_pass() . '","' .
                $person->get_userType() . '");');							        
        
        mysqli_close($con);

        //Return that the person was added.
        return true;
    }
    mysqli_close($con);
    return false;
}

function edit_person($name, $person) {
    if (!$person instanceof Person) {
        die("Errors: edit_person userType mismatch");
    }
    $con=connect();    
    $query = "UPDATE persondb SET firstName='" . $person->get_firstName() . "', 
                                  lastName='" . $person->get_lastName() . "', 
                                  fullName='" . $person->get_fullName() . "', 
                                  phone='" . $person->get_phone() . "', 
                                  email='" . $person->get_email() . "', 
                                  username='" . $person->get_username() . "', 
                                  pass='" . $person->get_pass() . "', 
                                  userType='" . $person->get_userType() . "'
                                  WHERE fullName='" . $name . "';";

    $result = mysqli_query($con,$query);
    
    if($result == null) {
        echo("RESULT IS NULL");
        //echo("color is: " . $person->get_color() . " breed is: " . $person->get_breed());
    }
    mysqli_close($con);
    return true;
}


/*
 * remove a person from persondb table. If already there, return false
 */
function remove_person($personName) {
    $con=connect();
    $query = 'SELECT * FROM persondb WHERE fullName = "' . $personName . '"';
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $query = 'DELETE FROM persondb WHERE fullName = "' . $personName . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return true;
}


    /*
     * @return a person from persondb table matching a particular name. 
     * if not in table, return false
     */
function retrieve_person($personName) {
    $con=connect();

    //Save the rows that have the personName
    $query = "SELECT * FROM persondb WHERE fullName='" . $personName . "';";
    $result = mysqli_query($con,$query);

    //If the person does NOT exist in the database,
    if (mysqli_num_rows($result) != 1) {
        mysqli_close($con);

        //return false to indiciate the person can be added.
        return false;
    }

    $result_row = mysqli_fetch_assoc($result);
    $thePerson = make_a_person($result_row);
    return $thePerson;
}
   


    /*
     * @return all rows from persondb table ordered name
     * if none there, return false
     */
function getall_persondb() {
    $con=connect();
    $query = "SELECT * FROM persondb ORDER BY lastName, firstName";
    //$query.= " ORDER BY personName";
    $result = mysqli_query($con,$query);
    
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }

    $result = mysqli_query($con,$query);
    $thePersons = array();

    while ($result_row = mysqli_fetch_assoc($result)) {
        $thePerson = make_a_person($result_row);
        $thePersons[] = $thePerson;
    }
    return $thePersons;
}


function getall_person_names() {
    $con=connect();
    $query = "SELECT fullName FROM persondb ORDER BY fullName";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $names = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $names[] = $result_row['fullName'];
    }
    mysqli_close($con);
    return $names;
}
  

function make_a_person($result_row) {
    $theperson = new person(
                $result_row['firstName'],
                $result_row['lastName'],
                $result_row['fullName'],
                $result_row['phone'],
                $result_row['email'],
                $result_row['username'],
                $result_row['pass'],
                $result_row['userType']);
    return $theperson;
}


function get_numPersons() {
    if (getall_person_names() == 0) {
        return 0;
    }
    $numNames = getall_person_names();
    return count($numNames);
}


function get_breed($personName) {
    $con=connect();
    $query = "SELECT breed from persondb WHERE personName='" . $personName . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}