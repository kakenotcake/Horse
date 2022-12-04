<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * assignmentForm.inc
 * shows a form for assigning trainers to horses OR assigning horses to behaviors
 * 
 */

?>


<?php

    //Display the form instructions based on what the user wants to do.
    //Also, change the form's destination URL based on what the user wants to do.
    if($formAction == "assignTrainer") {

        echo("<p><strong>Trainer Assignment</strong></p>");
        echo("<p>Use the first dropdown menu to select a trainer to assign.</p>");
        echo("<p>Then, use the second dropdown menu to select a horse to assign the trainer to.</p>");
        echo("<p>When finished, hit <b>Assign Trainer</b> at the bottom of this page.</p>");

        echo("<form method='POST' action='/Horse/trainingAction.php?formAction=confirmAssign'>);
        echo("<input type='hidden' name='assignVal' value='Trainer'>");

        //Retrieve the horse names.
        $trainerNames = getall_trainer_names();

        //Put the horse names in the second dropdown menu.
        echo("<label for='trainerSelect'>Trainer Name: </label>");
        echo("<select id='trainerSelect' name='trainerName' tabindex='1'>");
        foreach ($trainerNames as $T) {
            echo("<option value=" . $T . ">" . $T . "</option>");
        }
        echo("</select><br><br>");

        //Retrieve the horse names.
        $horseNames = getall_horse_names();

        //Put the horse names in the second dropdown menu.
        echo("<label for='horseSelect'>Horse Name: </label>");
        echo("<select id='horseSelect' name='horseName' tabindex='1'>");
        foreach ($horseNames as $H) {
            echo("<option value=" . $H . ">" . $H . "</option>");
        }
        echo("</select><br>");
        echo("<input type='submit' value='Assign Trainer'/></form>");
    }
    else {

        echo("<p><strong>Horse Assignment</strong></p>");
        echo("<p>Use the first dropdown menu to select a horse to assign.</p>");
        echo("<p>Then, use the second dropdown menu to select a behavior to assign the horse to.</p>");
        echo("<p>When finished, hit <b>Assign Horse</b> at the bottom of this page.</p>");

        echo("<form method='POST' action='/Horse/trainingAction.php?formAction=confirmAssign'>");
        echo("<input type='hidden' name='assignVal' value='Horse'>");

        //Retrieve the horse names.
        $horseNames = getall_horse_names();

        //Put the horse names in the first dropdown menu.
        echo("<label for='horseSelect'>Horse Name: </label>");
        echo("<select id='horseSelect' name='horseName' tabindex='1'>");
        foreach ($horseNames as $H) {
            echo("<option value=" . $H . ">" . $H . "</option>");
        }
        echo("</select><br><br>");

        //Retrieve the behavior names.
        $behaviorNames = getall_behavior_titles();

        //Put the behavior names in the second dropdown menu.
        echo("<label for='behaviorSelect'>Behavior Title: </label>");
        echo("<select id='behaviorSelect' name='behaviorTitle' tabindex='1'>");
        foreach ($behaviorNames as $B) {
            echo("<option value=" . $B . ">" . $B . "</option>");
        }
        echo("</select><br>");
        echo("<input type='submit' value='Assign Horse'/></form>");
    }
?>