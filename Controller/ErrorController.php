<?php
namespace Controller;
use Framework\Controller;
use Framework\Request;
use Framework\Router;
use Framework\Session;


class ErrorController extends Controller
{
    private $exception;

    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    public function error404Action(Request $request)
    {
        return $this->render('error404.phtml');
    }

    public function errorAction()
    {
        $message = $this->exception->getMessage();

        return $this->render('error.phtml', ['message' => $message]);
    }
}