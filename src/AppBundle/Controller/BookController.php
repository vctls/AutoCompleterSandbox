<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    /**
     * @Route("/new-book", name="new_book")
     * @Method({"GET", "PUT"})
     */
    public function newAction(Request $request)
    {
        $book = new Book();
        $form = $this->createForm('AppBundle\Form\BookType', $book, ['method' => 'PUT']);
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.book')->add($book);
            $this->addFlash('success', 'New book added.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('book/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/edit-book/{id}", name="edit_book")
     * @Method({"GET", "POST"})
     */
    public function editAction(Book $book, Request $request)
    {
        $form = $this->createForm('AppBundle\Form\BookType', $book);
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.book')->add($book);
            $this->addFlash('success', 'Book updated.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('book/edit.html.twig', ['book' => $book, 'form' => $form->createView()]);
    }
}
