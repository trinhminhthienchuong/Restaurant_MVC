<?php

//Định nghĩa các tham số truyền vào khi connect Db.

define('db_host', 'localhost');
define('db_user', 'root');
define('db_pass', '');
define('db_name', 'php01_restaurant');

class Connect{
	public $host = db_host;
	public $user = db_user;
	public $pass = db_pass;
	public $dbname = db_name;		 
	public $conn; //Đây là biến connect để giao tiếp vs CSDL
	public $query;	////Đây là biến querry để lưu câu lệnh SQL
	//Hàm khởi tạo kết nối CSDL
	public function __construct(){
		$this->conn = new mysqli($this->host,$this->user,$this->pass,$this->dbname);
		if($this->conn->connect_error){  // Kiểm tra kết nối với CSDL
			die("Connect database error: </br>". $this->conn->connect_error);
		}
		if (!$this->conn->set_charset("utf8")) { // Kiểm tra thiết lập ký tự UTF8 cho trình duyệt.
			die("Error loading character set utf8: ". $this->conn->error);
		}
		// else {
		// 	printf("Current character set: %s\n", $this->conn->character_set_name());
		// }			
	}

	public function changeTitle(){
		
	}
}

$s = 'SELECT name FROM foods';

$m = new Connect();

$m-> setQuery($s);

$result = $m->loadAllRows();

$arr = [];

foreach ($result as $key => $monan) {
	$alias = changeTitle($monan->name);
	# code...
}

$sql = "INSERT INTO `page_url` (`id`, `url`) VALUES ('1', 'mon-canh-bo-duong')";

?>
