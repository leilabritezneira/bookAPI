<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création des auteurs.
        $listAuthor = [];
        for ($i = 0; $i < 10; $i++) {
            $author = new Author();
            $author->setFirstName("Prénom " . $i);
            $author->setLastName("Nom " . $i);
            $manager->persist($author); // On sauvegarde l'auteur créé dans un tableau.
            $listAuthor[] = $author;
        }

        // Création des livres
        for ($i = 0; $i < 20; $i++) {
            $book = new Book();
            $book->setTitle("Titre " . $i);
            $book->setCoverText("Quatrième de couverture numéro : " . $i);
            $book->setAuthor($listAuthor[array_rand($listAuthor)]); // On lie le livre à un auteur pris au hasard dans le tableau des auteurs.
            $manager->persist($book);
        }

        $manager->flush();
    }
}
