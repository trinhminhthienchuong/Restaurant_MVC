<?php
include_once('controller.php');

class seasonalFoodController extends Controller
{
    public function getseasonalFood(){
        return $this->loadView('mon-an-theo-mua');
    }
}
