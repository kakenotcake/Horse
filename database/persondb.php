<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * ayo
 */
include_once('dbinfo.php');
include_once(dirname(__FILE__).'/../domain/Trainer.php');
/*
 * Add trainer to trainer table: if already there, return false
 */
function add_trainer($trainer) {
    if (!$trainer instanceof Trainer) {
        die("Error: add_trainer type mismatch");
    }
    $con=connect();

    $query = "SELECT * FROM persondb WHERE personName='" . $trainer->get_name() . "';";
    $result = mysqli_query($con,$query);

    //if there is no trainer with the title,
    if ($result == null || mysqli_num_rows($result) == 0) {

        //add it to teh database.
        mysqli_query($con,'INSERT INTO persondb VALUES("' .
                $trainer->get_name() . '","' .
                $trainer->get_phoneNumber() . '","' .
                $trainer->get_email() . '","' .
                $trainer->get_username() . '","' .
                $trainer->get_password() . '","' .
                $trainer->get_access(). '");');
        mysqli_close($con);
        return true;
    }
    mysqli_close($con);
    return false;

}

//Edit an existing trainer in the database.
//Parameters:
    //$title: the title of the existing trainer
    //$trainer: the Trainer object of the updated trainer.

//Return: true. By this point, we've confirmed that the user can edit the database.
function edit_trainer($name, $trainer) {
    if (!$trainer instanceof Trainer) {
        die("Error: edit_trainer type mismatch");
    }
    $con=connect();

    $query = "UPDATE persondb SET personName='" . $trainer->get_name() .
        "', phone='" . $trainer->get_phoneNumber() .
        "', email='" . $trainer->get_email() .
        "', username='" . $trainer->get_username() .
        "', personPassword='" . $trainer->get_password() .
        "' WHERE personName='" . $trainer->get_name() . "';";
    $result = mysqli_query($con,$query);

    mysqli_close($con);
    return true;
}

/*
 * remove a horse from horsedb table. If already there, return false
 */



function remove_trainer($name) {
    /*
    if (!$trainer instanceof Trainer) {
        die("Error: remove_trainer type mismatch");
    }
    */
    $con=connect();
    $query = "DELETE FROM persondb WHERE personName='" . $trainer->get_name() . "';";
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
     * if not in table, return false
     */


function retrieve_trainer($name) {
    $con=connect();

    //Save the rows that have the horseName
    $query = "SELECT * FROM persondb WHERE personName='" . $trainer->get_name() . "';";
    $result = mysqli_query($con,$query);

    //If the horse does NOT exist in the database,
    if (mysqli_num_rows($result) != 1) {
        mysqli_close($con);

        //return false to indiciate the horse can be added,
        return false;
    }

    //$result_row = mysqli_fetch_assoc($result);
    //$theHorse = make_a_horse($result_row);
    //return $theHorse;


    //Return true to indicate the horse canNOT be added.
    return true;
}


    /*
     * @return all rows from persondb table ordered name
     * if none there, return false
     */

function getall_persondb() {
    $con=connect();
    $query = "SELECT * FROM persondb ORDER BY personName";
    //$query.= " ORDER BY horseName";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $theTrainers = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $theTrainer = make_a_trainer($result_row);
        $theTrainers[] = $theTrainer;
    }
    return $theTrainers;
}


//Get all trainer titles in the database.
//Parameters: None.

//Return: $titles, an array of all of the trainer titles.

function getall_trainer_names() {
    $con=connect();

    $query = "SELECT personName FROM persondb ORDER BY personName";
    $result = mysqli_query($con,$query);

    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }

    $result = mysqli_query($con,$query);
    $names = array();

    while ($result_row = mysqli_fetch_assoc($result)) {
        $names[] = $result_row['personName'];
    }

    mysqli_close($con);
    return $names;
}


function make_a_trainer($result_row) {
    $theTrainer = new Trainer(
                $result_row['personName'],
                $result_row['phone'],
                $result_row['email'],
                $result_row['username'],
                $result_row['personPasssword'],
                $result_row['access']);
    return $theTrainer;
}


?>