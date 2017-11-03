<?php

namespace Framework;


abstract class Controller
{
    const DEFAULT_LAYOUT = 'layout.html.twig';

    const ADMIN_LAYOUT = 'admin_layout.html.twig';



    protected $container;
    protected $layout=self::DEFAULT_LAYOUT;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function setLayout($layout)
    {
        $this->layout=$layout;
//        $route=$this->container->get('router')->getCurrent();
//        if ($route->isAdmin()===true) {
//            $this->layout = self::ADMIN_LAYOUT;
//        }
//        else $this->layout = self::DEFAULT_LAYOUT;
    }

    protected function render($view,array $args=[]){
        $twig=$this->container->get('twig');
        $loader = new \Twig_Loader_Filesystem(VIEW_DIR);
        $admin_prefix='';

        if($this->layout===self::ADMIN_LAYOUT) {
            $loader=new \Twig_Loader_Filesystem(ADMIN_DIR.DS);
            $admin_prefix='Admin';
        }
        $twig->setLoader($loader);
        $path = str_replace(['Controller', '\\',$admin_prefix], '', get_class($this));

        $file = $path. DS . $view;

        return $twig->render($file,$args);
    }
//    protected function render($view, array $args = [])
//    {
//        extract($args);
//
//        $path = str_replace(['Controller', '\\'], '', get_class($this));
//        $file = VIEW_DIR . $path . DS . $view;
//
//        if (!file_exists($file)) {
//            throw new \Exception("{$file} not found");
//        }
//
//        ob_start();
//        require $file;
//        $content = ob_get_clean();
//
//        ob_start();
//        require VIEW_DIR . 'layout.phtml';
//        $html = ob_get_clean();
//
//        return new Response($html);
//    }
}