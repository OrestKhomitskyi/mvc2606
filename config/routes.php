<?php

use Framework\Route;

return array(
    'default'=> new Route('/','default','index'),
    'books'=>new Route('/books-{page}','book','index',array('page'=>"[1-9]+[0-9]*")),
    'feedback'=>new Route('/feedback','default','feedback')

);