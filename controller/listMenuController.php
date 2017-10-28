<?php
include_once('controller.php');

class listMenuController extends Controller
{
    public function getlistMenu(){

        return $this->loadView('ds-thuc-don');
    }
}
