<?php
include_once('controller.php');
include_once('module/detailFoodModel.php');

class detailFoodController extends Controller
{
    public function getFoodDetail(){
        $alias = $_GET['alias'];
        $id = (int)$_GET['id'];

        $model  = new detailFoodModel;
        $food   = $model->getDetail($alias,$id);

        $arrData = ['food'=>$food];

        return $this->loadView('chi-tiet-mon-an',$arrData);
    }
}
