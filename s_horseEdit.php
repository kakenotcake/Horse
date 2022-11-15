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
$horseToEdit;
$oldName;
$oldCol;
$oldNum;
$oldBreed;
$oldColLvl;

//$horseName = str_replace("_", " ", $_POST["horseName"]);
function process_form($title, $horseToEdit, $action){

    if($action == "add"){
        $dup = retrieve_horse($title);
        if($dup == true){

            echo('<p class="error">Unable to alter the database. <br>Another horse named ' . $title . ' already exits.<br><br>');
            echo('<p>If you wish to add another behavior, please click "Add Horse" after "Horse Actions. " </p>');
        }
        else{
            $result = make_a_horse($horseToEdit);
            echo('<p>Result: ' . $result . ".");

            if(!$result)
            echo('<p class ="error">Unable to add to the database. <br>Please report this error.');
            else
                echo('<p>You have successfully added ' . $horseToEdit->get_horseName()) . ' to the database! If you wish to add another horse, please click "Add Horse" after "Horse Actions."</p>');
        }
    }else if($action == "edit"){

        echo('<p>old name FROM process_form: ' .$title . '.</p>');
        $result = edit_horse($title, $horseToEdit);

        if(!$result)
            echo('<p class="error">Unable to edit to the database. <br> Please report this error.');
        else 
            echo('<p>You have successfully edited' . $horseToEdit->get_horseName() . ' to the database! If you wish to edit another horse, please click "Edit Horse" after "Horse Actions. "</p>');

    }else{
        echo("Dont know how it got here");
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>
<?php



if($formAction == 'editHorse'){
    echo('Edit Horse information');

}else if($formAction == "confirmEdit"){
    echo('Edit Horse');

}else if($formAction == 'selectHorse'){
    echo("Select Horse to Edit");
}else if($formAction == 'addHorse'){
    echo("Add Horse Information");
}else if($formAction == 'confirmAdd'){
    echo("Add Horse");
}
else {
    
        echo('<p name="error">Error: there\'s no horse with this name in the database</p>' . $name);
        die();
    
}
?>

</title><link rel = "stylesheet" href="lib/jquery-ui.css"/>
<link rel="styleseet" href="styles.css" type = "text/css"/>
<script src="lib/jquery-1.9.1.js"></script>
<script src = "lib/jquery-ui.js"></script>
</head>
<body>

        <div id="container">
            <?PHP include('o_header.php'); ?>
            <div id="content">
                <?PHP 

                //If the user navigates here from the home page,
                if($formAction == 'editHorse') {

                    //show the horse form.
                    $oldName = $_POST['horseName'];
                    echo("<h1>Horse Name is: " . $oldName . ": </h1><br><br>");
                    include('s_horseEditForm.inc');

                }else if($formAction == 'selectHorse'){

                    include('s_selectHorseForm.inc');
                
                }else if($formAction == 'confirmEdit'){
                    include('horseValidate.inc');
                    $newName = $_POST['h_name'];
                    $newBreed = $_POST['breed'];
                    $newCol = $_POST['col'];
                    $newColLvl = $_POST['level'];
                    $newNum = $_POST['pNum'];
                   
                    if($_POST['form_submit'] != 1){
                        include('s_editHorseForm.inc');

                    }else{
                        $error = validate_form($Temp);

                        if($errors){
                            show_errors($errors);
                            include('s_editHorseForm.inc');

                        }else if((retrieve_horse($newName)) && (strcmp($oldName, $newName) != 0)){
                            echo("<p>" .$newName ." is the name of an existing behavior. Please edit this behavior, or enter another title.</p><br>");
                            include("s_editHorseForm.inc");
                        }else{
                            $horseToEdit = new Horse($newName, $newCol,$newBreed, $newNum, $newColLvl);
                            echo('<p>Horse Edited: '. $oldName. '.</p>');
                            echo('<p>Name: ' . $horseToEdit->get_name() . '.</p>');
                            echo('<p>Color: ' . $horseToEdit->get_color() . '.</p>');
                            echo('<p>Breed: '.$horseToEdit->get_breed(). '.</p>');
                            echo('<p>Pasture Number: ' .$horseToEdit->get_pastureNum(). '.</p>');
                            echo('<p>Color Rank: ' .$horseToEdit->get_colorRank. '.</p>');

                            echo("<br>");
                            process_form($oldName, $horseToEdit, "edit");
                            echo('</div>');
                            echo('</div></body></html>');
                            die();
                        }
                    }
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