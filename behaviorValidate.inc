<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function validate_form($behavior) {
    if ($_POST['title'] == null)
        $errors[] = 'Please enter the behavior title';
    if ($_POST['behaviorLevel'] == null)
        $errors[] = 'Please select the level of the behavior';
    return $errors;
}
function show_errors($e) {
    echo('<div class="warning">');
    echo('<ul>');
    foreach ($e as $error) {
        echo("<li><strong><font color=\"red\">" . $error . "</font></string></li>\n");
    }
    echo("</ul></div></p>");
}
?>
