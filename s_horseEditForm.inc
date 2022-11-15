<?php
//$con = mysqli_connect("localhost", "root", "", "homebasedb");
//$sql = "SELECT horseName FROM 'horsedb'";
//$all_horses = mysqli_query($con, $sql);

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
if ($_SESSION['access_level'] == 0) {
    echo('<p><strong>Edit Horse in the System.</strong><br />');
    echo('Please select a horse to edit. ' . 
            '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
} else if ($_SESSION['access_level'] == 1)
    if ($_SESSION['_id'] != $person->get_id()) {
        echo("<p id=\"error\">You do not have sufficient permissions to edit this user.</p>");
        //include('footer.inc');
        echo('</div></div></body></html>');
        die();
    } else {
        echo '<p><strong>Horse Edit Form</strong>';
        echo(' Here you can edit horse information in the database.' .
        '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
    } else if ($_SESSION['access_level'] == 2)
        if ($horseName == 'new') {
            echo('<p><strong>Add Horse Form</strong><br />');
            echo('Adding a new horse to the database. ' .
            '<br>When finished, hit <b>Submit</b> at the bottom of this page.');
            
        } else {
            echo("<p id=\"error\">You do not have sufficient permission to add a new horse to the database.</p>");
            //include('footer.inc');
            echo('</div></div></body></html>');
            die();
        }
    echo '<br> (<span style="font-size:x-small;color:FF0000">*</span> denotes required information).';
?> 

<form method="POST" action="/Horse/s_horseEdit.php?formAction=horseChosen">
    <input type="hidden" name="old_name" value="new">
    <input type="hidden" name="_form_submit" value="1">
    <fieldset>
        <legend>Horse Information:</legend>
    <?php
        /*
        if ($horse->get_horseName()=='new') {
            echo '<p>First Name<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="horseName" tabindex="1" value="'.$horse->get_horseName().'">';
        }
        else {
            echo '<p>First Name: '.$horse->get_horseName();
        }
         
        */
         //echo '<p>Horse Name<span style="font-size:x-small;color:FF0000">*</span>: <input type="text" name="horseName" tabindex="1" value="test">';
    ?>

        <p>Horse Name (type a few letters): 
        <input type="text" name="h_name">
        <p>Color of Horse: 
        <input type = "text" name ="col">
        <p> Pature Number: 
        <input type = "text" name="pNum">
        <p>Breed: 
        <input type = "text" name="breed">
        <p>Color Level:
        <input type = "text" name="level";

        
<?PHP

    ?>

<script src="lib/>jquery-1.9.1.js"></script>
<script src="lib/>jquery-ui.js"></script>
</fieldset>
    <p>
        <?PHP
        echo('Hit <input type="submit" value="Submit" name="Submit Edits"> to submit these edits.<br /><br />');

    ?>
</form>


<?php
/*if($_POST['Submit']){
    $name = trim(str_replace('\'', '&#39;',htmlentities($_POST['h_name'])));
    $result = getonlythose_horseDB($name);
    <p><strong>Search Results: </strong>
    <p>Found sizeof($result);

    if(sizeof($result) > 0){
        echo('(select one for more info)');
        echo('div id = "target" style="overflow: scroll; width: variable; height: 400px;">');
        echo('<p><table><tr><td>Name</td></tr>');
        foreach($result as $vol){
            str_replace(" ", "_",$vol->get_id()) . ">".
            $vol->get_horseName() "</td></tr"
        }
    }
    echo '</table>';
    echo '</div>';

}
*/
?>
