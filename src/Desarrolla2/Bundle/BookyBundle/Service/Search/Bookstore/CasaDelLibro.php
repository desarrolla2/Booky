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
 * Class CasaDelLibro
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 */

class CasaDelLibro extends AbstractBookstore implements BookstoreInterface
{
    /**
     * @param $url
     * @return mixed
     */
    public function search($url = 'http://www.casadellibro.com/libro-circo-maximo/9788408117117/2125380')
    {
        if (!$this->send($url)) {
            return false;
        }

        return array(
            'source' => $url,
            'title' => $this->getTitle(),
            'author' => $this->getAuthor(),
            'isbn' => $this->getIsbn(),
            'image' => $this->getImage(),
            'editorial' => $this->getEditorial(),
            'resume' => $this->getResume(),
            'rating' => $this->getRating(),
            'price' => $this->getPrice(),
            'suggestions' => $this->getSuggestions(),
        );
    }

    private function getImage()
    {
        try {
            $nodes = $this->crawler->filter('div.book-header-img img');
            foreach ($nodes as $node) {
                return $node->getAttribute('src');
            }
        } catch (\Exception $e) {
        }

        return '';
    }

    /**
     * @return array
     */
    private function getSuggestions()
    {
        $items = array();
        try {
            $nodes = $this->crawler->filter('div.mod-three-columns.mod-list-bigpic .product-item a');
            if ($nodes->count()) {
                foreach ($nodes as $node) {
                    $items[] = 'http://www.casadellibro.com' . $node->getAttribute('href');
                }
            }
        } catch (\Exception $e) {
        }

        return $items;
    }

    /**
     * @return bool|string
     */
    private function getPrice()
    {
        try {
            return (float)trim(
                str_replace('€', '', $this->crawler->filter('div.book-header-3-price span.new')->text())
            );
        } catch (\Exception $e) {
        }

        return 0;
    }

    /**
     * @return bool|string
     */
    private function getResume()
    {
        try {
            return $this->crawler->filter('p.smaller.pb15')->text();
        } catch (\Exception $e) {
        }

        return '';
    }

    /**
     * @return bool|string
     */
    private function getEditorial()
    {
        try {
            return $this->crawler->filter('span.book-header-2-subtitle-publisher')->text();
        } catch (\Exception $e) {
        }

        return '';
    }

    /**
     * @return bool|string
     */
    private function getIsbn()
    {
        try {
            return $this->crawler->filter('span.book-header-2-subtitle-isbn strong')->text();
        } catch (\Exception $e) {
        }

        return '';
    }

    /**
     * @return bool|string
     */
    private function getAuthor()
    {
        try {
            return $this->crawler->filter('h2 .book-header-2-subtitle-author')->text();
        } catch (\Exception $e) {
        }

        return '';
    }

    /**
     * @return bool|string
     */
    private function getTitle()
    {
        try {
            return $this->crawler->filter('h1.book-header-2-title')->text();
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * @return bool|int
     */
    private function getRating()
    {
        try {
            $nodes = $this->crawler->filter('div.stars span.average-rating');
            foreach ($nodes as $node) {
                return (int)trim(
                    str_replace('star0', '', str_replace('average-rating', '', $node->getAttribute('class')))
                );
            }
        } catch (\Exception $e) {
            return 0;
        }
    }
}