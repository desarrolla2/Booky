<?php

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

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     * @Method({"GET"})
     * @Template()
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request)
    {
        return array();
    }


}
