<?php
     class connection{
          private static $instance = null, $conn = null;

          private function __construct($config){
               try{
                    $dsn = 'mysql:dbname='.$config['dbname'].';host='.$config['servername'];

                    $option = [
                         PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    ];

                    $connection = new PDO($dsn,$config['username'],$config['password'] ,$option);

                    self::$conn = $connection;
               }catch(Exception $e){
                    $mess = $e->getMessage();
                    die($mess);
               }
          }
          public static function getInstance($config){
               if(!isset(self::$instance)){
                    $connection = new connection($config);
                    self::$instance = self::$conn;
               }
               return self::$instance;
          }
     }
?>