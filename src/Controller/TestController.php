<?php

namespace App\Controller;

use App\Entity\Player;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {

        $player = new Player();
        $player->setEssais(139, 0);
        $player->setTransformations(139, 0);
        $player->setPenalites(139, 0);
        $player->setDrops(139, 0);
        $player->setRouges(139, 0);
        $player->setJaunes(139, 0);
        $player->setTemps(139, 0);
        
        
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
