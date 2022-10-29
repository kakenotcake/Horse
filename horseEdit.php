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
            <div id=""content">
                <?PHP include('horseForm.inc'); ?>
            </div>
            <?PHP include('footer.inc'); ?>
        </div>
    </body>
</html>    