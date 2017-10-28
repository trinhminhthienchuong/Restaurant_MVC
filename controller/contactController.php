<?php
include_once('controller.php');

class contactController extends Controller
{
    public function getContact(){
        return $this->loadView('lien-he');
    }
}
