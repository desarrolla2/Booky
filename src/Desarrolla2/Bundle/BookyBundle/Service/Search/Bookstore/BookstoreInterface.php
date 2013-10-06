<?php
/**
 * This file is part of the booky project.
 *
 * Copyright (c)
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 */

namespace Desarrolla2\Bundle\BookyBundle\Service\Search\Bookstore;

/**
 * Class BookstoreInterface
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es> 
 */

interface BookstoreInterface {

    /**
     * @param $url
     * @return mixed
     */
    public function search($url);

}