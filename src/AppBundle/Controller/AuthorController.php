<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use AppBundle\Form\AuthorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends Controller
{
    /**
     * @Route("/search-author", name="search_author", defaults={"_format"="json"})
     * @Method("GET")
     * @Template("author/search.json.twig")
     *
     * @param Request $request
     *
     * @return array
     */
    public function searchAction(Request $request)
    {
        $qs = $request->query->get('q', $request->query->get('term', ''));
        $authors = $this->get('app.repository.author')->findLike($qs);

        return ['authors' => $authors];
    }

    /**
     * @Route("/get-author/{id}", name="get_author", defaults={"_format"="json"})
     * @Method("GET")
     *
     * @param null $id
     *
     * @return JsonResponse
     */
    public function getAction($id = null)
    {
        if (is_null($author = $this->get('app.repository.author')->find($id))) {
            throw $this->createNotFoundException();
        }

        return $this->json($author->getName());
    }

    /**
     * You can use this action to add new author, both in "classic" mode and in an ajax modal.
     *
     * @Route("/new-author", name="new_author")
     * @Method({"GET", "PUT"})
     * @Template("author/new.html.twig")
     *
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse|array
     */
    public function newAction(Request $request)
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author, [
            'method' => 'PUT',
            // notice that we need to explicit 'action', otherwise modal form will not work
            'action' => $this->generateUrl('new_author'),
        ]);
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.author')->add($author);
            if ($request->isXmlHttpRequest()) {
                return $this->json([
                    'id' => $author->getId(),
                    'name' => $author->getName(),
                    'type' => 'author',
                ]);
            } else {
                $this->addFlash('success', 'New author added.');

                return $this->redirectToRoute('homepage');
            }
        }

        return ['form' => $form->createView()];
    }
}
