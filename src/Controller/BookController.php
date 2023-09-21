<?php

namespace App\Controller;

use App\Entity\Book;  //Con ParamConverter -> composer require sensio/framework-extra-bundle
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class BookController extends AbstractController
{
    #[Route('/api/books', name: 'books', methods: ['GET'])]
    public function getAllBooks(BookRepository $bookRepository, SerializerInterface $serializer): JsonResponse
    {
        $bookList = $bookRepository->findAll();
        $jsonBookList = $serializer->serialize($bookList, 'json', ['groups' => 'getBooks']);
        return new JsonResponse($jsonBookList, Response::HTTP_OK, [], true);
    }

    /*
    #[Route('/api/books/{id}', name: 'book', methods: ['GET'])]
    public function getOneBook(int $id, BookRepository $bookRepository, SerializerInterface $serializer) {
        $book = $bookRepository->find($id);
        if($book){
            $jsonBook = $serializer->serialize($book, 'json');
            return new JsonResponse($jsonBook, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
    }
    */
    //Forma facilitada con ParamConverter -> composer require sensio/framework-extra-bundle

    #[Route('/api/books/{id}', name: 'detailBook', methods: ['GET'])]
    public function getDetailBook(Book $book, SerializerInterface $serializer) {
        $jsonBook = $serializer->serialize($book, 'json', ['groups' => 'getBooks']);
        return new JsonResponse($jsonBook, Response::HTTP_OK, [], true);
    }

}
