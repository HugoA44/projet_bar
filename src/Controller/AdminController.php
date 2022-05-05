<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Product;

use App\Entity\ProductType;
use App\Entity\TypeCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'products' => $products,
        ]);
    }

    /**
     * @Route("/admin/addproduct", name="adminAddProduct")
     */
    public function addproduct(EntityManagerInterface $entityManager, Request $request): Response
    {
        $product = new Product;

        // Création du formulaire
        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class, array('required' => true))
            ->add('description', TextType::class, array('required' => true))
            ->add('image', FileType::class, array('required' => true))
            ->add('price', IntegerType::class, array('required' => true))
            ->add(
                'productType',
                EntityType::class,
                [
                    'class' => ProductType::class,
                    'choice_label' => "name",
                    'mapped' => false
                ],
                array('required' => true)
            )
            ->add(
                'category',
                EntityType::class,
                [
                    'class' => TypeCategory::class,
                    'choice_label' => "name",
                    'mapped' => false
                ],
                array('required' => true)
            )
            ->add('save', SubmitType::class, [
                'label' => 'Add',
                'attr' => ['class' => 'btn-full']

            ])
            ->getForm();

        //Récupération des données
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $product->setProductType($form->get("productType")->getData());
            $product->setCategory($form->get("category")->getData());

            $file = $form->get('image')->getData();
            //Récupération des données
            $product = $form->getData();
            $product->setImage($file->getClientOriginalName());
            //Sauvegardes des données
            $entityManager->persist($product);
            //Execution de l'insertion des données
            $entityManager->flush();
            //Sauvegarde du fichier
            $file->move('assets/images/' . $product->getProductType()->getName() . '/', $file->getClientOriginalName());
        }


        return $this->render('admin/addproduct.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
            'action' => 'Add new product'
        ]);
    }

    /**
     * @Route("/admin/removeproduct/{id}", name="adminRemoveProduct")
     */
    public function removeProduct(int $id): Response
    {
        //Récupération du manager de données
        $entityManager = $this->getDoctrine()->getManager();

        //Sélection d'une donnée par son id
        $product = $entityManager->getRepository(Product::class)->find($id);

        //Vérification si le produit existe bien
        if (!$product) {
            throw $this->createNotFoundException(
                'Pas de produit trouvé avec cet id :' . $id
            );
        }

        //Suppression de l'objet
        $entityManager->remove($product);

        //Exectution de la requête
        $entityManager->flush();

        //Redirection
        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/updateproduct/{id}", name="adminUpdateProduct")
     */
    public function updateproduct(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        //Récupération du manager de données
        $entityManager = $this->getDoctrine()->getManager();

        //Sélection d'une donnée par son id
        $product = $entityManager->getRepository(Product::class)->find($id);

        //Vérifictation si le produit existe bien
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        // Création du formulaire
        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class, array('required' => true))
            ->add('description', TextType::class, array('required' => true))
            ->add('image', FileType::class, ['data_class' => null, 'empty_data' => $product->getImage(), 'required' => false])
            ->add('price', IntegerType::class, array('required' => true))
            ->add(
                'productType',
                EntityType::class,
                [
                    'class' => ProductType::class,
                    'choice_label' => "name",
                    'mapped' => false
                ],
                array('required' => true)
            )
            ->add(
                'category',
                EntityType::class,
                [
                    'class' => TypeCategory::class,
                    'choice_label' => "name",
                    'mapped' => false
                ],
                array('required' => true)
            )
            ->add('save', SubmitType::class, [
                'label' => 'Add',
                'attr' => ['class' => 'btn-full']
            ])
            ->getForm();

        //Récupération des données
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



            $product->setProductType($form->get("productType")->getData());
            $product->setCategory($form->get("category")->getData());

            $file = $form->get('image')->getData();
            //Récupération des données
            $product = $form->getData();

            if (!is_string($file)) {
                $product->setImage($file->getClientOriginalName());
            }

            //Sauvegardes des données
            $entityManager->persist($product);
            //Execution de l'insertion des données
            $entityManager->flush();

            if (!is_string($file)) {
                //Sauvegarde du fichier
                $file->move('assets/images/' . $product->getProductType()->getName() . '/', $file->getClientOriginalName());
            }
        }


        return $this->render('admin/addproduct.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
            'action' => 'Update product'
        ]);
    }
}
