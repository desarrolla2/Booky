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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class HistoryController
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 */

class HistoryController extends Controller
{
    /**
     * @Route("/history", name="history")
     * @Method({"GET"})
     * @Template()
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $em->getRepository('BookyBundle:Book')->getQueryForHistory(),
            $this->get('request')->query->get('page', 1),
            10
        );

        return array(
            'pagination' => $pagination
        );
    }
}