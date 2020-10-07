<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DelPlayerController extends AbstractController
{
    /**
     * @Route("/del/player/{id_player}/{id_team}", name="del_player")
     */
    public function index(PlayerRepository $playerRepo, $id_player,$id_team)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $player = $playerRepo->find($id_player);
        $entityManager->remove($player);
        $entityManager->flush();

        return $this->redirectToRoute('show_players',array(
            'id_team' => $id_team,
        ));
    }
}
