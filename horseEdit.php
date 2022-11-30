<?php
/*
 * Copyright 2015 by Allen Tucker. This program is part of RMHC-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/*
 * 	behaviorEdit.php
 *  oversees the editing of a behavior to be added, edited, or deleted from the database
 */

session_start();
session_cache_expire(30);
include_once('database/horsedb.php');
include_once('database/dbinfo.php');
include_once('domain/Horse.php');

$formAction = $_GET["formAction"];
$horseToAdd;
$horseToEdit;
$oldName;
$oldColor;
$oldBreed;
$oldPastNum;
$oldColRank;


function process_form($name, $horse, $action) {

    //If the user used the form to add a behavior, 
    if ($action == "add") {

        //try to add a new behavior to the database.

        //check if there's already an entry
        $dup = retrieve_behavior($title);

        //If there's already a behavior with this title,
        if ($dup == true) {

            //print an error message.
            echo('<p class="error">Unable to alter the database. <br>Another behavior named ' . $title . ' already exists.<br><br>'); 
            echo('<p>If you wish to add another behavior, please click "Add Behavior" after "Behavior Actions."</p>');
        }

        //Else, this behavior would be a new entry,
        else {            

            //so add it to the database.
            $result = add_behavior($behavior);

            //Another check to see if the behavior to add already exists.
            if (!$result) 
                echo('<p class="error">Unable to add to the database. <br>Please report this error.');
            else 
                echo('<p>You have successfully added ' . $behavior->get_title() . ' to the database! If you wish to add another behavior, please click "Add Behavior" after "Behavior Actions."</p>');
        }
    }

    //Else, if the user used the form to edit a behavior,
    else if($action == "edit") {

        //edit the existing behavior in the database.
        $result = edit_behavior($title, $behavior);

        if (!$result) 
            echo('<p class="error">Unable to edit the database. <br>Please report this error.');
        else 
            echo('<p>You have successfully edited the database! If you wish to edit another behavior, please click "Edit Behavior" after "Behavior Actions."</p>');
    }

    //Else, the user wants to remove a behavior (FOR LATER),
    else {

        //so remove a behavior from the database.
        //echo("<h1>Title of behavior to remove is " . $behavior->get_title() . "!</h1>");
        $result = remove_behavior($behavior->get_title());
        if (!$result) 
            echo('<p class="error">Unable to remove from the database. <br>Please report this error.');
        else 
            echo('<p>You have successfully removed ' . $behavior->get_title() . ' the database! If you wish to remove another behavior, please click "Remove Behavior" after "Behavior Actions."</p>');
    }
}

