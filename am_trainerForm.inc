<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * horseForm.inc
 * shows a form for a person to be added or edited in the database
 * 
 */

//Comment session branch out, keep the "if($horseName == 'new") branch!

if($formAction == 'addTrainer') {
    echo('<p><strong>Add Trainer to the System.</strong><br />');
    echo('Please provide as much information as you can about the trainer. ' . 
            '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
    echo '<br> (<span style="font-size:x-small;color:FF0000">*</span> denotes required information).';

}

if ($formAction == 'edit') {
    //Have edit text
    //Have edit form for selecting trainer by name (redirects to this page) with $formAction = 'canEdit'


}
if($formAction = 'canEdit')
{
    //Display all fields BUT name to edit
    //Pass $formAction = 'confirmEdit'
}

/*
if ($_SESSION['access_level'] == 0) {
    echo('<p><strong>Add Trainer to the System.</strong><br />');
    echo('Please provide as much information as you can about the trainer. ' . 
            '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
} else if ($_SESSION['access_level'] == 1)
    if ($_SESSION['_id'] != $person->get_id()) {
        echo("<p id=\"error\">You do not have sufficient permissions to edit this user.</p>");
        //include('footer.inc');
        echo('</div></div></body></html>');
        die();
    } else {
        echo '<p><strong>Trainer Edit Form</strong>';
        echo(' Here you can edit trainer information in the database.' .
        '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
    } else if ($_SESSION['access_level'] == 2)
        if ($horseName == 'new') {
            echo('<p><strong>Add Trainer Form</strong><br />');
            echo('Adding a new trainer to the database. ' .
            '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
            
        } else {
            echo("<p id=\"error\">You do not have sufficient permission to add a new trainer to the database.</p>");
            //include('footer.inc');
            echo('</div></div></body></html>');
            die();
        }

    echo '<br> (<span style="font-size:x-small;color:FF0000">*</span> denotes required information).';
*/
?>
<form method="POST" action="/Trainer/o_horseEdit.php?formAction=confirmAdd">
    <input type="hidden" name="old_name" value="new">
    <input type="hidden" name="_form_submit" value="1">
    <fieldset>
        <legend>Trainer Information:</legend>
    <?php
        /*
        if ($horse->get_horseName()=='new') {
            echo '<p>First Name<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="horseName" tabindex="1" value="'.$horse->get_horseName().'">';
        }
        else {
            echo '<p>First Name: '.$horse->get_horseName();
        }
         
        */
         //echo '<p>Trainer Name<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="horseName" tabindex="1" value="test">';
    ?>
        <p>Trainer Name<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="horseName" tabindex="1" value="Horace">'
        <p>Color<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="color" tabindex="1" value="Rainbow">
        <p>Breed<span style="font-size:x-small;color:FF0000"></span>: <input type="text" name="breed" tabindex="1" value="Different">
        <p>Pasture Number (Number between 1 and 11)<span style="font-size:x-small;color:FF0000">*</span>: <input type="number" name="pastureNum" min="1" max="11" value="1">
        <p>Color Rank<span style="font-size:x-small;color:FF0000">*</span>:<select name="colorRank" tabindex="1"> 
<?PHP
$colorRanks = array("Green", "Yellow", "Red");
foreach ($colorRanks as $cr) {
    echo "<option value=" . $cr . ">" . $cr . "</option>";
}
?>
</select>
<script src="lib/>jquery-1.9.1.js"></script>
<script src="lib/>jquery-ui.js"></script>
</fieldset>
    <p>
        <?PHP
        echo('Hit <input type="submit" value="Submit" name="Submit Edits"> to submit these edits.<br /><br />');

    ?>
</form>