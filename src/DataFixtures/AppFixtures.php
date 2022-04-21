<?php

namespace App\DataFixtures;

use App\Entity\ProductType;
use App\Entity\TypeCategory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // Création d'un utilisateur admin
        $user = new User();
        $user->setUsername('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setIsVerified(true);

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'root'
        ));

        $manager->persist($user);
        $manager->flush();


        // BOISSON : Product Type
        $productType = new ProductType();
        $productType->setName('Boissons');
        $productType->setDescription('Articles à boire.');
        $manager->persist($productType);

        // BOISSON : Type Category
        $typeCategory = new TypeCategory();
        $typeCategory->setName('Bières');
        $typeCategory->setProductType($productType);
        $manager->persist($typeCategory);

        $typeCategory = new TypeCategory();
        $typeCategory->setName('Vins');
        $typeCategory->setProductType($productType);
        $manager->persist($typeCategory);

        $typeCategory = new TypeCategory();
        $typeCategory->setName('Cocktails');
        $typeCategory->setProductType($productType);
        $manager->persist($typeCategory);

        $typeCategory = new TypeCategory();
        $typeCategory->setName('Sodas');
        $typeCategory->setProductType($productType);
        $manager->persist($typeCategory);


        // SNACKS : Product Type
        $productType = new ProductType();
        $productType->setName('Snacks');
        $productType->setDescription('Articles à grignoter.');
        $manager->persist($productType);

        $typeCategory = new TypeCategory();
        $typeCategory->setName('Chips');
        $typeCategory->setProductType($productType);
        $manager->persist($typeCategory);

        $typeCategory = new TypeCategory();
        $typeCategory->setName('Saucissons');
        $typeCategory->setProductType($productType);
        $manager->persist($typeCategory);

        // PLATS : Product Type
        $productType = new ProductType();
        $productType->setName('Plats');
        $productType->setDescription('Articles à manger en repas.');
        $manager->persist($productType);

        $typeCategory = new TypeCategory();
        $typeCategory->setName('Burgers');
        $typeCategory->setProductType($productType);
        $manager->persist($typeCategory);

        $typeCategory = new TypeCategory();
        $typeCategory->setName('Viandes');
        $typeCategory->setProductType($productType);
        $manager->persist($typeCategory);

        $typeCategory = new TypeCategory();
        $typeCategory->setName('Salades');
        $typeCategory->setProductType($productType);
        $manager->persist($typeCategory);



        $manager->flush();
    }
}
