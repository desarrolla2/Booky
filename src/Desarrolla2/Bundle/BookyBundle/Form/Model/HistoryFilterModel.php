<?php
/**
 * This file is part of the booky project.
 *
 * Copyright (c)
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 */

namespace Desarrolla2\Bundle\BookyBundle\Form\Model;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class HistoryFilterModel
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 */

class HistoryFilterModel
{

    /**
     * @var string $order
     * @Assert\Choice(choices = {"createdAt", "updatedAt", "rating", "price", "title"})
     */
    protected $order;

    /**
     * @var string $mode
     * @Assert\Choice(choices = {"ASC", "DESC"})
     */
    protected $mode;

    /**
     * @param string $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }
}