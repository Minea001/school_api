<?php
require_once("../school_api/path.php");
require_once(APP_PATH_CONNECTION . "/connection.php");
require_once(APP_PATH_SERVICE . "/service.php");

class student {

    public $service;

    function __construct()
    {
        // call connection
        $db = new connection();
        $this->service = new service($db);
    }

    function save($students) {   
        $json = file_get_contents('php://input');
        // Decode the JSON into an associative array
        $students = json_decode($json, true);
        $data = array (
            "student_id" => $students->student_id,
            "khmer_name" => $students->khmer_name
        );
        print json_encode($data);
        // die();
        // $res = $this->service->save("tbl_student", $data);
        // return $res;
    }

    /** Get Student List */
    function get_list() {
        $res = $this->service->fun_showdata("tbl_student", "id");
        print json_encode($res);
    }
}
?>
