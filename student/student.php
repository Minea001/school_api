<?php
require_once(APP_PATH);
require_once(APP_PATH_CONNECTION . "/connection.php");
require_once(APP_PATH_SERVICE . "/service.php");

class student {

    function __construct()
    {
        // call connection

        // create class
       
    }

    function save($data) {
       
    }

    /** Get Student List */
    function get_list() {
        $db = new connection();
        $service = new service($db);
        $res = $service->fun_showdata("tbl_student", "id");
        print json_encode($res);
    }
}
?>
