<?php
include_once('controller.php');

class aboutController extends Controller
{
    public function getAbout(){
        return $this->loadView('gioi-thieu');
    }
}
