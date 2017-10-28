<?php
include_once('controller.php');

class menuController extends Controller
{
    public function getMenu(){
        return $this->loadView('ds-thuc-don');
    }
}
