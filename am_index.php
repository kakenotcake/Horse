<?php
/*
 * Copyright 2015 by Allen Tucker. This program is part of RMHP-Homebase, which is free 
 * software.  It comes with absolutely no warranty. You can redistribute and/or 
 * modify it under the terms of the GNU General Public License as published by the 
 * Free Software Foundation (see <http://www.gnu.org/licenses/ for more information).
 */
session_start();
session_cache_expire(30);
?>
<html>
    <head>
        <title>
            CVHR Horse Training Management System
        </title>
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <style>
        	#appLink:visited {
        		color: gray; 
        	}
        </style> 
    </head>
    <body>
        <div id="container">
            <?PHP include('am_header.php'); ?>
            <div id="content">
                <?PHP
                include_once('../domain/Horse.php');
                include_once('../database/dbinfo.php');
                include_once('../database/horsedb.php');
                //include_once('database/dbPersons.php');
                //include_once('domain/Person.php');
                //include_once('database/dbLog.php');
                //include_once('domain/Shift.php');
                //include_once('database/dbShifts.php');
                date_default_timezone_set('America/New_York');
                
                    ?>
                    </div>
                    <?PHP //include('footer.inc'); ?>
        </div>
    </body>
</html>