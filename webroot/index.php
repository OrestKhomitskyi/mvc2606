



<?php
//
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS . '..' . DS); // path: /../
define('VIEW_DIR', ROOT . 'View' . DS); // /View
define('CONF_DIR', ROOT . 'config' . DS); // /config

spl_autoload_register(function($className) {
    $path = ROOT . str_replace('\\', DS, $className) . '.php';
    
    if (!file_exists($path)) {
        throw new \Exception("{$path} not found");
    }
    
    require $path;
});

//1error_reporting(E_WARNING);
try {
    \Framework\Session::start();
    require ROOT.'vendor/autoload.php';

    $loader = new Twig_Loader_Filesystem(VIEW_DIR,ROOT);

    $twig=new Twig_Environment($loader,array(
//        'cache'=>'var/cache'
    ));

    echo $twig->render('index.html.twig',['a'=>new DateTime()]);

    die;


    $request = new \Framework\Request($_GET, $_POST);



    $router = new \Framework\Router(CONF_DIR.'routes.php');

    $router->match($request);

    if(!$router->getCurrent()) throw new Exception("Not found");
    $dbConfig = require CONF_DIR . 'db.php';
    
    $pdo = new \PDO(
        $dbConfig['dsn'], 
        $dbConfig['user'],
        $dbConfig['password']
    );
    
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
    $container = new \Framework\Container();


    $repositoryFactory = new \Framework\RepositoryFactory();
    $repositoryFactory->setPdo($pdo);
    
    $container->set('router', $router);
    $container->set('repository_factory', $repositoryFactory);
    

    $controller = $router->getCurrent()->controller;
    $action = $router->getCurrent()->action;
    
    $controller = '\\Controller\\' . ucfirst($controller) . 'Controller';
    
    $controller = new $controller();
    $controller->setContainer($container);

    $action = $action . 'Action';
    
    if (!method_exists($controller, $action)) {
        throw new \Exception("{$action} not found");
    }
    
    $content = $controller->$action($request);
    
} catch (\Exception $e) {
    $content = $e->getMessage();
}
echo $content;
