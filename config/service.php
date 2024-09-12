<?php
require_once(APP_PATH_CONNECTION . "/connection.php");
header("Content-Type: application/json; charset=UTF-8");

class service {
    private $pro_conn, $pro_sql, $pro_cmd, $pro_count, $pro_result, $pro_arr, $pro_record, $pro_target;
    public $databaseConnection;

    function __construct($databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }
    public function test() {
        return "hi";
    }

    // test insert
    public function seedStudent()
    {
        try {
            $sql = "INSERT INTO tbl_class (class_name, description)
                    VALUES  ('John', 'This is my first test'),
                            ('Jane', 'This is my first test'),
                            ('John', 'This is my first test'),
                            ('Jenny','This is my first test')";

            $statement = $this->databaseConnection->query($sql);
            return $statement->rowCount();

        } catch (PDOException $exception) {
            exit($exception->getMessage());
        }
    }

    function fun_insertData($par_table, $par_fields, $par_value)
    {
        $this->pro_conn = new connection();

        $this->pro_count = count($par_fields);
        $this->pro_sql = "INSERT INTO $par_table(";
        for ($x = 0; $x < $this->pro_count; $x++) {
            $this->pro_sql .= $par_fields[$x];
            if ($x < ($this->pro_count - 1)) {
                $this->pro_sql .= ",";
            } else {
                $this->pro_sql .= ") VALUES(";
            }
        }
        for ($x = 0; $x < $this->pro_count; $x++) {
            $this->pro_sql .= "'$par_value[$x]'";
            if ($x < ($this->pro_count - 1)) {
                $this->pro_sql .= ",";
            } else {
                $this->pro_sql .= ")";
            }

            //command SQL statement to db
            $this->pro_cmd = mysqli_query($this->pro_conn->get_connection(), $this->pro_sql);
            if ($this->pro_cmd == 1) {
                $this->pro_result = true;
            } else {
                $this->pro_result = false;
            }
            // Accessing close connection
            // $this->fun_closecon();
        }
    }
    // function Show data
    function fun_showdata($par_table, $par_field = null)
    {
        $this->pro_conn = new connection();

        //create empty array
        $this->pro_arr = array();
        //create sql statement
        $this->pro_sql = "SELECT *FROM $par_table Order By $par_field DESC";
        //command sql Statement to database server
        $this->pro_cmd = mysqli_query($this->pro_conn->get_connection(), $this->pro_sql);
        while ($this->pro_record = mysqli_fetch_assoc($this->pro_cmd)) {
            array_push($this->pro_arr, $this->pro_record);
        }
        return $this->pro_arr;
    }
    // function find record
    function fun_showdatabyId($par_table,$par_arrfield,$par_arrvalue) 
    {
        $this->pro_conn = new connection();

        //create empty array
        $this->pro_arr = array();
        //create sql statement
        $this->pro_sql = "SELECT *FROM $par_table WHERE $par_arrfield='$par_arrvalue'";
        //command sql Statement to database server
        $this->pro_cmd = mysqli_query($this->pro_conn->get_connection(), $this->pro_sql);
        $this->pro_record = mysqli_fetch_assoc($this->pro_cmd);
        return $this->pro_record;
    }

    function fun_deleterecord($arg_table,$arg_fid,$arg_vid)
    {
        $this->pro_conn = new connection();

        $this->pro_sql = "DELETE FROM $arg_table WHERE $arg_fid=$arg_vid";
        //Send / Command Sql Statement to Database Server
        $this->pro_cmd = mysqli_query($this->pro_conn->get_connection(), $this->pro_sql);
        if($this->pro_cmd){
            return true;
        }else{
            return false;
        }
    }

}
?>