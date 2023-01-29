<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Phone;
use App\Entity\Client;
use DateTimeImmutable;
//use App\Datafixtures\Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHacher;

    public function __construct(UserPasswordHasherInterface $userPasswordHacher)
    {
        $this->userPasswordHasher = $userPasswordHacher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //Creation des produits
        for($k=1; $k<=25; $k++){

            $phone = new Phone();

            $phone->setModel($faker->word)
                    ->setReference($faker->words(3, true))
                    ->setColor($faker->word)
                    ->setDescription($faker->words(10, true))
                    ->setPrice($faker->numberBetween($min = 750, $max = 1500));

            $manager->persist($phone);       
        }

        // $manager->flush();



        //Creation des clients
        for($i=1; $i<=5; $i++){

            $client = new Client();

            $client->setName($faker->word);
            $client ->setEmail($faker->email);
            $client->setRoles(["ROLE_USER"]);
            $client->setPassword($this->userPasswordHasher->hashPassword($client, "password"));
            //$client->setCreatedAt(\DateTimeImmutable::createFromMutable(self::faker()->datetimeBetween('-6 month', 'now')));
            $client->setCreatedAt(new DateTimeImmutable('now'));
            //$client->getUser($user);

            $manager->persist($client);


        //Creation des utilisateurs
            for($j=1; $j<=5; $j++){

                $user = new User();

                $user->setUsername($faker->words(2, true))
                    ->setEmail($faker->email)
                    ->setPassword($this->userPasswordHasher->hashPassword($user, "password"))
                    ->setCreatedAt(new DateTimeImmutable('now'))
                    //->setCreatedAt($faker->datetimeBetween('-6mont', 'now'))
                    ->setClient($client);

                $manager->persist($user);
            }

        }

        $manager->flush();

    
    }



}
