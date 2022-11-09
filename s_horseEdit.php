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

if($formAction == 'editHorse'){

}
else {
    
        echo('<p name="error">Error: there\'s no horse with this name in the database</p>' . $name);
        die();
    
}


?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>
            <?PHP
            
                //If the user navigated here from the home page and wants to add a horse,
                if($formAction == 'editHorse')  {

                    //Display "Enter Horse Information
                    echo('Enter Horse information');
                }else {
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
                if($formAction == 'editHorse') {

                    //show the horse form.
                    include('s_horseEditForm.inc');
                }
                else{
                    echo("nothing is working");

                }
            
                ?>
            </div>
            <?PHP //include('footer.inc'); ?>
        </div>
    </body>
</html>    