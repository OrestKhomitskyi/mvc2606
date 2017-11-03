<?php
namespace Controller;


use Framework\AccessDeniedException;
use Framework\Controller;
use Framework\Request;
use Framework\UserNotFoundException;
use Framework\Session;
use Model\Form\LoginForm;
use Model\Entity\User;

class SecurityController extends Controller
{

    //Auth
    public function loginAction(Request $request)
    {
        error_reporting(E_ALL);


        $form = new LoginForm(
            $request->post('email'),
            $request->post('password')
        );

        $container = $this->container;

        if ($request->isPost()) {
            if ($form->isValid()) {

                $user = $container
                    ->get('repository_factory')
                    ->repository('User')
                    ->findByEmail($form->email)
                ;
                try {
                    if (!$user) {
                        throw new UserNotFoundException();
                    }
//dev disabled
//                    $this->verify($form->password, $user);
                } catch (\Exception $e) {

                    Session::setFlash($e->getMessage());

                    $container
                        ->get('router')
                        ->redirect('/login');
                }
                Session::set('user', $user);
                $container->get('router')->redirect('/admin');
            }

            Session::setFlash('Invalid form');
        }

        return $this->render('login.html.twig', ['form' => $form]);
    }

    public function logoutAction()
    {
        Session::remove('user');
        $this->container->get('router')->redirect('/');
    }

    public function changePasswordAction()
    {

    }

    public function registerAction()
    {

    }

    public function activateAccountAction()
    {

    }

    private function verify($password, User $user)
    {
        $result = password_verify($password, $user->getPassword());

        if ($result) {
            return true;
        }

        throw new AccessDeniedException();
    }

    //API
    public function apiAction(Request $request){
        $api=$this->container->get('API');
        return $api->match($request);
    }



}