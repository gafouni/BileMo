<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Phone;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PhonesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void 
    {
        //Utilisation de Faker
        $faker = Factory::create('fr_FR'); 
        //Creation de 25 references de telephone
            for ($i = 0; $i < 25; $i++) {
                $phone = new Phone();
                $phone->setModel($faker->words(3, true));
                $phone->setReference($faker->words(1, true));
                $phone->setColor($faker->words(1, true));
                $phone->setDescription($faker->text());
                $phone->setPrice($faker->numberBetween($min=100, $max=2000));

                $manager->persist($phone);
            }
    
            $manager->flush();
    }
}
