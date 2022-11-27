<?php
/*
 * Copyright 2013 by Allen Tucker. 
 * This program is part of RMHP-Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */
?>
<!-- Begin Header -->
<style type="text/css">
    h1 {padding-left: 0px; padding-right:165px;}
</style>
<div id="header">

</div>

<div align="center" id="navigationLinks">
    <?PHP    
        echo("<br><b>"."CVHR Horse Training Management System"."</b> ");
        echo('<br><br>');
        echo('<a href="' . $path . 'o_index.php">home</a>');
        echo(' | <a href="' . $path . 'about.php">about</a>');
        echo('</br>');
        //echo(' | <a href="' . $path . 'help.php?helpPage=' . $current_page . '" target="_BLANK">help</a>');
        //echo(' | calendars: <a href="' . $path . 'calendar.php?venue=portland'.''.'">Portland, </a>');
        //echo(' <a href="' . $path . 'calendar.php?venue=bangor'.''.'">Bangor</a>');
        //echo('<br>master schedules: <a href="' . $path . 'viewSchedule.php?venue=portland'."".'">Portland, </a>');
        //echo('<a href="' . $path . 'viewSchedule.php?venue=bangor'."".'">Bangor</a>');
        echo('<br>');
        echo('<strong>Horse Actions</strong> (Only "Add Horse" works) | <a href="' . $path . 'personSearch.php"><u>Search Horses</u></a>, 
                         <a href="o_horseEdit.php?formAction=addHorse"><u>Add Horse</u></a>, 
                         <a href="o_horseEdit.php?horseName=' . 'edit' . '"><u>Edit Horse</u></a>,
                         <a href="viewScreenings.php?type=new"><u>screenings</u></a>,
                         <u>Remove Horse</u>');
        echo('<br><br>');
        echo('<strong>Behavior Actions</strong> (In progress, links later!) | <a href="' . $path . 'personSearch.php"><u>Search Behaviors</u></a>, 
                         <a href="o_horseEdit.php?horseName=' . 'new' . '"><u>Add Behavior</u></a>, 
                         <a href="o_horseEdit.php?horseName=' . 'edit' . '"><u>Edit Behavior</u></a>,
                         <a href="viewScreenings.php?type=new"><u>screenings</u></a>,
                         <u>Remove Behavior</u>');
        echo('<br><br>');
         echo('<strong>Trainer Actions</strong> (In progress, links later!) | <a href="' . $path . 'personSearch.php"><u>Search Trainers</u></a>, 
                         <a href="o_horseEdit.php?horseName=' . 'new' . '"><u>Add Trainer</u></a>, 
                         <a href="o_horseEdit.php?horseName=' . 'edit' . '"><u>Edit Trainer</u></a>,
                         <a href="viewScreenings.php?type=new"><u>screenings</u></a>,
                         <u>Remove Trainer</u>');

        //echo(' | <a href="' . $path . 'reports.php?venue='.$_SESSION['venue'].'">reports</a>');
        //echo(' | <a href="' . $path . 'logout.php">logout</a><br>');


    //Log-in security
    //If they aren't logged in, display our log-in form.
    
    ?>
</div>
<!-- End Header -->