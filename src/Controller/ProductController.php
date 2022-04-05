<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Product;
use App\Entity\ProductType;
use App\Entity\TypeCategory;
use Doctrine\ORM\EntityManagerInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function index(): Response
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $types = $this->getDoctrine()->getRepository(ProductType::class)->findAll();

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $products,
            'types' => $types
        ]);
    }


    /**
     * @Route("/products/{id}", name="product")
     */
    public function productDetails($id): Response
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        return $this->render('product/details.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $product
        ]);
    }
}
