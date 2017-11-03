



<?php
//
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS . '..' . DS); // path: /../
define('VIEW_DIR', ROOT . 'View' . DS); // /View
define('CONF_DIR', ROOT . 'Config' . DS); // /Config
define('ADMIN_DIR',VIEW_DIR.'Admin'.DS);

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
    $twig->addFunction($twigFunction);
    $twig->addFunction($twigFunction2);
     $config=Symfony\Component\Yaml\Yaml::parse(file_get_contents(CONF_DIR.'config.yml'));
    $parameters=$config['parameters'];
    $routes=$config['routing'];
    $api=new \Framework\API($config['api_list']);

    $router = new \Framework\Router($routes);





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


    $container = new \Framework\Container();


    $repositoryFactory = new \Framework\RepositoryFactory();
    $repositoryFactory->setPdo($pdo);

    $container->setParameteres($parameters);
    $container->set('router', $router);
    $container->set('repository_factory', $repositoryFactory);
    $container->set('twig',$twig);
    $container->set('API',$api);
    $controller = $router->getCurrent()->controller;
    $action = $router->getCurrent()->action;
    $api->setContainer($container);

    $controller="\\Controller\\{$controller}";
    $controller = new $controller();
    $controller->setContainer($container);

    if (!method_exists($controller, $action)) {
        throw new \Exception("{$action} not found");
    }
    
    $content = $controller->$action($request);
    
} catch (\Exception $e) {
    $content = $e->getMessage();
}
echo $content;
