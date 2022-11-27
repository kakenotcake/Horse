<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('dbinfo.php');
include_once(dirname(__FILE__).'/../domain/Trainer.php');
//include_once('../domain/Trainer.php');
//include_once('../domain/o_Trainer.php');

/*
 * add a trainer to trainerdb table: if already there, return false
 */

//add a trainer to phpMyAdmin database
function add_trainer($trainer) {
    
    if (!$trainer instanceof Trainer) {
        die("Error: add_trainer type mismatch");
    }
    
    $con=connect();
    $query = "SELECT * FROM trainerdb WHERE trainerFirstName='" . $trainer->get_trainerFirstName() . "';";
    //return $query;
    $result = mysqli_query($con,$query);


    //if there's no entry for this name, add it
    //Currently, the second condition is true. $result is NOT null!!
    //If there's no row for the trainer to add,
    if ($result == null || mysqli_num_rows($result) == 0) {
        
        //add the trainer to the database/
        mysqli_query($con,'INSERT INTO trainerdb VALUES("' .
                $trainer->get_trainerFirstName() . '","' .
                $trainer->get_trainerLastName() . '","' .
                $trainer->get_phoneNumber() . '","' .
                $trainer->get_username() . '","' .
                $trainer->get_password() . '");');							        
        
        mysqli_close($con);

        //Return that the trainer was added.
        return true;
    }
    mysqli_close($con);
    return false;
}
/*
 * remove a trainer from trainerdb table. If already there, return false
 */
function remove_trainer($trainerFirstName) {
    $con=connect();
    $query = 'SELECT * FROM trainerdb WHERE trainerFirstName = "' . $trainerFirstName . '"';
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $query = 'DELETE FROM trainerdb WHERE trainerFirstName = "' . $trainerFirstName . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return true;
}
    /*
     * @return a Trainer from trainerdb table matching a particular name. 
     * if not in table, return false
     */
function retrieve_trainer($trainerFirstName) {
    $con=connect();

    //Save the rows that have the trainerFirstName
    $query = "SELECT * FROM trainerdb WHERE trainerFirstName='" . $trainerFirstName . "';";
    $result = mysqli_query($con,$query);

    //If the trainer does NOT exist in the database,
    if (mysqli_num_rows($result) != 1) {
        mysqli_close($con);

        //return false to indiciate the trainer can be added,
        return false;
    }
    /*
    $result_row = mysqli_fetch_assoc($result);
    $theTrainer = make_a_trainer($result_row);
    return $theTrainer;
    */

    //Return true to indicate the trainer canNOT be added.
    return true;
}
    
    /*
     * @return all rows from trainerdb table ordered name
     * if none there, return false
     */
function getall_trainerdb($name_from, $name_to) {
    $con=connect();
    $query = "SELECT * FROM trainerdb ORDER BY trainerFirstName";
    //$query.= " ORDER BY trainerFirstName";
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
function getall_trainer_names() {
    $con=connect();
    $query = "SELECT trainerFirstName FROM trainerdb ORDER BY trainerFirstName";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $names = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $names[] = $result_row['trainerFirstName'];
    }
    mysqli_close($con);
    return $names;
}
    
function make_a_trainer($result_row) {
    $theTrainer = new Trainer(
                $result_row['trainerFirstName'],
                $result_row['trainerLastname'],
                $result_row['phoneNumber'],
                $result_row['username'],
                $result_row['password']);
    return $theTrainer;
}
