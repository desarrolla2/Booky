<?php
/**
 * This file is part of the booky project.
 *
 * Copyright (c)
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 */

namespace Desarrolla2\Bundle\BookyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Desarrolla2\Bundle\BookyBundle\Form\Handler\SearchHandler;
use Desarrolla2\Bundle\BookyBundle\Form\Model\SearchModel;
use Desarrolla2\Bundle\BookyBundle\Form\Type\SearchType;

/**
 * Class SearchController
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 */

class SearchController extends Controller
{

    /**
     * @Route("/search", name="search")
     * @Method({"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new SearchType(), new SearchModel());
        $handler = new SearchHandler($form, $request);
        $searchEngine = $this->get('booky.engine.search');
        $em =  $this->getDoctrine()->getManager();

        if (!$handler->process()) {
            return new JsonResponse($handler->getErrorsAsString(), 400);
        }

        $book = $searchEngine->search($handler->getQuery());
        if (!$book) {
            return new JsonResponse($searchEngine->getErrorsAsString(), 400);
        }

        $em->getRepository('BookyBundle:Book')->factory($book);


        return new JsonResponse($book, 200);
    }


    /**
     * @Template()
     * @param Request $request
     * @return array
     */
    public function formAction(Request $request)
    {
        $form = $this->createForm(new SearchType(), new SearchModel());

        return array(
            'form' => $form->createView(),
        );
    }
}