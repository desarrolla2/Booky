<?php
/**
 * This file is part of the booky project.
 *
 * Copyright (c)
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 */
namespace Desarrolla2\Bundle\BookyBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

/**
 * Class SearchHandler
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 */

class SearchHandler
{
    /**
     * @var  \Symfony\Component\Form\Form
     */
    protected $form;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;


    /**
     * @var array
     */
    protected $errors;

    /**
     * @param Form    $form
     * @param Request $request
     */
    public function __construct(Form $form, Request $request)
    {
        $this->form = $form;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function process()
    {
        $this->form->submit($this->request);

        if ($this->form->isValid()) {

            return true;
        }
        $this->processErrors();

        return false;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getErrorsAsString()
    {
        return implode(', ', $this->errors);
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->form->getData()->getQuery();
    }

    /**
     * Process errors from form
     */
    private function processErrors()
    {
        $queryType = $this->form->get('query');

        foreach ($this->form->getErrors() as $formError) {
            $this->errors[] = $formError->getMessage();
        }
        foreach ($queryType->getErrors() as $formError) {
            $this->errors[] = $formError->getMessage();
        }
    }
}