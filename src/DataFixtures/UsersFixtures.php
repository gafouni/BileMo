<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    private  UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
        {
            $this->hasher = $hasher;
        }

    public function load(ObjectManager $manager): void
    {
         //Utilisation de Faker
         $faker = Factory::create('fr_FR');

         //Creation des utilisateurs
         for($i = 1; $i<=5; $i++){

            $user = new User();
            $user->setUsername($faker->words(2, true));
            $user->setEmail($faker->email);

           // $password = $this->$hasher->hashPassword($user, 'password');
            $user->setPassword($faker->password);
            
            if($i === 1)
                $user->setRoles(['ROLE_ADMIN']);
            else
                $user->setRoles(['ROLE_USER']); 

            $manager->persist($user);

        }   
        $manager->flush(); 
    }
}
