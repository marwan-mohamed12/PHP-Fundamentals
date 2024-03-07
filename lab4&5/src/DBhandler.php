<?php 

namespace App;
require_once "vendor/autoload.php";
use Illuminate\Database\Capsule\Manager as DbConnection;

class DBhandler implements DBHandlerInterface {

    private $dbConnector;

    public function __construct() {
        $this->dbConnector = new DbConnection();
    }

    public function connect() {
        try {
            $this->dbConnector->addConnection([
                "driver" => __DRIVER__,
                "host" => __HOST__,
                "database" => __DATABASE__,
                "username" => __USERNAME__,
                "password" => __PASSWORD__
            ]);
            $this->dbConnector->setAsGlobal();
            $this->dbConnector->bootEloquent();
            return true;
        } catch (\Exception $err) {
            echo "Error(in connect): " . $err->getMessage();
            return false;
        }
    }


    public function get_data($start = 0, $fields = array()) {
        $items = Items::skip($start)->take(5)->get();
        if (empty($fields)) {
            foreach ($items as $item) {
                echo $item->id . " <br>";
            }
        } else {
            return $items;
        }
    }

    public function disconnect() {
        try {
            DbConnection::disconnect();
            return true;
        } catch (\Exception $err) {
            echo "Error(in disconnect): " . $err->getMessage();
            return false;
        }
    }

    public function get_record_by_id($id, $primary_key) {
        $item = Items::where($primary_key, "=", $id)->get();
        if (count($item) > 0)
            return $item[0];
    }

    public function search_by_column($name_column, $value) {

        $items = Items::where($name_column, "like", "%$value%")->get();
        if ($name_column == "" || $value == "") {
            echo "<div style='display:flex;
            justify-content:center;
            margin-top:20px;
            color:red;
            font-weight:bold;'>Please Enter A Value</div>";
            return $items;
        }
        $isExist = Items::where($name_column, "=", $value)->exists();
        if ($isExist) {
            if (count($items) > 0)
                return $items;
        } else {
            echo "This value deosn't exists";
            return $items;
        }

    }


}

?>