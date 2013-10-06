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

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class SearchModel
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 */

class SearchModel
{
    /**
     * @var string $content
     * @Assert\NotBlank()
     * @Assert\Length( min=5, max=200 )
     * @Assert\Url()
     * @Assert\Regex(
     * pattern="/^http:\/\/www\.casadellibro\.com\/\w+/",
     * message="This url does not belong to casadellibro.com" )
     */
    protected $query;

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery($query)
    {
        $this->query = (string)$query;
    }
}