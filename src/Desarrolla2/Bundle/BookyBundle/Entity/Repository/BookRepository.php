<?php

namespace Desarrolla2\Bundle\BookyBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Desarrolla2\Bundle\BookyBundle\Entity\Book;

/**
 * BookRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookRepository extends EntityRepository
{

    public function getQueryBuilderForHistory()
    {
        $em = $this->getEntityManager();

        return $em->createQueryBuilder()
            ->select('b')
            ->from('BookyBundle:Book', 'b');
    }

    public function factory(array $bookArray)
    {
        $em = $this->getEntityManager();
        if (!isset($bookArray['isbn'])) {
            throw new \Exception ('isbn not found');
        }

        $book = $this->findOneBy(
            array(
                'isbn' => $bookArray['isbn']
            )
        );
        if (!$book) {
            $book = new Book();
            $book->setIsbn($bookArray['isbn']);
        }

        foreach (array('title', 'resume', 'rating', 'price', 'source', 'image') as $property) {
            if (isset($bookArray[$property])) {
                $method = 'set' . $property;
                $book->$method($bookArray[$property]);
            }
        }

        if (isset($bookArray['author'])) {
            $author = $em->getRepository('BookyBundle:Author')->factory($bookArray['author']);
            $book->setAuthor($author);
        }

        if (isset($bookArray['editorial'])) {
            $editorial = $em->getRepository('BookyBundle:Editorial')->factory($bookArray['editorial']);
            $book->setEditorial($editorial);
        }
        if (isset($bookArray['suggestions'])) {
            $suggestions = $em->getRepository('BookyBundle:Suggestion')->factory($bookArray['suggestions']);
            //$book->setSuggestions($suggestions);
        }

        $em->persist($book);
        $em->flush();
    }
}
