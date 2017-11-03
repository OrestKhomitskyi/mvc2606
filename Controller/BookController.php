<?php

namespace Controller;

use Framework\Controller;
use Framework\Request;
use Model\Repository\BookRepository;

class BookController extends Controller
{
    const BOOKS_PER_PAGE=15;
    public function indexAction(Request $request)
    {
        $repository =  $this
            ->container
            ->get('repository_factory')
            ->repository('Book')
        ;

        $amount=(int)$repository->getAmount();

        $pageAmount=ceil($amount/BookController::BOOKS_PER_PAGE);

        $page=(int)$request->get('page');

        if($page<0 || $page>$pageAmount){
            return $this->container->get('router')->redirect('/books-1');
        }

        $page--;

        $pageAmount=ceil($amount/BookController::BOOKS_PER_PAGE);

        $books = $repository->findAll($page,BookController::BOOKS_PER_PAGE);

        return $this->render('index.html.twig', [
            'books' => $books,
            'pages'=>$pageAmount
        ]);
    }
    
    public function showAction(Request $request)
    {
        $id = $request->get('id'); // $_GET['id']
        $repository = $this
            ->container
            ->get('repository_factory')
            ->repository('Book')
        ;

        $book = $repository->find($id);

        return $this->render('show.html.twig', [
            'book' => $book
        ]);
    }
}