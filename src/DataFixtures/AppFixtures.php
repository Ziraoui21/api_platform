<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\ProductOrder;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $catRepo;
    private $proRepo;
    private $orderRepo;
    private $passwordHasher;

    public function __construct(CategoryRepository $catRepo,ProductRepository $proRepo,
    OrderRepository $orderRepo,UserPasswordHasherInterface $passwordHasher){
        $this->catRepo = $catRepo;
        $this->proRepo = $proRepo;
        $this->orderRepo = $orderRepo;
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i=0;$i<10;$i++)
        {
            $manager->persist((new Category)->setName($faker->name()));
        }

        $manager->flush();
        
        for($i=0;$i<30;$i++)
        {
            $category =  $this->catRepo->find(rand(1,10));

            $manager->persist((new Product)
            ->setName($faker->name())
            ->setPrice($faker->randomFloat(2,1,200))
            ->setDescription($faker->text())
            ->setCategory($category));
        }

        $manager->flush();


        for($i=0;$i<30;$i++)
        {
            $manager->persist((new Order)
            ->setDateOrder(new DateTime()));
        }

        $manager->flush();

        for($i=0;$i<10;$i++)
        {
            $manager->persist((new ProductOrder)
            ->setProduct($this->proRepo->find(rand(1,30)))
            ->setOrder($this->orderRepo->find(rand(1,30)))
            ->setQte(rand(1,10))
            );
        }

        $user = new User();
        $user->setUsername('ziraoui12');
        
        // Encode the password
        $user->setPassword($this->passwordHasher->hashPassword($user, '12344321'));

        // Persist the user
        $manager->persist($user);

        $manager->flush();
    }
}
