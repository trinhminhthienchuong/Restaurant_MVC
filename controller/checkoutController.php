<?php
include_once('controller.php');

class checkoutController extends Controller
{
    public function getCheckout(){
        return $this->loadView('thanh-toan');
    }
}
