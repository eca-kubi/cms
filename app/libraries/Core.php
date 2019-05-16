<?php
/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */
class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {


        $url = $this->getUrl();

        // Look in controllers for first value
        if (isset($url['0'])) {
            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
                // If exists, set as controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 Index
                unset($url[0]);
                require_once '../app/controllers/' . $this->currentController . '.php';
                $this->currentController = new $this->currentController;
                if (isset($url[1])) {
                    if (method_exists($this->currentController, $url[1])) {
                        $this->currentMethod = $url[1];
                        $url_one = $url[1];
                        unset($url[1]);
                        $this->params = $url ? array_values($url) : [];
                        if ($url_one == 'login') {
                            $this->params = [implode('/', $this->params)];
                        }
                        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
                        return;
                    } else {
                      $this->currentController = 'Errors';
                        require_once '../app/controllers/' . $this->currentController . '.php';
                        $this->currentController = new $this->currentController;
                        call_user_func_array([$this->currentController, $this->currentMethod], [404]);
                        return; 
                    }
                }
                call_user_func_array([$this->currentController, $this->currentMethod], []);
                return;
            } else {
                $this->currentController = 'Errors';
                require_once '../app/controllers/' . $this->currentController . '.php';
                $this->currentController = new $this->currentController;
                call_user_func_array([$this->currentController, $this->currentMethod], [404]);
                return;
            }
        }

        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController;
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = str_replace(['-','_'], '' , $url );
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}
