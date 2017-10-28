<?php
include_once('controller.php');
include_once('module/HomeModel.php');
include_once('module/pager.php');

class homeController extends Controller
{
    public function getIndex(){
        $model = new homeModel;
        $today = $model->getFoodsToday();
        $dsMonan = $model->getFoodsList();        
        $tongSp = count($dsMonan);
        $currentPage = isset($_GET['page']) && $_GET['page']!=0 && is_numeric($_GET['page']) ? abs($_GET['page']) : 1;
        
        // $currentPage = (empty($_GET['page']) && $_GET['page'] > 1) ? abs($_GET['page']) : $_GET['page']=1;
        //is_numeric
        $soLuong = 6;
        $soTrang = 4;
        $pager = new Pager($tongSp,$currentPage,$soLuong,$soTrang);   
        $phan_trang = $pager->showPagination();
        
        $vitri = ($currentPage-1)*$soLuong;
        $dsMonan = $model->getFoodsPagination($vitri,$soLuong);
        
        $arrData = ['today'=>$today,'dsMonan'=>$dsMonan,'phan_trang'=>$phan_trang];

        

        return $this->loadView('trangchu',$arrData);
    }
}
