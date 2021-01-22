<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setSlug('test');
        $product->setName('test product');
        $manager->persist($product);

        for ($i = 0; $i < 10; $i++) {
            $comment = new Comment();
            $comment->setAuthor("user_{$i}");
            $comment->setProduct($product);
            $comment->setContent("#{$i}. lorem ipsum");
            $manager->persist($comment);
        }

        $manager->flush();
    }
}
