<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Horse {
    private $name; //string
    private $color; //string
    private $breed; //string - can be null if not known
    private $pastureNum; //int
    private $colorRank; //string
    
    function __construct($name, $color, $breed, $pastureNum, $colorRank) {
        $this->name = $name;
        $this->color = $color;
        $this->breed = $breed;
        $this->pastureNum = $pastureNum;
        $this->colorRank = $colorRank;
    }
    function get_name() {
        return $this->name;
    }
    function get_color() {
        return $this->color;
    }
    function get_breed() {
        return $this->breed;
    }
    function get_pastureNum() {
        return $this->pastureNum;
    }
    function get_colorRank() {
        return $this->colorRank;
    }
}

