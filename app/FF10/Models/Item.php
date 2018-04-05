<?php

abstract class Item {

    protected $name;
    protected $description;

    abstract public function implement();

}

class Antidote extends Item {

    public function __construct() {
        $this->name= 'Antidote';
        $this->description= 'Cures Poison';
        $this->cures= 'Poison';

    public function implement() {
        return $this->cures;
    }
}