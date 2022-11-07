<?php

/*
*comment test
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 trainer
 */
//First name, last name, phone number, user name, and password

class Trainer {
    private $trainerFirstName; //string
    private $trainerLastName; //string
    private $phoneNumber; //string
    private $username; //string
    private $password; //string

    function __construct($trainerFirstName, $phoneNumber, $username, $password, $trainerLastName) {
        $this->trainerFirstName = $name;
        $this->phoneNumber = $phoneNumber;
        $this->username = $username;
        $this->password = $password;
        $this->trainerLastName = $trainerLastName;
    }
    function get_trainerFirstName() {
        return $this->trainerFirstName;
    }
    function get_trainerLastName() {
        return $this->trainerLastName;
    }
    function get_phoneNumber() {
        return $this->phoneNumber;
    }
    function get_username() {
        return $this->username;
    }
    function get_password() {
        return $this->password;
    }
}

