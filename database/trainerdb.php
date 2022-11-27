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
    $query = "SELECT * FROM trainerdb WHERE trainerName='" . $trainer->get_trainerName() . "';";
    //return $query;
    $result = mysqli_query($con,$query);


    //if there's no entry for this name, add it
    //Currently, the second condition is true. $result is NOT null!!
    //If there's no row for the trainer to add,
    if ($result == null || mysqli_num_rows($result) == 0) {
        
        //add the trainer to the database/
        mysqli_query($con,'INSERT INTO trainerdb VALUES("' .
                $trainer->get_trainerName() . '","' .
                $trainer->get_color() . '","' .
                $trainer->get_breed() . '","' .
                $trainer->get_pastureNum() . '","' .
                $trainer->get_colorRank() . '");');							        
        
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
function remove_trainer($trainerName) {
    $con=connect();
    $query = 'SELECT * FROM trainerdb WHERE trainerName = "' . $trainerName . '"';
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $query = 'DELETE FROM trainerdb WHERE trainerName = "' . $trainerName . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return true;
}
    /*
     * @return a Trainer from trainerdb table matching a particular name. 
     * if not in table, return false
     */
function retrieve_trainer($trainerName) {
    $con=connect();

    //Save the rows that have the trainerName
    $query = "SELECT * FROM trainerdb WHERE trainerName='" . $trainerName . "';";
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
    $query = "SELECT * FROM trainerdb ORDER BY trainerName";
    //$query.= " ORDER BY trainerName";
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
    $query = "SELECT trainerName FROM trainerdb ORDER BY trainerName";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $names = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $names[] = $result_row['trainerName'];
    }
    mysqli_close($con);
    return $names;
}
    
function make_a_trainer($result_row) {
    $theTrainer = new Trainer(
                $result_row['trainerName'],
                $result_row['color'],
                $result_row['breed'],
                $result_row['pastureNum'],
                $result_row['colorRank']);
    return $theTrainer;
}