?>
<html>
    <head>
        <title>
            <?PHP
            
                //Set the page title based on what the user wants to do.
                if($formAction == 'searchHorse') {
                    echo("Search Horse");
                }
                else if($formAction == 'addHorse')  {
                    echo('Add Horse information');
                }
                else if($formAction == 'confirmAdd') {
                    echo('Add Horse');
                }
                else if($formAction == 'selectHorse') {
                    echo("Select Horse to Edit");
                }
                else if($formAction == 'editHorse') {
                    echo("Edit Horse Information");
                }
                else if($formAction == 'confirmEdit') {
                    echo("Edit Horse");
                }
                else if($formAction == 'removeHorse') {
                    echo("Select Horse to Remove");
                }
                else { //$formAction == 'confirmRemove'
                    echo("Remove Horse");
                }
            ?>
        </title>
        <style>
            th, tr, td 
            {
                border-left: 1px solid black;
                border-right: 1px solid black;
                border-top: 1px solid black;
                border-bottom: 1px solid black;
            }
        </style>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <script src="lib/jquery-1.9.1.js"></script>
        <script src="lib/jquery-ui.js"></script>      
    </head>
    <body>
        <div id="container">
            <?PHP include('o_header.php'); ?>
            <div id="content">
                <?PHP 

                //If the user wanted to search all behaviors,
                if($formAction == 'searchHorse') {

                    //Retrieve and show all of the behaviors in a table.
                    $allHorses = getall_horsedb();

                    echo("<h2><strong>List of Horse</strong></h2>");
                    echo("<br>");
                    echo("<table>
                            <tr>
                                <th>Name</th>
                                <th>Color</th>
                                <th>Breed</th>
                                <th>Pasture Number</th>
                                <th>Color Rank</th>
                            </tr>");
                    
                    for($x = 0; $x < count($allHorses); $x++) {
                        echo("<tr>
                                <td> " . $allHorses[$x]->get_horseName() . " </td>
                                <td style='border-left: 1px solid black'> " . $allHorses[$x]->get_color() . " </td>
                                <td style='border-left: 1px solid black'> " . $allHorses[$x]->get_breed() . " </td>
                                <td style='border-left: 1px solid black'> " . $allHorses[$x]->get_pastureNum() . " </td>
                                <td style='border-left: 1px solid black'> " . $allHorses[$x]->get_colorRank() . " </td>


                            </tr>");
                    }
                    
                    echo("</table>");  
                }
                //Else, if the user wants to add a behavior,
                else if($formAction == 'addHorse') {


                    //show the form to add/edit behavior information.
                    include('o_editBehaviorForm.inc');
                }

                //Else, if the user has submitted behavior information to add,
                else if($formAction == 'confirmAdd') {

                    //attempt to validate and process the form.
                    include('o_behaviorValidate.inc'); 

                    //If the form has not been submitted (somehow),
                    if ($_POST['_form_submit'] != 1) {

                        //show it again.
                        include('o_behaviorEditForm.inc');
                    }

                    //Else, the form has been submitted,
                    else {

                        //so retrieve the form answers and validate it.
                        $newTitle = $_POST['behaviorTitle'];
                        $newLevel = $_POST['behaviorLevel'];
                        $newBehavior = new Behavior($newTitle, $newLevel);

                        $errors = validate_form($newBehavior);
                        //errors array lists problems on the form submitted

                        //If the user left required fields blank,
                        if ($errors) {

                            //display the errors and the form to fix.
                            show_errors($errors);
                            include('o_editBehaviorForm.inc');
                            //$horse = new Horse($horse->get_horseName(), $_POST['color'], $_POST['breed'], $_POST['pastureNum'], $_POST['colorRank']);
                        }

                        //Else, this was a successful form submission,
                        else {

                            //so process the form to add a behavior.
                            process_form($newTitle, $newBehavior, "add");
                            echo ('</div>');
                       //include('footer.inc');
                            echo('</div></body></html>');
                            die();
                        }

                    }
                }

                //Else, if the user wants to edit a behavior,
                else if($formAction == 'selectHorse') {

                    //display the form for selecting a behavior to edit.
                    include('o_getHorseForm.inc');
                }

                //Else, if the user has selected a behavior to edit,
                else if($formAction == 'editHorse') {

                    //get the old title of the behavior, in case the user edited the title.
                    $oldTitle = $_POST['horseTitle'];

                    //Then, display the form for adding/editing behaviors.
                    include("editHorseForm.inc");
                }

                //Else, if the user has submitted behavior information to edit,
                else if($formAction == 'confirmEdit') {
                    
                    //attempt to validate and process the form.
                    include('o_behaviorValidate.inc'); 
                    $oldTitle = $_POST['oldTitle'];
                    $newTitle = $_POST['behaviorTitle'];
                    $newLevel = $_POST['behaviorLevel'];

                    //If the form has not been submitted (somehow).
                    if ($_POST['_form_submit'] != 1) {

                        //show the form again.
                        include('editHorseForm.inc');
                    }

                    //Else, the form has been submitted,
                    else {

                        //so validate it. BTW, the parameter doesn't matter, because "validate_form" uses the form's $_POST values, NOT the parameter.
                        $errors = validate_form($horse);
                        //errors array lists problems on the form submitted.

                        //If the user left required fields blank,
                        if ($errors) {

                            //display the errors and the form again.
                            show_errors($errors);
                            include('editHorseForm.inc');
                        }
                                
                        //Else, if the user changed the title of a behavior to a title that already exists,
                            //Conditions: (1) The behavior must exist, and (2) the user wants to change the title of the existing behavior.
                            //If the user left the title the same, then the existing behavior will be edited under the same title.
                        else if((retrieve_behavior($newTitle)) && (strcmp($oldTitle, $newTitle) != 0)) {
                            
                            //print that the user cannot change a behavior name to an existing name, and then show the form again.
                            echo("<p>" . $newTitle . " is the name of an existing behavior. Please enter another title.</p><br>");
                            include("o_editBehaviorForm.inc");
                        }
                    
                        //Else, this was a successful form submission,
                        else {

                            //so create a Behavior object and process the form to edit a behavior.
                            $behaviorToEdit = new Behavior($newTitle, $newLevel);
                            process_form($oldTitle, $behaviorToEdit, "edit");
                            echo ('</div>');
                            //include('footer.inc');
                            echo('</div></body></html>');
                            die();
                        }
                    } 
                }

                //Else, if the user wants to remove a behavior,
                else if ($formAction == 'removeHorse') { //For removing behaviors, will have "selectBehavior" and "removeBehavior" as "formAction" values.
                    
                    //display the form for selecting a behavior to remove.
                    include('getHorseForm.inc');
                }

                //FINISH LATER
                else if($formAction == 'confirmRemove') {

                    //attempt to validate and process the form.
                    include('o_horseValidate.inc'); 
                   // $oldTitle = $_POST['oldTitle'];
                   // $newTitle = $_POST['behaviorTitle'];
                   // $newLevel = $_POST['behaviorLevel'];
                        
                      $oldName = $_POST['oldTitle'];
                      //$newName = $_POST['Name'];
                      //$newColor = $_POST['Color'];
                      //$newBreed = $_POST['Breed'];
                      //$newPastNum = $_POST['PastNum'];
                      //$newColRank = $_POST['ColRank'];
                      


                    //If the form has not been submitted (somehow).
                    if ($_POST['_form_submit'] != 1) {

                        //show the form again.
                        include('editHorseForm.inc');
                    }

                    //Else, the form has been submitted,
                    else {

                        //so validate it. BTW, the parameter doesn't matter, because "validate_form" uses the form's $_POST values, NOT the parameter.
                        $errors = validate_form($horse);
                        //errors array lists problems on the form submitted.

                        //If the user left required fields blank,
                        if ($errors) {

                            //display the errors and the form again.
                            show_errors($errors);
                            include('editHorseForm.inc');
                        }
                                
                        //Else, if the user changed the title of a behavior to a title that already exists,
                            //Conditions: (1) The behavior must exist, and (2) the user wants to change the title of the existing behavior.
                            //If the user left the title the same, then the existing behavior will be edited under the same title.
                        /*
                        else if((retrieve_behavior($newTitle)) && (strcmp($oldTitle, $newTitle) != 0)) {
                            
                            //print that the user cannot change a behavior name to an existing name, and then show the form again.
                            echo("<p>" . $newTitle . " is the name of an existing behavior. Please enter another title.</p><br>");
                            include("o_editBehaviorForm.inc");
                        }
                        */
                    
                        //Else, this was a successful form submission,
                        else {

                            //so create a Behavior object and process the form to remove a behavior.
                            //$horseToRemove = new Horse($Name, $Color, $Breed, $PastNum, $ColRank);
                            $horseToRemove = retrieve_horse($oldName);
                            
                            process_form($oldTitle, $horseToRemove, "remove");
                            echo ('</div>');
                            //include('footer.inc');
                            echo('</div></body></html>');
                            die();
                        }
                    } 

                }

                ?>
            </div>
            <?PHP //include('footer.inc'); ?>
        </div>
    </body>
</html>    