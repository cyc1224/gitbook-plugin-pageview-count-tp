<?php
namespace app\user\model;
use think\Model;
use PDO;

class CounterLogic extends Model{
    private $conn;

    public function __construct() {
        $host = "127.0.0.1";//数据库地址
        $port = 3306;//端口
        $user = "user";//用户名
        $password = "password";//密码
        $dbname = "name";//数据库名称

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

        try{
            // create a MySQL database connection
            $this->conn = new PDO($dsn, $user, $password);
            // echo "Connected to the $dbname database successfully!<br>";
        }catch (PDOException $e){
            // report error message
            echo $e->getMessage();
            return $e;
        }
    }

    //获取计数
    public function getCount($url) {
        $query = "SELECT time FROM counter WHERE url = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$url]);
        $time = $stmt->fetchColumn();
        return ['time' => $time];
    }

    //添加计数
    public function addCount($title, $url) {
        $query = "INSERT INTO counter(url, time, title) VALUES (?, 1, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$url, $title]);
    }

    //更新计数
    public function updateCount($url, $time) {
        $query = "UPDATE counter SET time = ? WHERE url = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$time, $url]);
    }
}
?>
