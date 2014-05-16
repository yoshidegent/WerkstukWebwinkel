<?php

class Product
{
    public $id;
    public $naam;
    public $prijsExclBtw;
    public $imgUrl;
    public $beschrijving;

    public function __construct($id, $naam, $prijsExclBtw, $imgUrl="", $beschrijving = "Geen beschrijving beschikbaar.")
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->prijsExclBtw = $prijsExclBtw;
        $this->beschrijving = $beschrijving;
        $this->imgUrl = $imgUrl;
    }

    public function prijsInclBtw($btw=0.06)
    {
        $prijsInclBtw = ($this->prijsExclBtw + ($this->prijsExclBtw * $btw));
        return $prijsInclBtw;
    }
}