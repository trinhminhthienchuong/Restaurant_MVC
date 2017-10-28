<?php
    require 'connect.php';

class dbClass extends Connect{
	private $__stmt;
	private $__username;
	private $__password;
	private $__email;
	public function __construct(){
		parent::__construct();		
	}
	public function setQuery($sql){
		return $this->query = $sql;
	}
	public function insert($userName,$userEmail){
		//Tạo đối tượng prepare (có nhiệm vụ loại bỏ sql injection)
		$this->__stmt = $this->conn->prepare($this->setQuery());
		// Gán giá trị vào các tham số ẩn 
		/** Giá trị đầu tiên là hai chữ ss, đây chính là khai báo dữ liệu cho hai tham số ẩn danh bên dưới. Ý nghĩa như sau:
		 * i: interger
		 * d: double
		 * s: string
		 * b: blob 
		 * **/
		return $this->__stmt->bind_param("ss", $userName,$userEmail);				
		}
	
	public function excute(){		
		return $this->stmt->execute() ? 'Thêm thành công': false;
	}

	public function query(){	
		return $this->_conn->query($this->_sql);
	}

	public function loadAllRows(){
		$execute = $this->execute();
		$dataList = [];
		if($execute){
			while($row = $execute->fetch_object()){
				array_push($dataList, $row);
			}
		}
		return $dataList;
	}
	public function loadRow(){
		$execute = $this->execute();
		$row = false;
		if($execute){
			$row = $execute->fetch_object();
		}
		return $row;
	}
	public function getLastId(){
		return $this->_mysqli->insert_id;
	}
	public function disconnect(){
		$this->_mysqli = NULL;
	}
}

$a = new dbClass;
$query = $a->setQuery('select*from user');


?>