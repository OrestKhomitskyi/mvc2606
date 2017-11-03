<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 27.10.17
 * Time: 19:22
 */

namespace Controller\Admin;


use Framework\Controller;
use Framework\Request;
use Framework\Session;
use Framework\AccessDeniedException;
use Model\Entity\User;
use function PHPSTORM_META\type;

class DefaultController extends Controller
{
    public function indexAction(Request $request){
        $user=Session::get('user');

        if (!Session::has('user') || $user->getRole()!=User::ROLE_ADMIN) {
            throw new AccessDeniedException();
        }
        $this->setLayout(self::ADMIN_LAYOUT);

        return $this->render('index.html.twig');
    }
}