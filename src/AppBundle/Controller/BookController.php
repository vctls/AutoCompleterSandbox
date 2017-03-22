<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Form\BookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class BookController extends Controller
{
    /**
     * @Route("/new-book", name="new_book")
     * @Method({"GET", "PUT"})
     * @Template("book/new.html.twig")
     * @param Request $request
     *
     * @return RedirectResponse|array
     */
    public function newAction(Request $request)
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book, ['method' => 'PUT']);
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.book')->add($book);
            $this->addFlash('success', 'New book added.');

            return $this->redirectToRoute('homepage');
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/edit-book/{id}", name="edit_book")
     * @Method({"GET", "POST"})
     * @Template("book/edit.html.twig")
     *
     * @param Book $book
     * @param Request $request
     *
     * @return RedirectResponse|array
     */
    public function editAction(Book $book, Request $request)
    {
        $form = $this->createForm(BookType::class, $book);
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.book')->add($book);
            $this->addFlash('success', 'Book updated.');

            return $this->redirectToRoute('homepage');
        }

        return ['book' => $book, 'form' => $form->createView()];
    }
}
