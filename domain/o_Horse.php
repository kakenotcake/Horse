<?php

/* 
*comment test
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 horse
 */

class Horse {
    private $horseName; //string
    private $color; //string
    private $breed; //string - can be null if not known
    private $pastureNum; //int
    private $colorRank; //string
    
    public function constructHorse($N, $Co, $B, $P, $Cr) {
        $this->horseName = $N;
        $this->color = $Co;
        $this->breed = $B;
        $this->pastureNum = $P;
        $this->colorRank = $Cr;
    }

    public function set_horseName($N) {
        $this->horseName = $N;
    }
    public function get_horseName() {
        return $this->horseName;
    }
    public function get_color() {
        return $this->color;
    }
    public function get_breed() {
        return $this->breed;
    }
    public function get_pastureNum() {
        return $this->pastureNum;
    }
    public function get_colorRank() {
        return $this->colorRank;
    }
}

