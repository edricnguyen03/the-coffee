<?php
     $config_dir = scandir('./App/configs');
     if(!empty($config_dir)){
          foreach($config_dir as $configItem){
               if($configItem!= '.' && $configItem!= '..' && file_exists('./App/configs/'.$configItem)){
                    require_once './App/configs/'.$configItem;
               }
          }
     }
     require_once './App/App.php'; //Load app
     //Kiểm tra config và load connection
     if(!empty($config['database'])){
          $db_config = $config['database'];
          if(!empty(array_filter($db_config))){
               if(!empty($db_config['dbname']) && !empty($db_config['servername']) && !empty($db_config['username'])){
                    require_once "./core/Connection.php";
                    require_once "./core/Database.php";
                    $db = new Database();
               }
          }
     }

     require_once './core/Controller.php'; //Load base controller
