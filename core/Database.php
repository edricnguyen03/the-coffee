<?php
class Database
{
     private $conn = null;
     public function __construct()
     {
          global $db_config;
          $this->conn = Connection::getInstance($db_config);
     }

     public function insert($table, $data)
     {
          if (!empty($data)) {
               $fieldStr = "";
               $valueStr = "";
               foreach ($data as $key => $value) {
                    $fieldStr .= $key . ",";
                    $valueStr .= "'" . $value . "',";
               }
               $fieldStr = rtrim($fieldStr, ",");
               $valueStr = rtrim($valueStr, ",");

               $sql = "INSERT INTO " . $table . " ($fieldStr) VALUES ($valueStr)";
               $status = $this->query($sql);
               if ($status) {
                    return $sql;
               }
               return false;
          }
     }
     public function update($table, $data, $condition)
     {
          if (!empty($data)) {
               $updateStr = "";
               foreach ($data as $key => $value) {
                    $updateStr .= $key . "='$value',";
               }
               $updateStr = rtrim($updateStr, ",");

               if (!empty($condition)) {
                    $sql = "UPDATE $table SET $updateStr WHERE $condition";
               } else {
                    $sql = "UPDATE $table SET $updateStr";
               }
               $status = $this->query($sql);
               if ($status) {
                    return $sql;
               }
               return false;
          }
     }
     public function delete($table, $condition = '')
     {
          if (!empty($condition)) {
               $sql = "DELETE FROM $table WHERE $condition";
          } else {
               $sql = "DELETE FROM $table";
          }
          $status = $this->query($sql);
          if ($status) {
               return true;
          }
          return false;
     }
     public function get($table, $fields = '*', $condition = '')
     {
          if (!empty($condition)) {
               $sql = "SELECT $fields FROM $table WHERE $condition";
          }else{
               $sql = "SELECT $fields FROM $table";
          }
          $result = $this->query($sql);
          return $result->fetchAll(PDO::FETCH_ASSOC);
     }

     public function query($sql)
     {
          $stmt = $this->conn->prepare($sql);
          $stmt->execute();
          return $stmt;
     }
}
