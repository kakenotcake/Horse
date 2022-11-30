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
    private $email; //string
    private $username; //string
    private $password; //string
    private $access //int (0 or 1)

    function __construct($trainerFirstName, $trainerLastName, $phoneNumber, $email, $username, $password, $access) {
        $this->trainerFirstName = $trainerFirstName;
        $this->trainerLastName = $trainerLastName;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->access = $access;
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
    function get_email() { 
        return $this->email;
    }
    function get_username() {
        return $this->username;
    }
    function get_password() {
        return $this->password;
    }
    function get_access() {
        return $this->access;
    }
}

