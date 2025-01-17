<?php
<<<<<<< HEAD:tema-06/proyectos/01-alumnos/02-mvc-alumnos-main/libs/app_.php



class App
{

    function __construct()
    {


        # El primer elemento de la url es el controlador
        # El segundo es el método del controlador
        # El resto me imagino que son parámetros del método

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        # Si no se introduce ningún controlador en la barra de direcciones
        # cargará el controlador Main.php
        # Si se introduce index también cargará el controlador Main

        if ((empty($url[0])) || ($url[0] == 'index')) {

            $archivoController = 'controllers/main.php';
            require_once $archivoController;
            $controller = new Main();
            $controller->loadModel('main');
            $controller->render();
            return false;
        }

        $archivoController = 'controllers/' . $url[0] . '.php';

        # Carga el controlador sólo si existe el archivo

        if (file_exists($archivoController)) {

            require_once $archivoController;
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            # obtengo el número de elementos de la dirección
            $nparam = sizeof($url);

            if ($nparam > 1) {

                if ($nparam > 2) {

                    $param = [];
                    for ($i = 2; $i < $nparam; $i++) {
                        $param[] = $url[$i];
                    }
                    $controller->{$url[1]}($param);
                } else {
                    $controller->{$url[1]}();
                }
            } else {

                $controller->render();
            }
        } else {

            require_once 'controllers/error.php';
            $controller = new Errores();
=======
class App {
    
    // Definir constantes para rutas
    const CONTROLLER_PATH = 'controllers/';
    const MODEL_PATH = 'models/';
    const DEFAULT_CONTROLLER = 'main';
    const ERROR_CONTROLLER = 'error';

    public function __construct()
    {
        // Obtener la URL y sanitizarla
        $url = isset($_GET['url']) ? filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL) : null;
        $url = explode('/', $url);

        // Determinar el controlador
        $controllerName = (empty($url[0]) || $url[0] === 'index') ? self::DEFAULT_CONTROLLER : $url[0];
        $controllerFile = self::CONTROLLER_PATH . $controllerName . '.php';

        try {
            if (file_exists($controllerFile)) {
                // Incluir y cargar el controlador
                require_once $controllerFile;
                $controller = new $controllerName();

                // Cargar el modelo asociado al controlador, si existe
                $controller->loadModel($controllerName);

                // Determinar el método y los parámetros
                $methodName = isset($url[1]) ? $url[1] : 'render';
                $params = array_slice($url, 2);

                // Validar que el método exista
                if (method_exists($controller, $methodName)) {
                    call_user_func_array([$controller, $methodName], $params);
                } else {
                    throw new Exception("El método '{$methodName}' no existe en el controlador '{$controllerName}'.");
                }
            } else {
                throw new Exception("El controlador '{$controllerName}' no se encuentra.");
            }
        } catch (Exception $e) {
            // Manejo centralizado de errores
            $this->handleError($e);
        }
    }

    private function handleError(Exception $e)
    {
        // Incluir y cargar el controlador de errores
        $errorControllerFile = self::CONTROLLER_PATH . self::ERROR_CONTROLLER . '.php';
        if (file_exists($errorControllerFile)) {
            require_once $errorControllerFile;
            $controller = new Errores($e->getMessage()); 
        } else {
            // Fallback en caso de que el controlador de errores no exista
            echo "Error crítico: " . $e->getMessage();
>>>>>>> b46fa8a20d45cdf94283cb485d1534639f57a834:tema-06/proyectos/01-alumnos/02-mvc-alumnos-completo/libs/app_.php
        }
    }
}
