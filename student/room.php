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
       $res = $this->service->getData("tbl_room", "id");
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

        if (isset($rooms->id) == 0) {
            $res = $this->service->save("tbl_room", $data);
            $rooms->id = $this->db->last_id;
        } else {
            $res = $this->service->update("tbl_room", $data, "WHERE id = $rooms->id ");
        }
        return $res;
    }
}
?>