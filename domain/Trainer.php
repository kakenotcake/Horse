<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Trainer {
    private $firstName; //string
    private $lastName; //string
    private $email; //string
    private $phone; //int
    
    function __construct($firstName, $lastName, $email, $phone) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }
    function get_firstName() {
        return $this->firstName;
    }
    function get_lastName() {
        return $this->lastName;
    }
    function get_email() {
        return $this->email;
    }
    function get_phone() {
        return $this->phone;
    }
}
