<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 27.10.17
 * Time: 19:26
 */

namespace Framework;


use Throwable;

class AccessDeniedException extends \Exception
{
//    public function __construct($message = "", $code = 0, Throwable $previous = null)
//    {
//        parent::__construct($message, $code, $previous);
//    }
    public function __construct()
    {
        parent::__construct('Access denied');
    }
}