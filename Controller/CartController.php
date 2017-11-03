<?php
namespace Controller;
use Framework\Controller;
use Framework\Cookie;
use Framework\Request;
use Framework\Response;
use Framework\Session;

class CartController extends Controller
{
    public function indexAction(Request $request)
    {

        $currentCart = Session::get('cart', []);

        $books = $this
            ->container
            ->get('repository_factory')
            ->createRepository('Book')
            ->findByIds($currentCart);

        return $this->render('index.html.twig', ['books' => $books]);
    }

    public function addToCartAction(Request $request)
    {

        Cookie::set('hello',true);

        $id = $request->get('id');
//        return (new Response(['id'=>$id]))->json();

        // todo: separate class CartService
        // todo:
        $currentCart = Session::get('cart', []);
        $currentCart[] = $id;
        // $currentCart[$id]++;

        Session::set('cart', array_unique($currentCart));
        $this->container->get('router')->redirect('/books-1');
    }

    public function removeFromCartAction()
    {

    }

    public function clearCartAction()
    {

    }
}