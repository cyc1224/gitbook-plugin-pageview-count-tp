<?php
namespace app\user\controller;//控制器所在目录
use think\Controller;
use app\user\model\CounterLogic;//数据库模型

header('Access-Control-Allow-Origin: *');//HERE
header('Access-Control-Allow-Methods: POST, GET, PUT');
header('Access-Control-Allow-Headers: Content-Type， X-Requested-With');

class Count extends Controller{
    private $counterLogic;

    public function __construct() {
        parent::__construct();
        $this->counterLogic = new CounterLogic();
    }

    public function _empty($name){
        $request_method = $_SERVER["REQUEST_METHOD"];
        switch($request_method)
        {
            case 'GET':
                if(!empty($_GET['url']))
                {
                    $url = $_GET['url'];
                    return json($this->counterLogic->getCount($url));
                }
                break;
            case 'POST':
                $title = $_REQUEST["title"];
                $url = $_REQUEST['url'];
                $this->counterLogic->addCount($title, $url);
                return ("AddSuccess".$url);
                break;
            case 'PUT':
                parse_str(file_get_contents("php://input"), $sent_vars);
                $this->counterLogic->updateCount($sent_vars["url"], $sent_vars["time"]);
                return $sent_vars;
                break;
            default:
                header("HTTP/1.0 405 Method Not Allowed");
                break;
        }
    }
}
