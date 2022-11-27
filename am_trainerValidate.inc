<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * validate_form validates the form data, checking all legality.
 * it returns are array of the errors with the form (string warnings)
 * this array is null (aka false) if there are no errors
 */
function validate_form($trainer) {
    if ($_POST['trainerFirstName'] == null)
        $errors[] = 'Please enter a trainer first name';
    if ($_POST['trainerLastName'] == null)
        $errors[] = 'Please enter a trainer last name';
    if ($_POST['phoneNumber'] == null)
        $errors[] = 'Please enter a phone number';
    if ($_POST['username'] == null) 
        $errors[] = 'Please enter a username';
    if ($_POST['password'] == null)
        $errors[] = 'Please enter a password';
    return $errors;
}
function show_errors($e) {
    //this function should display all of the errors
    echo('<div class="warning">');
    echo('<ul>');
    foreach ($e as $error) {
        echo("<li><strong><font color=\"red\">" . $error . "</font></string></li>\n");
    }
    echo("</ul></div></p>");
}
?>
