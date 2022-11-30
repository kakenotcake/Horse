<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *
 */
class Behavior {
   private $title; //string
   private $behaviorLevel; //string
   
   function __construct($title, $behaviorLevel) {
       $this->title = $title;
       $this->behaviorLevel = $behaviorLevel;
   }
   function get_title() {
       return $this->title;
   }
   function get_behaviorLevel() {
       return $this->behaviorLevel;
   }
}
