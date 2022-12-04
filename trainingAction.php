<?php
/*
 * Copyright 2015 by Allen Tucker. This program is part of RMHC-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/*
 *  traininAction.php
 *  oversees the following training actions:
 *  1. Assignment of trainers to horses 
 *  2. Unassignment of trainers to horses 
 *  3. Assignment of behaviors to horse
 *  4. Unassignment of behaviors to horses
 *  5. Addition of training notes
 *  6. Editing of training notes
 *  7. Removal of training notes
 *  8. Searching of training notes
 */

session_start();
session_cache_expire(30);
include_once('database/dbinfo.php');
include_once('domain/Horse.php');
include_once('domain/horsedb.php'); //Horse-to-behavior assignment methods can be added here for now.
include_once('domain/Behavior.php');
include_once('database/behaviordb.php');
include_once('domain/Trainer.php');
include_once('domain/persondb.php'); //Trainer-to-horse assignment methods can be added here for now.


$formAction = $_GET["formAction"];
$behaviorToAdd;
$behaviorToEdit;
$oldTitle;

function process_form($title, $behavior, $action) {

    //If the user used the form to add a behavior, 
    if ($action == "add") {

        //try to add a new behavior to the database.

        //Check if there's already an entry.
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
        $result = remove_behavior($title); 
        if (!$result) 
            echo('<p class="error">Unable to remove from the database. <br>Please report this error.');
        else 
            echo('<p>You have successfully removed ' . $title . ' the database! If you wish to remove another behavior, please click "Remove Behavior" after "Behavior Actions."</p>');
    }
}

?>
<html>
    <head>
        <title>
            <?PHP
            
                //Set the page title based on what the user wants to do.
                if($formAction == 'searchAssignments') {
                    echo("Search Assignments");
                }
                else if($formAction == 'assignTrainer') {
                    echo("Select Trainer to Assign");
                }
                else if($formAction == 'assignBehavior') {
                    echo("Select Horse to Assign");
                }
                else if($formAction == 'confirmAssign')  {
                    if($_POST['assignVal'] == 'Trainer')
                    {
                        echo('Assign Trainer to Horse');
                    }
                    else {
                        echo('Assign Horse to Behavior');
                    }
                }
                else if($formAction == 'unassignTrainer') {
                    echo('Select Trainer to Unassign');
                }
                else if($formAction == 'unassignBehavior') {
                    echo("Select Horse to Unassign");
                }
                else { //$formAction == 'confirmUnassign
                    //Handle if assignVal is "Trainer" or "Horse"
                    echo("Unassign Trainer or Horse");
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

                //If the user wanted to search all of the trainer and horse assignments,
                if($formAction == 'searchAssignments') {

                    //Retrieve and show all of the trainer and horse assignments (LATER).

                    //$allBehaviors = getall_behaviordb();

                    echo("<h2><strong>List of assignments</strong></h2>");
                    /*
                    echo("<br>");
                    echo("<table>
                            <tr>
                                <th>Title</th>
                                <th>Level</th>
                            </tr>");
                    
                    for($x = 0; $x < count($allBehaviors); $x++) {
                        echo("<tr>
                                <td> " . $allBehaviors[$x]->get_title() . " </td>
                                <td style='border-left: 1px solid black'> " . $allBehaviors[$x]->get_behaviorLevel() . " </td>
                            </tr>");
                    }
                    
                    echo("</table>");  
                    */
                }
                //Else, if the user wants to assign a trainer to a horse,
                else if($formAction == 'assignTrainer') {


                    //show the form to assign a trainer to a horse.
                    include('assignmentForm.inc');
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
                else if($formAction == 'selectBehavior') {

                    //check if there are behaviors in the database to edit.
                    $numBehaviors = get_numBehaviors();

                    //If there aren't any behaviors in the database, 
                    if($numBehaviors == 0) {
                        echo("<p><strong>There are no behaviors to edit.</strong></p>");
                        echo('<p>Please add behaviors using the "Add Behavior" link next to "Behavior Actions".</p><br>');
                    }

                    //Else, display the form for selecting a behavior to edit.
                    else {
                        include('o_getBehaviorForm.inc');
                    }    
                }

                //Else, if the user has selected a behavior to edit,
                else if($formAction == 'editBehavior') {

                    //get the old title of the behavior, in case the user edited the title.
                    $oldTitle = $_POST['behaviorTitle'];

                    //Then, display the form for adding/editing behaviors.
                    include("o_editBehaviorForm.inc");
                }

                //Else, if the user has submitted behavior information to edit,
                else if($formAction == 'confirmEdit') {
                    
                    include('o_behaviorValidate.inc'); 
                    $oldTitle = $_POST['oldTitle'];
                    $newTitle = $_POST['behaviorTitle'];
                    $newLevel = $_POST['behaviorLevel'];

                    //attempt to validate and process the form.
                    //If the form has not been submitted (somehow, cuz this code shouldn't run),
                    if ($_POST['_form_submit'] != 1) {

                        //show the form again.
                        include('o_editBehaviorForm.inc');
                    }

                    //Else, the form has been submitted,
                    else {

                        //so validate it. BTW, the parameter doesn't matter, because "validate_form" uses the form's $_POST values, NOT the parameter.
                        $errors = validate_form($behavior);
                        //errors array lists problems on the form submitted.

                        //If the user left required fields blank,
                        if ($errors) {

                            //display the errors and the form again.
                            show_errors($errors);
                            include('o_editBehaviorForm.inc');
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
                else if ($formAction == 'removeBehavior') { //For removing behaviors, will have "selectBehavior" and "removeBehavior" as "formAction" values.
                    
                    //check if there are behaviors in the database to edit.
                    $numBehaviors = get_numBehaviors();
                    
                    //If there aren't any behaviors in the database, 
                    if($numBehaviors == 0) {
                        echo("<p><strong>There are no behaviors to remove.</strong></p>");
                        echo('<p>Please add behaviors using the "Add Behavior" link next to "Behavior Actions".</p><br>');
                    }

                    //Else, display the form for selecting a behavior to edit.
                    else {
                        include('o_getBehaviorForm.inc');
                    }  
                }

                else if($formAction == 'confirmRemove') {

                    //attempt to validate and process the form.
                    include('o_behaviorValidate.inc'); 
                    $oldTitle = $_POST['behaviorTitle'];

                    //If the form has not been submitted (somehow).
                    if ($_POST['_form_submit'] != 1) {

                        //show the form again.
                        include('o_editBehaviorForm.inc');
                    }

                    //Else, the form has been submitted,
                    else {

                        //so validate it. BTW, the parameter doesn't matter, because "validate_form" uses the form's $_POST values, NOT the parameter.
                        $errors = validate_form($behavior);
                        //errors array lists problems on the form submitted.

                        //If the user left required fields blank,
                        if ($errors) {

                            //display the errors and the form again.
                            show_errors($errors);
                            include('o_editBehaviorForm.inc');
                        }
                                                    
                        //Else, this was a successful form submission,
                        else {

                            //so create a Behavior object and process the form to remove a behavior.
                            //Removing only requires the name, so this behavior is created JUST to have a valid parameter.
                            $behaviorToRemove = new Behavior($oldTitle, $newLevel);
                            process_form($oldTitle, $behaviorToRemove, "remove");
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