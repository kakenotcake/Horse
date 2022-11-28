<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
session_cache_expire(30);
include_once('database/behaviordb.php');
include_once('database/dbinfo.php');
include_once('domain/Behavior.php');
$formAction = $_GET["formAction"];
$behaviorToAdd;

if ($formAction == 'addBehavior') {
    
}
else if ($formAction == 'confirmAdd') {
    $title = $_POST['title'];
    $behaviorLevel = $_POST['behaviorLevel'];
    $behaviorToAdd = new Behavior($title, $behaviorLevel);
}
else {
    $behaviorToAdd = retrieve_behavior($title);
    if (!$behavior) {
        echo('<p name="error">Error: there\'s no behavior with this title in the database</p>' . $title);
        die();
        
    }
   
}
function process_form($title, $behavior) {
    if ($_POST['old_title']=='new') {
        $dup = retrieve_behavior($title);
        if ($dup) {
            echo('<p class="error">Unable to add to the database. <br>Behavior with the title ' . $title . 'already exists.');
        }
        else {
            echo("<p>ADDING BEHAVIOR</p><br>");
            $result = add_behavior($behavior);
            echo('<p>Result: ' . $result . ".");
            echo("<br>");
            if (!$result) 
                echo('<p class="error">Unable to add behavior to the database. <br>Please report this error.');
            else 
                echo('<p>You have successfully added ' . $behavior->get_title() . ' to the database.</p>');
        }
        
    }
}
?>
<html>
    <head>
        <title>
            <?PHP
                if($formAction == 'addBehavior') {
                    echo('Enter Behavior Information');
                }
                else if($formAction == 'confirmAdd') {
                    echo('Add Behavior');
                }
                else {
                    echo("Error");
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
            <?PHP include('o_header.php'); ?>
            <div id="content">
                <?PHP
                
                if($formAction == 'addBehavior') {
                    //show the add behavior form
                    include('addBehaviorForm.inc');
                }
                else if($formAction == 'confirmAdd') {
                    //attempt to validate and process the form
                    include('behaviorValidate.inc');
                    if ($_POST['_form_submit'] != 1) {
                        include('addBehaviorForm.inc');
                    }
                    else {
                        //the form has been submitted
                        $errors = validate_form($behavior);
                        //errors array list problems on the form submission
                        if ($errors) {
                            //display the errors
                            show_errors($e);
                            include('addBehaviorForm.inc');
                        }
                        //successful submission
                        else {
                            echo('<p>Behavior title: ' . $behaviorToAdd->get_title() . '.</p>');
                            echo("<br>");
                            echo('<p>Behavior level: ' . $behaviorToAdd->get_behaviorLevel() . '.</p>');
                            echo("<br>");
                            process_form($title, $behaviorToAdd);
                            echo('</div>');
                            echo('</div></body></html>');
                            die();
                        }
                    }
                }
                else {
                    
                }
                ?>
            </div>
            <?PHP ?>
        </div>
    </body>
</html>
