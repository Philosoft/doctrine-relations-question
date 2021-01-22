<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{slug}", name="product")
     */
    public function show(Product $product): Response
    {
        return $this->render('product/index.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/custom-product/{slug}", name="custom_product")
     */
    public function customShow(string $slug, ProductRepository $repository): Response
    {
        $product = $repository->findOneBySlug($slug);
        if ($product === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('product/index.html.twig', [
            'product' => $product,
        ]);
    }
}
