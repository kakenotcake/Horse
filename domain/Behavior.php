<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Behavior {
   private $title; //string
   private $level; //string
   
   function __construct($title, $level) {
       $this->title = $title;
       $this->level = $level;
   }
   function get_title() {
       return $this->title;
   }
   function get_level() {
       return $this->level;
   }
}
