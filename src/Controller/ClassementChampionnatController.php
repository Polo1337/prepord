<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Match;
use App\Repository\MatchRepository;

class ClassementChampionnatController extends AbstractController
{
    /**
     * @Route("/classement/championnat/{id_team}", name="classement_championnat")
     */
    public function index($id_team)
    {
        return $this->render('classement_championnat/index.html.twig', [
            'controller_name' => 'ClassementChampionnatController',
            'idteam' => $id_team,
        ]);
    }
}
