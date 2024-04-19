<?php
class Controller
{
     public function model($model)
     {
          if (file_exists('./App/Models/' . $model . '.php')) {
               require_once './App/Models/' . $model . '.php';
               if (class_exists($model)) {
                    $model = new $model();
                    return $model;
               }
          }
          return false;
     }

     public function view($view, $data = [])
     {    
          extract($data);
          if (file_exists('./App/Views' . $view . '.php')) {
               require_once './App/Views' . $view . '.php';
          }
     }
}
