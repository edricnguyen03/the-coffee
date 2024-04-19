<?php
class App
{
     private $__controller, $__action, $__params, $__routes;
     function __construct()
     {
          global $routes;

          $this->__routes = new Route();

          if (isset($routes)) {
               $this->__controller = $routes['default_controller'];
          }
          $this->__action = $routes['default_action'];
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
          $rawUrl = $this->__routes->handleRoute($rawUrl);
          $arrUrl = array_filter(explode('/', $rawUrl));
          $arrUrl = array_values($arrUrl);

          $urlCheck = "";

          if (!empty($arrUrl)) {
               foreach ($arrUrl as $key => $item) {
                    $urlCheck .= $item . '/';
                    $fileCheck = rtrim($urlCheck, '/');
                    $fileArr = explode('/', $fileCheck);
                    $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) - 1]);
                    $fileCheck = implode('/', $fileArr);
                    if (!empty($arrUrl[$key - 1])) {
                         unset($arrUrl[$key - 1]);
                    }

                    if (file_exists('./app/controllers/' . ($fileCheck) . '.php')) {
                         $urlCheck = $fileCheck;
                         break;
                    }
               }
               $arrUrl = array_values($arrUrl);
          }

          //Controller
          if (isset($arrUrl[0])) {
               $this->__controller = ucfirst($arrUrl[0]);
               if ($this->__controller == 'Login' || $this->__controller == 'Register') {
                    if ($this->__controller == 'Register') {
                         $this->__controller = 'Login_Regis';
                         $this->__action = 'Register';
                    } else {
                         $this->__controller = 'Login_Regis';
                         $this->__action = 'Login';
                    }
               }
          }
          if ($urlCheck == '') $urlCheck = $this->__controller;
          if (file_exists('./app/controllers/' . $urlCheck . '.php')) {
               require_once './app/controllers/' . $urlCheck . '.php';
               //Kiểm tra class $this->__controller
               if (class_exists($this->__controller)) {
                    $this->__controller = new $this->__controller();
                    unset($arrUrl[0]);
               } else {
                    $this->loadError();
               }
          } else if (file_exists('./app/controllers/admin' . $urlCheck . '.php')) {
               require_once './app/controllers/admin' . $urlCheck . '.php';
               if (class_exists($this->__controller)) {
                    $this->__controller = new $this->__controller();
                    unset($arrUrl[0]);
               } else {
                    $this->loadError();
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


     public static function loadError($name = '404')
     {
          require_once './app/errors/' . $name . '.php';
     }
}
