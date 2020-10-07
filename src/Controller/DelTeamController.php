<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DelTeamController extends AbstractController
{
    /**
     * @Route("/del/team/{id_team}", name="del_team")
     */
    public function index(TeamRepository $teamRepo, $id_team)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $team = $teamRepo->find($id_team);
        $entityManager->remove($team);
        $entityManager->flush();

        return $this->redirectToRoute('team_screen');
    }
}
