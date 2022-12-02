<?php
/*
 * Copyright 2015 by Allen Tucker. This program is part of RMHC-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
/*
 * 	horseEdit.php
 *  oversees the editing of a horse to be added, changed, or deleted from the database
 */
session_start();
session_cache_expire(30);
include_once('database/horsedb.php');
include_once('database/dbinfo.php');
include_once('domain/Horse.php');
//$formAction = str_replace("_", " ", $_GET["formAction"]);
$formAction = $_GET["formAction"];
$horseToAdd;
//$horseName = str_replace("_", " ", $_POST["horseName"]);

if ($formAction == 'addHorse') {
    //$horseToAdd = __constructHorse('new', null, null, null, null);
    //$horseToAdd = new Horse('new', null, null, null, null);
} 
else if ($formAction == 'confirmAdd') {
    //$newhorse = new Horse($horseName, $color, $breed, $pastureNum, $colorRank);
    //$horsetoAdd = new Horse($horseName, $color, $breed, $pastureNum, $colorRank);

    //horseName isn't passed through for some reason!
    $horseName = $_POST['horseName'];
    $horseColor = $_POST['color'];
    $horseBreed = $_POST['breed'];
    $horsePastureNum = $_POST['pastureNum'];

    //horseColorRank isn't passed through for some reason!
    $horseColorRank = $_POST['colorRank'];
    //$horseToAdd = __constructHorse($horseName, $horseColor, $horseBreed, $horsePastureNum, $horseColorRank);
    $horseToAdd = new Horse($horseName, $horseColor, $horseBreed, $horsePastureNum, $horseColorRank);
}
else {
    $horseToAdd = retrieve_horse($name);
    if (!$horse) {
        echo('<p name="error">Error: there\'s no horse with this name in the database</p>' . $name);
        die();
    }
}

function process_form($horseName,$horse) {
    /*
    if ($horse->get_horseName()=="new")
        //$horseName = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['horseName']))));
        $horseName = $_POST['horseName'];
    else
        $horseName = $horse->get_horseName();
    */
    /*
    $horseName = $_POST['horseName'];
    $color = $_POST['color'];
    $breed = $_POST['breed'];
    $pastureNum = $_POST['pastureNum'];
    $colorRank = $_POST['colorRank'];
    
    $horse = new Horse($horseName, $color, $breed, $pastureNum, $colorRank);
    */
    //try to add a new person to the database
    if ($_POST['old_name']=='new') {

        //check if there's already an entry
        //echo("<p>LETS ADD!!!!!!</p>");
        //echo("<br>");
        $dup = retrieve_horse($horseName);
        //echo("<p>!!!" . $dup . "!!!!</p><br>");
        if ($dup == true) {
            echo('<p class="error">Unable to add to the database. <br>Another horse named ' . $horseName . ' already exists.<br><br>'); 
            echo('<p>If you wish to add another horse, please click "Add Horse" after "Horse Actions."</p>');
        }
        else {            
            //echo("<p>ADDING HORSE</p><br>");
            $result = add_horse($horse);
            //echo('<p>Result: ' . $result . ".");
            //echo("<br>");
            if (!$result) 
                echo('<p class="error">Unable to add horse to the database. <br>Please report this error.');
            else 
                echo('<p>You have successfully added ' . $horse->get_horseName() . ' to the database! If you wish to add another horse, please click "Add Horse" after "Horse Actions."</p>');
        }
    }
}

?>
<html>
    <head>
        <title>
            <?PHP
            
                //If the user navigated here from the home page and wants to add a horse,
                if($formAction == 'addHorse')  {

                    //Display "Enter Horse Information
                    echo('Enter Horse information');
                }
                else if($formAction == 'confirmAdd') {
                    echo('Add Horse');
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
            <?PHP include('o_header.php'); ?>
            <div id="content">
                <?PHP 

                //If the user navigates here from the home page,
                if($formAction == 'addHorse') {

                    //show the horse form.
                    include('o_horseForm.inc');
                }

                //Otherwise, 
                else if($formAction == 'confirmAdd') {
                    
                    //attempt to validate and process the form.
                    include('o_horseValidate.inc'); 
                    if ($_POST['_form_submit'] != 1) {
                        //in this case, the form has not been submitted, so show it
                        include('o_horseForm.inc');
                    }
                    else {
                        //in this case, the form has been submitted, so validate it
                        $errors = validate_form($horse);
                        //errors array lists problems on the form submitted

                        if ($errors) {

                            //display the errors and the form to fix
                            show_errors($errors);
                            include('o_horseForm.inc');
                            //$horse = new Horse($horse->get_horseName(), $_POST['color'], $_POST['breed'], $_POST['pastureNum'], $_POST['colorRank']);
                        }

                        //this was a successful form submission; attempt to update the database.
                        else {
                            /*
                            echo('<p>horse name: ' . $horseToAdd->get_horseName() . '.</p>');
                            echo("<br>");
                            echo('<p>horse color: ' . $horseToAdd->get_color() . '.</p>');
                            echo("<br>");
                            echo('<p>horse breed: ' . $horseToAdd->get_breed() . '.</p>');
                            echo("<br>");
                            echo('<p>horse pasture number: ' . $horseToAdd->get_pastureNum() . '.</p>');
                            echo("<br>");

                            //$horseToAdd->get_colorRank() works, but $colorRank doesn't!
                            echo('<p>horse color rank: ' . $horseToAdd->get_colorRank() . '.</p>');
                            echo("<br>");
                            */
                            process_form($horseName,$horseToAdd);
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
                function process_form($horseName,$horse) {
                    if ($horse->get_horseName()=="new")
                        //$horseName = trim(str_replace('\\\'', '', htmlentities(str_replace('&', 'and', $_POST['horseName']))));
                        $horseName = $_POST['horseName'];
                    else
                        $horseName = $horse->get_horseName();
                    $color = $_POST['color'];
                    $breed = $_POST['breed'];
                    $pastureNum = $_POST['pastureNum'];
                    $colorRank = $_POST['colorRank'];
                    
                    //try to add a new person to the database
                    if ($_POST['old_name']=='new') {
                        //check if there's already an entry
                        $dup = retrieve_horse($horseName);
                        if ($dup) 
                            echo('<p class="error">Unable to add to the database. <br>Another horse with the same name already exists.'); 
                        else {
                            $newhorse = new Horse($horseName, $color, $breed, $pastureNum, $colorRank);
                            $result = add_horse($newhorse);
                            if (!$result) 
                                echo('<p class="error">Unable to add horse to the database. <br>Please report this error.');
                            else 
                                echo('<p>You have successfully added horse to the database. </p>');
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