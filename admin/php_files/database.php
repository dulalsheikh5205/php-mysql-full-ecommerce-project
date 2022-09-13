<?php 
class Database {
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $db_name = "shopping_db";
    private $result = array();
    private $mysqli = "";
    private $myquery = "";
    private $conn = false;

    function __construct()
    {
        if(!$this->conn){
            $db = new mysqli($this->db_host,$this->db_user,$this->db_password,$this->db_name);
            $this->mysqli =$db;
            if($this->mysqli->connect_error > 0){
              array_push($this->result,$this->mysqli->connect_error);
              return false;  
            }
        }else{
            return true;
        }
    }

    /** Function for insert query */
    public function insert($table,$params=array()){
        if($this->tableExists($table)){
            $table_columns = implode(",",array_keys($params)); // ['name']='dulal'
            $table_values = implode("','",$params); // 'dulal','email','password'
            $sql = "INSERT INTO $table($table_columns) VALUES('$table_values')";
            $this->myquery  = $sql;

            if($this->mysqli->query($this->myquery)){
               array_push($this->result,$this->mysqli->insert_id);
               return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }
           
        }else{
            return false;
        }
    }

    /** Update Query Function Method Here */
    public function update($table,$params=array(),$where = null){
        if($this->tableExists($table)){
            $arguments = array();
            foreach($params as $columnKey=>$columnValue){
                $arguments[] = "$columnKey='$columnValue'";
            }
            $keyValue = implode(",",$arguments);
            $sql = "UPDATE $table SET $keyValue";

            if($where !== null){
                $sql.="WHERE $where";
            }
            $this->myquery  = $sql;
            if($this->mysqli->query($sql)){
                array_push($this->result,$this->mysqli->affected_rows);
                return true;
            }else{
                array_push($this->result,$this->mysqli->connect_error);
                return false;
            }


        }
    }

    /** Delete Query Function Method Here */
    public function delete($table,$where=null){
        if($this->tableExists($table)){
            $sql = " DELETE FROM $table";
            
            if($where !== null){
                $sql.=" WHERE $where";

                if($this->mysqli->query($sql)){
                    array_push($this->result,$this->mysqli->connect_error);
                    return true;
                }else{
                    array_push($this->result,$this->mysqli->connect_errno);
                }
            }

        
        }else{
            return false;
        }
    }


    /** Select Query Function Method Here */

    public function select($table,$row = " * ", $join = null, $where = null, $order = null, $limit = null)
    {
        if($this->tableExists($table)){
            $sql = " SELECT $row FROM $table ";
            if($join != null){
                $sql .= " JOIN ". $join;

            }
            if($where != null){
                $sql .= " WHERE " . $where;
            }
            
            if($order != null){
                $sql .= " ORDER BY " .  $order;

            }
            if($limit != null){
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else $page = 1;
            $start = ($page -1) * $limit;
            $sql .= " LIMIT " . $start .",". $limit;
            }
           $this->myquery = $sql;
           $query = $this->mysqli->query($sql);
           if($query){
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            /** $this->mysqli->query($sql)->fetch_all(MYSQLI_ASSOC) */
            return true;
           }
           else{
            array_push($this->result,$this->mysqli->connect_error);
            return false;
           }

    }
    else {
        return false;
    }
}


    /** Function Method to check whether table exist or not in database
     */
    private function tableExists($table){
        $tableIndb =$this->mysqli->query("SHOW TABLES FROM $this->db_name Like '$table'");
        if($tableIndb){
            if($tableIndb->num_rows == 1){
                return true;

            }else{
                array_push($this->result,$table." doesn't exist ");
                return false;
            }
        }
    }
    /** This function to get the result of fetch and error */
    function getSql(){
        $sqlval = $this->myquery;
        $this->myquery = array();
        return $sqlval;
    }

    /** this function to escape string from input value */
    function escapeString($data){
        $input_val = trim($data);
        $input_val = stripslashes($input_val);
        $input_val = htmlspecialchars($input_val);
        $result = $this->mysqli->real_escape_string($input_val);
        return $result;
    }

    /** To get Result of fetching data from $this->result */

    function getResult(){
        $resultVal = $this->result;
        $this->result = array();
        return $resultVal;
    }

    /** This function is for input validatation */
    
    /** Destruct method to destroy the mysqli function of construct method */

    function __destruct()
    {
        if($this->conn){
            if($this->mysqli->close()){
                $this->conn = false;
                return true;
            }
            else{
                return false;
            }
        }
    }
}


// $dbObj = new Database(); // This is for Database testing 
//  $dbObj;
//  echo "<pre>";
//  print_r($dbObj);
//  echo "</pre>";


// $dbObj = new Database(); // This is for table exist testing
// $tableExist = $dbObj->tableExists('user');
// print_r($tableExist);
// print_r($dbObj->result);

// $dbObj = new Database();
// $insert = $dbObj->insert('user',array('id'=>2,'name'=>'dulal'));
// echo $insert;
// print_r($dbObj->result);
// $dbObj = new Database();
// $update = $dbObj->update('user',array('name'=>'hus'),"id =2");
// print_r($update)

// $dbObj = new Database();
// $delete = $dbObj->delete('user','id=2');
// print_r($delete);


?>