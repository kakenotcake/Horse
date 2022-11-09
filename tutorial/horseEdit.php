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
include_once('domain/Horse.php');
include_once('database/dbApplicantScreenings.php');
include_once('domain/ApplicantScreeining.php');
include_once('database/dbLog/php');
$horseName = str_replace("_", " ", $_GET["horseName"]);

if ($horseName == 'new') {
    $horse = new Horse('new', null, null, null, null);
} else {
    $horse = retrieve_horse($name);
    if (!$horse) {
        echo('<p name="error">Error: there\'s no horse with this name in the database</p>' . $name);
        die();
    }
}
?>
<html>
    <head>
        <title>
            Editing <?PHP echo($horse->get_horseName()); ?>
        </title>
        <link rel="stylesheet" href="lib/jquery-ui.css" />
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <script src="lib/jquery-1.9.1.js"></script>
            <script src="lib/jquery-ui.js"></script>      
    </head>
    <body>
        <div id=""container">
            <?PHP include('header.php'); ?>
            <div id="content">
                <?PHP 
                include('horseValidate.inc'); 
                if ($_POST['_form_submit'] != 1)
                    //in this case, the form has not been submitted, so show it
                    include('horseForm.inc');
                else {
                    //in this case, the form has been submitted, so validate it
                    $errors = validate_form($horse);
                    //errors array lists problems on the form submitted
                    if ($errors) {
                        //display the errors and the form to fix
                        show_errors($errors);
                        $horse = new Horse($horse->get_horseName(), $_POST['color'], $_POST['breed'], $_POST['pastureNum'], $_POST['colorRank']);
                        include('horseForm.inc');
                    }
                    //this was a successful form submission; update the database and exit
                    else 
                        process_form($horseName,$horse);
                        echo "</div>";
                    include('footer.inc');
                    echo('</div></body></html>');
                    die();
                    
                }
                /*
                 * sanitizes data, concatenates needed data, and enters it all into a database
                 */
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
                ?>
            </div>
            <?PHP include('footer.inc'); ?>
        </div>
    </body>
</html>    