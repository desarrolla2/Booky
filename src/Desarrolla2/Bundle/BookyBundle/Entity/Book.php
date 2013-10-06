<?php
/**
 * This file is part of the booky project.
 *
 * Copyright (c)
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 */

namespace Desarrolla2\Bundle\BookyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Class Book
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="Desarrolla2\Bundle\BookyBundle\Entity\Repository\BookRepository")
 */

class Book
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $title
     *
     * @ORM\Column(name="source", type="string", length=255)
     */
    private $source;

    /**
     * @var string $isbn
     *
     * @ORM\Column(name="isbn", type="string", length=255)
     */
    private $isbn;


    /**
     * @var string $resume
     *
     * @ORM\Column(name="resume", type="text")
     */
    private $resume;


    /**
     * @var int $rating
     *
     * @ORM\Column(name="rating", type="integer")
     */
    private $rating;

    /**
     * @var int $price
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Suggestion", mappedBy="book", cascade={"remove"})
     */
    private $suggestions;

    /**
     * @var Author
     *
     * @ORM\ManyToOne(targetEntity="Author")
     */
    private $author;

    /**
     * @var Editorial
     *
     * @ORM\ManyToOne(targetEntity="Editorial")
     */
    private $editorial;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->suggestions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     * @return Book
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set resume
     *
     * @param string $resume
     * @return Book
     */
    public function setResume($resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     * @return Book
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Book
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add suggestions
     *
     * @param \Desarrolla2\Bundle\BookyBundle\Entity\Suggestion $suggestions
     * @return Book
     */
    public function addSuggestion(\Desarrolla2\Bundle\BookyBundle\Entity\Suggestion $suggestions)
    {
        $this->suggestions[] = $suggestions;

        return $this;
    }

    /**
     * @param $suggestions
     * @return $this
     */
    public function setSuggestions($suggestions)
    {
        $this->suggestions = array();
        foreach ($suggestions as $s) {
            $this->addSuggestion($s);
        }

        return $this;
    }

    /**
     * Remove suggestions
     *
     * @param \Desarrolla2\Bundle\BookyBundle\Entity\Suggestion $suggestions
     */
    public function removeSuggestion(\Desarrolla2\Bundle\BookyBundle\Entity\Suggestion $suggestions)
    {
        $this->suggestions->removeElement($suggestions);
    }

    /**
     * Get suggestions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSuggestions()
    {
        return $this->suggestions;
    }

    /**
     * Set author
     *
     * @param \Desarrolla2\Bundle\BookyBundle\Entity\Author $author
     * @return Book
     */
    public function setAuthor(\Desarrolla2\Bundle\BookyBundle\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Desarrolla2\Bundle\BookyBundle\Entity\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set editorial
     *
     * @param \Desarrolla2\Bundle\BookyBundle\Entity\Editorial $editorial
     * @return Book
     */
    public function setEditorial(\Desarrolla2\Bundle\BookyBundle\Entity\Editorial $editorial = null)
    {
        $this->editorial = $editorial;

        return $this;
    }

    /**
     * Get editorial
     *
     * @return \Desarrolla2\Bundle\BookyBundle\Entity\Editorial
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Book
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Book
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Book
     */
    public function setSource($source)
    {
        $this->source = $source;
    
        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }
}