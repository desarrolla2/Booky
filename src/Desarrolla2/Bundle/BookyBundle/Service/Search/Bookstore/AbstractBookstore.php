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

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\BrowserKit\Request;


/**
 * Class AbstractBookstore
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 */

abstract class AbstractBookstore
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Crawler
     */
    protected $crawler;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $errors = array();

    /**
     *
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $url
     * @return bool
     */
    protected function send($url)
    {
        $this->errors = array();
        $this->url = $url;

        $this->crawler = $this->client->request('GET', $this->url);

        $this->response = $this->client->getResponse();
        $this->request = $this->client->getRequest();

        if ($this->response->getStatus() != 200) {
            $this->errors[] = 'This url doesn`t work with status code ' . $this->response->getStatus();

            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getErrorsAsString()
    {
        return implode(', ', $this->errors);
    }
}