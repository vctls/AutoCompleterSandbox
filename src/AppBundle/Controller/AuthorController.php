<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    /**
     * @Route("/search-author", name="search_author")
     * @Method("GET")
     */
    public function searchAction(Request $request)
    {
        $qs = $request->query->get('q');
        $authors = $this->get('app.repository.author')->findLike($qs);

        return $this->render('default/search.json.twig', ['authors' => $authors]);
    }

    /**
     * @Route("/get-author/{id}", name="get_author")
     * @Method("GET")
     */
    public function getAction($id = null)
    {
        if (is_null($author = $this->get('app.repository.author')->find($id))) {
            throw $this->createNotFoundException();
        }

        return new Response($author->getName());
    }
}
