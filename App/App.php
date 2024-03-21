<?php
class App
{
     private $__controller, $__action, $__params;

     function __construct()
     {
          global $routes;
          if (isset($routes)) {
               $this->__controller = $routes['default_controller'];
          }
          $this->__action = 'hello';
          $this->__params = [];

          $this->urlHandler();
     }

     function getUrl()
     {
          if (isset($_SERVER['PATH_INFO'])) {
               $url = $_SERVER['PATH_INFO'];
          } else {
               $url = '/';
          }
          return $url;
     }

     function urlHandler()
     {
          $rawUrl = $this->getUrl();
          $arrUrl = array_filter(explode('/', $rawUrl));
          $arrUrl = array_values($arrUrl);
          //Controller
          if (isset($arrUrl[0])) {
               $this->__controller = ucfirst($arrUrl[0]);
          }
          if (file_exists('./app/controllers/' . ($this->__controller) . '.php')) {
               require_once './app/controllers/' . ($this->__controller) . '.php';
               //Kiểm tra class $this->__controller
               if (class_exists($this->__controller)) {
                    $this->__controller = new $this->__controller();
                    unset($arrUrl[0]);
               }else{
                    $this -> loadError();    
               }
          } else {
               $this->loadError();
          }
          //Action
          if (isset($arrUrl[1])) {
               $this->__action = $arrUrl[1];
               unset($arrUrl[1]);
          }
          //Params
          $this->__params = array_values($arrUrl);
          //Kiểm tra method 
          if (method_exists($this->__controller, $this->__action)) {
               call_user_func_array([$this->__controller, $this->__action], $this->__params);
          } else {
               $this->loadError();
          }
     }


     function loadError($name = '404')
     {
          require_once './app/errors/' . $name . '.php';
     }
}
