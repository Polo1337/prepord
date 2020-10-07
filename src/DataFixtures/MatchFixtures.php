<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Match;
use App\Entity\MatchType;
use App\DataFixtures\MatchFixtures;
use App\Repository\MatchRepository;
use App\Repository\MatchTypeRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class MatchFixtures extends Fixture
{

    protected $em;

    public function __construct(EntityManagerInterface $emm)
    {
        $this->em = $emm;
    }

    public function load(ObjectManager $manager)
    {

        // $match_repo = $this->getRepository('App\Entity\MatchType')->find(random_int(0,2));
        var_dump($match_repo);
         $faker = Faker\Factory::create('fr_FR');
        $match = [];
        for ($i=0; $i < 15; $i++) {
            $match[$i] = new Match();
            // $product = new Product();
        // $manager->persist($product);

            
            $match[$i]->setDate($faker->dateTime('now', null));
            $match[$i]->setDuration(null);
            $match[$i]->setLocalTeam($faker->company);
            $match[$i]->setVisitorTeam($faker->company);
            $match[$i]->setMatchType($match_repo->find(random_int(0,2)));
            // $match->setStats();
            // $match->setComposition($faker->);

            $manager->flush();
            $manager->persist($match[$i]);
        }
        

    }
}
