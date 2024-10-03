<?php
require_once("../school_api/path.php");
require_once(APP_PATH_CONNECTION . "/connection.php");
require_once(APP_PATH_SERVICE . "/service.php");

class room {
    private $db, $service, $last_id;
    function __construct()
    {
        $this->db = new connection();
        $this->service = new service($this->db);
    }

    function getList() {
       $res = $this->service->fun_showdata("tbl_room", "id");
       $this->db->success($res);

    }

    function save($room) {
        // convert data to array object by decode params
        $jsonString = json_encode($room);
        $rooms = json_decode($jsonString);

        $data = array (
            "room_label" => $rooms->room_label,
            "description" => $rooms->description,
            "is_deleted" => 0
        );
        // call funtion save
        
        if ($rooms->id == 0 || $rooms->id == null) {
            $res = $this->service->save("tbl_room", $data);
            $this->last_id = $res;
        } else {
            $res = $this->service->update("tbl_room", $data, $this->last_id);
        }
        $this->db->success($res);
    }
    function _get_last_id($tbl_name) {
         $ret = $this->service->_get_last_id($tbl_name);
         echo $ret;
    }

    // function save($room) {
    //     $fields = array();
    //     $values = array();

    //     foreach ($room as $k => $v) {
    //         $fields[] = $k;
    //         $values[] = $v;
    //     }
    //     $res = $this->service->fun_insertData("tbl_room", $fields, $values);
    //     $last_id = $room[$k]->id;
    //     echo $last_id;
    //     if ($res) {
    //         $this->db->success($res);
    //     } else {
    //         return;
    //     }
    // }
}
?>