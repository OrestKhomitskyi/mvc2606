



<?php
//
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS . '..' . DS); // path: /../
define('VIEW_DIR', ROOT . 'View' . DS); // /View
define('CONF_DIR', ROOT . 'Config' . DS); // /Config
define('ADMIN_DIR',VIEW_DIR.'Admin'.DS);
define('STORAGE_DIR',__DIR__.DS.'storage'.DS);

spl_autoload_register(function($className) {
    $path = ROOT . str_replace('\\', DS, $className) . '.php';

    if (!file_exists($path)) {
        throw new \Exception("{$path} not found");
    }
    require $path;
});


try {
    //composer
    require ROOT.'vendor/autoload.php';

    \Framework\Session::start();
    $config=Symfony\Component\Yaml\Yaml::parse(file_get_contents(CONF_DIR.'config.yml'));
    $parameters=$config['parameters'];
    $routes=$config['routing'];
    $router = new \Framework\Router($routes);
    $loader = new \Twig_Loader_Filesystem(VIEW_DIR);
    $twig=new \Twig_Environment($loader);
    $twigFunction = new Twig_SimpleFunction('Session', function($method) {
        return \Framework\Session::$method();
    });
    $twigFunction2=new Twig_SimpleFunction('Auth',function (){
        if(\Framework\Session::has('user')){
            return true;
        }
        return false;
    });
    $twigFunction3=new Twig_SimpleFunction('route',function ($routeName,array $params=null){
        global $router;
        $router->redirect($routeName,$params);
    });



    $twig->addFunction($twigFunction);
    $twig->addFunction($twigFunction2);
    $twig->addFunction($twigFunction3);

    $api=new \Framework\API($config['api_list']);


    $request = new \Framework\Request($_GET, $_POST);
    $router->match($request);


    if(!$router->getCurrent()) throw new Exception("Route not found");

    $dsn="mysql: host={$parameters['database_host']}; dbname={$parameters['database_name']}";
    $pdo = new \PDO(
        $dsn,
        $parameters['database_user'],
        $parameters['database_password']
    );
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    $repositoryFactory = new \Framework\RepositoryFactory();
    $repositoryFactory->setPdo($pdo);

    $container = (new \Framework\Container())
        ->setParameteres($parameters)
        ->set('router', $router)
        ->set('repository_factory', $repositoryFactory)
        ->set('twig',$twig)
        ->set('API',$api)
    ;

    $api->setContainer($container);

    $controller = $router->getCurrent()->controller;
    $action = $router->getCurrent()->action;

    $controller="\\Controller\\{$controller}";
    $controller = new $controller();
    $controller->setContainer($container);

    if (!method_exists($controller, $action)) {
        throw new \Exception("{$action} not found");
    }

    $content = $controller->$action($request);
    
} catch (\Exception $e) {
    dump($e);
    $content = $e->getMessage();
}
echo $content;
