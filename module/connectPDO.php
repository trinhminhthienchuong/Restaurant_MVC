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
	public $connect; //Đây là biến connect để giao tiếp vs CSDL
	public $query;	////Đây là biến querry để lưu câu lệnh SQL
	//Hàm khởi tạo kết nối CSDL

try {
    // Kết nối
    $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", "$this->user", "$this->pass");
    // Thiết lập exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    // Bắt đầu transaction
    $conn->beginTransaction();
     
    // Thực thi từng câu truy vấn
    $conn->exec("INSERT INTO News (title, content) 
        VALUES ('tieu de 1', 'noi dung 1')");
    $conn->exec("INSERT INTO News (title, content) 
        VALUES ('tieu de 2', 'noi dung 2')");
 
    // Nếu mọi thứ thành công thì commit
    $conn->commit();
     
    echo "Thao tác thành công";
} 
catch (PDOException $e) {
    // Nếu xuất hiện lỗi thì rollback lại các thao tác
    $conn->rollback();
    echo "Lỗi: " . $e->getMessage();
}
 
 
// Ngắt kết nối
$conn = null;
}