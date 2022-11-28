<?php
/* i am mike
 * Copyright 2015 by Allen Tucker. This program is part of RMHC-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/*
 * 	trainerEdit.php
 *  oversees the editing of a trainer to be added, changed, or deleted from the database
 */
session_start();
session_cache_expire(30);
include_once('database/trainerdb.php');
include_once('database/dbinfo.php');
include_once('domain/trainer.php');
//$formAction = str_replace("_", " ", $_GET["formAction"]);
$formAction = $_GET["formAction"];
$trainerToAdd;
//$trainerFirstName = str_replace("_", " ", $_POST["$trainerFirstName"]);

if ($formAction == 'addtrainer') {
    //$trainerToAdd = __constructtrainer('new', null, null, null, null);
    //$trainerToAdd = new trainer('new', null, null, null, null);
} 
else if ($formAction == 'confirmAdd') {
    //$newtrainer = new trainer($trainerFirstName, $color, $breed, $pastureNum, $colorRank);
    //$trainertoAdd = new trainer($trainerFirstName, $color, $breed, $pastureNum, $colorRank);

    //$trainerFirstName isn't passed through for some reason!
    $trainerFirstName = $_POST['trainerFirstName'];
    $trainerLastName = $_POST['trainerLastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $username= $_POST['username'];
    $password= $_POST['password']
    

    //trainerColorRank isn't passed through for some reason!
    //$trainerLastNameRank = $_POST['colorRank'];
    //$trainerToAdd = __constructtrainer($trainerFirstName, $trainerLastName, $phoneNumber, $trainerPastureNum, $trainerLastNameRank);
    $trainerToAdd = new Trainer($trainerFirstName, $trainerLastName, $phoneNumber, $username, $password);
}
else {
    $trainerToAdd = retrieve_trainer($name);
    if (!$trainer) {
        echo('<p name="error">Error: there\'s no trainer with this name in the database</p>' . $name);
        die();
    }
}

function process_form($trainerFirstName,$trainer) {
    /*
    if ($trainer->get_$trainerFirstName()=="new")
        //$trainerFirstName = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['$trainerFirstName']))));
        $trainerFirstName = $_POST['$trainerFirstName'];
    else
        $trainerFirstName = $trainer->get_$trainerFirstName();
    */
    /*
    $trainerFirstName = $_POST['$trainerFirstName'];
    $color = $_POST['color'];
    $breed = $_POST['breed'];
    $pastureNum = $_POST['pastureNum'];
    $colorRank = $_POST['colorRank'];
    
    $trainer = new trainer($trainerFirstName, $color, $breed, $pastureNum, $colorRank);
    */
    //try to add a new person to the database
    if ($_POST['old_name']=='new') {

        //check if there's already an entry
        //echo("<p>LETS ADD!!!!!!</p>");
        //echo("<br>");
        $dup = retrieve_trainer($trainerFirstName);
        //echo("<p>!!!" . $dup . "!!!!</p><br>");
        if ($dup == true) {
            echo('<p class="error">Unable to add to the database. <br>Another trainer named ' . $trainerFirstName . ' already exists.<br><br>'); 
            echo('<p>If you wish to add another trainer, please click "Add trainer" after "trainer Actions."</p>');
        }
        else {            
            //echo("<p>ADDING TRAINER</p><br>");
            $result = add_trainer($trainer);
            //echo('<p>Result: ' . $result . ".");
            //echo("<br>");
            if (!$result) 
                echo('<p class="error">Unable to add trainer to the database. <br>Please report this error.');
            else 
                echo('<p>You have successfully added ' . $trainer->get_$trainerFirstName() . ' to the database. If you wish to add another trainer, please click "Add trainer" after "trainer Actions."</p>');
        }
    }
}

?>
<html>
    <head>
        <title>
            <?PHP
            
                //If the user navigated here from the home page and wants to add a trainer,
                if($formAction == 'addtrainer')  {

                    //Display "Enter trainer Information
                    echo('Enter trainer information');
                }
                else if($formAction == 'confirmAdd') {
                    echo('Add trainer');
                }
                else {
                    echo("IDK");
                }
            ?>
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <script src="lib/jquery-1.9.1.js"></script>
        <script src="lib/jquery-ui.js"></script>      
    </head>
    <body>
        <div id="container">
            <?PHP include('am_header.php'); ?>
            <div id="content">
                <?PHP 

                //If the user navigates here from the home page,
                if($formAction == 'addtrainer') {

                    //show the trainer form.
                    include('am_trainerForm.inc');
                }

                //Otherwise, 
                else if($formAction == 'confirmAdd') {
                    
                    //attempt to validate and process the form.
                    include('am_trainerValidate.inc'); 
                    if ($_POST['_form_submit'] != 1) {
                        //in this case, the form has not been submitted, so show it
                        include('am_trainerForm.inc');
                    }
                    else {
                        //in this case, the form has been submitted, so validate it
                        $errors = validate_form($trainer);
                        //errors array lists problems on the form submitted

                        if ($errors) {

                            //display the errors and the form to fix
                            show_errors($errors);
                            include('am_trainerForm.inc');
                            //$trainer = new trainer($trainer->get_$trainerFirstName(), $_POST['color'], $_POST['breed'], $_POST['pastureNum'], $_POST['colorRank']);
                        }

                        //this was a successful form submission; attempt to update the database.
                        else {
                            /*
                            echo('<p>trainer name: ' . $trainerToAdd->get_$trainerFirstName() . '.</p>');
                            echo("<br>");
                            echo('<p>trainer color: ' . $trainerToAdd->get_color() . '.</p>');
                            echo("<br>");
                            echo('<p>trainer breed: ' . $trainerToAdd->get_breed() . '.</p>');
                            echo("<br>");
                            echo('<p>trainer pasture number: ' . $trainerToAdd->get_pastureNum() . '.</p>');
                            echo("<br>");

                            //$trainerToAdd->get_colorRank() works, but $colorRank doesn't!
                            echo('<p>trainer color rank: ' . $trainerToAdd->get_colorRank() . '.</p>');
                            echo("<br>");
                            */
                            process_form($trainerFirstName,$trainerToAdd);
                            echo ('</div>');
                       //include('footer.inc');
                            echo('</div></body></html>');
                            die();
                        }
                    } 
                }
                else {

                }
               /*
                 * sanitizes data, concatenates needed data, and enters it all into a database
                 */
                /*
                function process_form($trainerFirstName,$trainer) {
                    if ($trainer->get_$trainerFirstName()=="new")
                        //$trainerFirstName = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['$trainerFirstName']))));
                        $trainerFirstName = $_POST['$trainerFirstName'];
                    else
                        $trainerFirstName = $trainer->get_$trainerFirstName();
                    $color = $_POST['color'];
                    $breed = $_POST['breed'];
                    $pastureNum = $_POST['pastureNum'];
                    $colorRank = $_POST['colorRank'];
                    
                    //try to add a new person to the database
                    if ($_POST['old_name']=='new') {
                        //check if there's already an entry
                        $dup = retrieve_trainer($trainerFirstName);
                        if ($dup) 
                            echo('<p class="error">Unable to add to the database. <br>Another trainer with the same name already exists.'); 
                        else {
                            $newtrainer = new trainer($trainerFirstName, $color, $breed, $pastureNum, $colorRank);
                            $result = add_trainer($newtrainer);
                            if (!$result) 
                                echo('<p class="error">Unable to add trainer to the database. <br>Please report this error.');
                            else 
                                echo('<p>You have successfully added trainer to the database. </p>');
                        }
                    }
                }
                */
                ?>
            </div>
            <?PHP //include('footer.inc'); ?>
        </div>
    </body>
</html>    