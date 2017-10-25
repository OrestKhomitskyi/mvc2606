<?php

namespace Framework;

abstract class Controller
{
    protected $container;
    
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    protected function render($view, array $args = [])
    {
        extract($args);
        
        $path = str_replace(['Controller', '\\'], '', get_class($this));
        $file = VIEW_DIR . $path . DS . $view;
        
        if (!file_exists($file)) {
            throw new \Exception("{$file} not found");
        }
        
        ob_start();
        require $file;
        $content = ob_get_clean();
        
        ob_start();
        require VIEW_DIR . 'layout.phtml';
        $html = ob_get_clean();
        
        return new Response($html);
    }
}