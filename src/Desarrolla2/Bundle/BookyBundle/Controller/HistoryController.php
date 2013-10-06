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
use Desarrolla2\Bundle\BookyBundle\Form\Type\HistoryFilterType;
use Desarrolla2\Bundle\BookyBundle\Form\Model\HistoryFilterModel;

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
        $queryBuilder = $em->getRepository('BookyBundle:Book')->getQueryBuilderForHistory();
        $form = $this->createForm(new HistoryFilterType(), new HistoryFilterModel());

        $form->submit($request);
        if ($form->isValid()) {
            $order = $form->getData()->getOrder();
            $mode = $form->getData()->getMode();
            if ($order && $mode) {
                $queryBuilder->orderBy('b.' . $order, $mode);
            }
        }

        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $this->get('request')->query->get('page', 1),
            8
        );

        return array(
            'pagination' => $pagination,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/view/{id}", name="view")
     * @Method({"GET"})
     * @Template()
     *
     * @param Request $request
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return array
     */
    public function viewAction(Request $request)
    {
        $book = $this->getDoctrine()->getManager()
            ->getRepository('BookyBundle:Book')->find($request->get('id', 1));
        if (!$book) {
            throw $this->createNotFoundException('The book does not exist');
        }

        return array(
            'item' => $book,
        );
    }
}