<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('dbinfo.php');
include_once(dirname(__FILE__).'/../domain/Horse.php');
//include_once('../domain/Horse.php');
//include_once('../domain/o_Horse.php');

/*
 * add a horse to horsedb table: if already there, return false
 */

 
function add_horse($horse) {
    
    if (!$horse instanceof Horse) {
        die("Error: add_horse type mismatch");
    }
    
    $con=connect();
    $query = "SELECT * FROM horsedb WHERE horseName='" . $horse->get_horseName() . "';";
    //return $query;
    $result = mysqli_query($con,$query);
    //if there's no entry for this name, add it

    
    if($result == null) {
        return "Result is null";
    }
    else if(mysqli_num_rows($result) == 0) {
        return "Query got no rows for " . $horse->get_horseName() . "";
    }

//    else

    //Currently, the second condition is true. $result is NOT null!!
    else if ($result == null || mysqli_num_rows($result) == 0) {

        mysqli_query($con,'INSERT INTO horsedb VALUES("' .
                $horse->get_horseName() . '","' .
                $horse->get_color() . '","' .
                $horse->get_breed() . '","' .
                $horse->get_pastureNum() . '","' .
                $horse->colorRank() . '");');							        

        mysqli_close($con);
        return true;
    }
    else {
        return "nah";
    }
    mysqli_close($con);
    return false;
}
/*
 * remove a horse from horsedb table. If already there, return false
 */
function remove_horse($horseName) {
    $con=connect();
    $query = 'SELECT * FROM horsedb WHERE horseName = "' . $horseName . '"';
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $query = 'DELETE FROM horsedb WHERE horseName = "' . $horseName . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return true;
}
    /*
     * @return a Horse from horsedb table matching a particular name. 
     * if not in table, return false
     */
function retrieve_horse($horseName) {
    $con=connect();
    $query = "SELECT * FROM horsedb WHERE horseName='" . $horseName . "';";
    $result = mysqli_query($con,$query);

    if (mysqli_num_rows($result) != 1) {
        mysqli_close($con);
        return false;
    }
    $result_row = mysqli_fetch_assoc($result);
    $theHorse = make_a_horse($result_row);
    return $theHorse;
}
    
    /*
     * @return all rows from horsedb table ordered name
     * if none there, return false
     */
function getall_horsedb($name_from, $name_to) {
    $con=connect();
    $query = "SELECT * FROM horsedb ORDER BY horseName";
    //$query.= " ORDER BY horseName";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $theHorses = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $theHorse = make_a_horse($result_row);
        $theHorses[] = $theHorse;
    }
    return $theHorses;
}
function getall_horse_names() {
    $con=connect();
    $query = "SELECT horseName FROM horsedb ORDER BY horseName";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $names = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $names[] = $result_row['horseName'];
    }
    mysqli_close($con);
    return $names;
}
    
function make_a_horse($result_row) {
    $theHorse = new Horse(
                $result_row['horseName'],
                $result_row['color'],
                $result_row['breed'],
                $result_row['pastureNum'],
                $result_row['colorRank']);
    return $theHorse;
}

function edit_horse($horseToEdit, $title){
    $con=connect();
    //$query = "SELECT * FROM horsedb WHERE horseName='" . $horseName . "';";
    $query = "UPDATE horsedb SET horseName='" .$horseToEdit->get_name()."', color='". $horseToEdit->get_color()"', breed='".$horseToEdit->get_breed(). "', pastureNum='".$horseToEdit->get_pastureNum()."', colorRank='".$horseToEdit->get_colorRank."' WHERE horseName='".$title."';"

$result = mysqli_query($con,$query);
   
    return $result;
}
