<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Player;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PlayerFixtures extends Fixture
{

    public function __construct()
    {
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        
        $faker = Faker\Factory::create('fr_FR');
        $player = [];
        
        for ($i = 0; $i < 30; $i++) {
            
            $player[$i] = new Player();
            $player[$i]->setLestName($faker->lastName);
            $player[$i]->setFirstName($faker->firstNameMale);
            $player[$i]->setPicture($faker->firstNameMale);
            $player[$i]->setBirthDate($faker->dateTimeBetween('-30 years', 'now'));
            $player[$i]->setClubEntryDate($faker->dateTimeBetween('-10 years', 'now'));
            // $player->setStats("[]");
            $player[$i]->setLicenseNumber($faker->randomNumber(5));
            $manager->persist($player[$i]);
        
        }
        
        $manager->flush();


    }
}
