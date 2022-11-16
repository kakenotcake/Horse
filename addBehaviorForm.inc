<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($formAction == 'addBehavior') {
    echo('<p><strong>Add Behavior to the System.</strong><br />');
    echo('Please provide required info. ' .
            '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
    echo '<br> (<span style="font-size:x-small;color:FF0000">*</span> denotes required information).';
    
}
?>
<form method="POST" action="/Horse/Horse/behaviorAdd.php?formAction=confirmAdd">
    <input type="hidden" name="old_title" value="new">
    <input type="hidden" name="_form_submit" value="1">
    <fieldset>
        <legend>Behavior Information:</legend>
    
        <p>Behavior Title<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="title" tabindex="1">
        <p>Behavior Level<span style="font-size:x-small;color:FF0000">*</span>:<select name="behaviorLevel" tabindex="1">
               
<?PHP
$levels = array("Beginner", "Intermediate", "Advanced");
foreach($levels as $l) {
    echo "<option value=" . $l . ">" . $l . "</option>";
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
     
           

            
    

