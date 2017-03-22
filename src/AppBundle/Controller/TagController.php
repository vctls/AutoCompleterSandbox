<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use AppBundle\Form\TagType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends Controller
{
    /**
     * @Route("/search-tag", name="search_tag", defaults={"_format"="json"})
     * @Method("GET")
     * @Template("tag/search.json.twig")
     *
     * @param Request $request
     *
     * @return array
     */
    public function searchAction(Request $request)
    {
        $qs = $request->query->get('q', $request->query->get('term', ''));
        $tags = $this->get('app.repository.tag')->findLike($qs);

        return ['tags' => $tags];
    }

    /**
     * @Route("/get-tag/{id}", name="get_tag", defaults={"_format"="json"})
     * @Method("GET")
     *
     * @param null $id
     *
     * @return JsonResponse
     */
    public function getAction($id = null)
    {
        if (is_null($tag = $this->get('app.repository.tag')->find($id))) {
            throw $this->createNotFoundException();
        }

        return $this->json($tag->getName());
    }

    /**
     * You can use this action to add new tag, both in "classic" mode and in an ajax modal.
     *
     * @Route("/new-tag", name="new_tag")
     * @Method({"GET", "PUT"})
     * @Template("tag/new.html.twig")
     *
     * @param Request $request
     *
     * @return JsonResponse|RedirectResponse|array
     */
    public function newAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag, [
            'method' => 'PUT',
            // notice that we need to explicit 'action', otherwise modal form will not work
            'action' => $this->generateUrl('new_tag'),
        ]);
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.tag')->add($tag);
            if ($request->isXmlHttpRequest()) {
                return $this->json([
                    'id' => $tag->getId(),
                    'name' => $tag->getName(),
                    'type' => 'tag'
                ]);
            } else {
                $this->addFlash('success', 'New tag added.');

                return $this->redirectToRoute('homepage');
            }
        }

        return ['form' => $form->createView()];
    }
}
