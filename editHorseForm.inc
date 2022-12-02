

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * editBehaviorForm.inc
 * shows a form for a behavior to be added or edited in the database
 * 
 */

?>


<?php

    //Display the form instructions based on what the user wants to do.
    //Also, change the form's destination URL based on what the user wants to do.
    if($formAction == "addHorse") {

        echo("<p><strong>Add HOrse Information</strong></p>");
        echo("<p>Add horse information using the fields below.</p>");
        echo("<p>When finished, hit <b>Add Horse</b> at the bottom of this page.</p>");
        echo("<p>(<span style='font-size:x-small;color:FF0000'>*</span> denotes required information).</p>");
       
        echo("<form method='POST' action='/Horse/horseEdit.php?formAction=confirmAdd'>");
    }
    else if($formAction == "editHorse") {

        echo("<p><strong>Edit Horse Information</strong></p>");
        echo("<p>Edit the name, breed, color, pasture number, and color rank horse information as you wish. If you do not wish to change any information, please leave it untouched.</p>");
        echo("<p>Please use the dropdown menu to select the horse you want to edit.</p>");
        echo("<p>When finished, hit <b>Edit Horse</b> at the bottom of this page.</p>");
        echo("<p>(<span style='font-size:x-small;color:FF0000'>*</span> denotes required information).</p>");

        echo("<form method='POST' action='/Horse/horseEdit.php?formAction=confirmEdit'>");
    }
    else { //The user wants to remove a behavior
        echo("<form method='POST' action='/Horse/horseEdit.php?formAction=confirmEdit'>");
    }
?>
    <input type="hidden" name="old_name" value="new">
    <input type="hidden" name="_form_submit" value="1">
    <?PHP
        //If the user is editing an existing behavior, pass the existing title in "oldTitle" back to "o_behaviorEdit.php" for editing purposes.
        echo("<input type='hidden' name='oldName' value='$oldName'/>");
    ?>
    <fieldset>
        <legend>Horse Name:</legend>
        <?php

            //Set the value of the behavior title input field as the old title. If the user is adding to the database, the field is blank, as there's no old title.
            echo("<p>Horse Name<span style='font-size:x-small;color:FF0000'>*</span>: <input type='text' name='horseName' tabindex='1' value='$oldName'></p>");
            echo("<p>Breed<span style='font-size:x-small;color:FF0000'>*</span>: <input type='text' name='breed' tabindex='1' value='$oldBreed'></p>");
            echo("<p>Color<span style='font-size:x-small;color:FF0000'>*</span>: <input type='text' name='color' tabindex='1' value='$oldColor'></p>");
            echo("<p>Pasture Number<span style='font-size:x-small;color:FF0000'>*</span>: <input type='text' name='pastureNum' tabindex='1' value='$oldPastureNum'></p>");
        ?>
        <p>Color Rank<span style="font-size:x-small;color:FF0000"></span>:
            <select name="colorRank" tabindex="1">
                <?PHP
                
                //create an array of the color ranks
                $colorRanks = array("Green", "Yellow", "Red");
                foreach ($colorRanks as $color) {
                    echo "<option value=" . $color . ">" . $color . "</option>";
                }
                ?>
            </select>
          
        

        <script src="lib/>jquery-1.9.1.js"></script>
        <script src="lib/>jquery-ui.js"></script>
    </fieldset>
    <br>
    <?PHP

        //Display the appropriate submit button text based on what the user wants to do.
        if($formAction == "addHorse") {
            echo("<input type='submit' value='Add Horse'/>");
        }
        else if ($formAction == "editHorse") {
            echo("<input type='submit' value='Edit Horse'/>");
        }
        else {
            echo("<input type='submit' value='Submit Horse Information'/>");
        }
    ?>
</form>