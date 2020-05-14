<?php
namespace App\Models;

class BaseElement implements Printable {
    protected $title;
    public $description;
    public $visible = true;
    public $months;
    public $fileName;

    public function __construct($title, $description, $fileName) {
        $this->setTitle($title);
        $this->description = $description;
        $this->fileName =$fileName;
    }

    public function setTitle($t) {
        if($t == '') {
            $this->title = 'N/A';
        } else {
            $this->title = $t;
        }
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getFileName(){
        return $this->fileName;
    }
}