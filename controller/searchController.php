<?php
include_once('controller.php');

class searchController extends Controller
{
    public function getSearch(){
        return $this->loadView('tim-kiem');
    }
}
