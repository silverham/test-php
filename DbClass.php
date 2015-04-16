<?php
//DB.class.php
 
class DB {

    //protected $connection;

    //takes a mysql row set and returns an associative array, where the keys
    //in the array are the column names in the row set. If singleRow is set to
    //true, then it will return a single row instead of an array of rows.
    public function processRowSet($rowSet, $singleRow=false)
    {
        $resultArray = array();
        while($row = mysqli_fetch_assoc($rowSet))
        {
            array_push($resultArray, $row);
        }
 
        if($singleRow === true)
            return $resultArray[0];
 
        return $resultArray;
    }
 
    //Select rows from the database.
    //returns a full row or rows from $table using $where as the where clause.
    //return value is an associative array with column names as keys.
    public function select($table, $where, $singleRow=false) {
        
        require("DbConnect.php");
        //$sql = "SELECT * FROM $table WHERE $where";
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($connection, $sql);
        if((mysqli_num_rows($result) == 1) && ($singleRow == false)){
            return $this->processRowSet($result, true);
        }
        return $this->processRowSet($result);
    }
 
 
 
    //Inserts a new row into the database.
    //takes an array of data, where the keys in the array are the column names
    //and the values are the data that will be inserted into those columns.
    //$table is the name of the table.
    public function insert($data, $table) {
        require("DbConnect.php");
 
        $columns = "";
        $values = "";
 
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $values .= ($values == "") ? "" : ", ";
            $values .= "\"$value\""; //escape speechmarks
        }
 
        $sql = "insert into $table ($columns) values ($values)";
        if (!mysqli_query($connection, $sql)){
            printf("Errormessage: %s\n", mysqli_error($connection));
            exit();
        }
 
        //return the ID of the user in the database.
        return mysqli_insert_id($connection);
    }
 
        public function delete($col, $data, $table) {
            require("DbConnect.php");
            $sql = "delete from $table where $col = $data";
 
        mysqli_query($connection, $sql);
 
        //return the ID of the user in the database.
        return;
    }
}
 
?>