<?php

namespace App\Controller;

use App\Form\PlayerMatchStatsType;
use App\Repository\TeamRepository;
use App\Repository\PlayerRepository;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatJoueurController extends AbstractController
{
    /**
     * @Route("/update/player/stats/{id_match}/{id_player}", name="update_player_stats", defaults={"id_match"=-1, "id_player"=-1})
     */

    public function update(Request $request, TeamRepository $teamrepo, PlayerRepository $playerrepo, $id_match, $id_player, FlashyNotifier $flashy)
    {

        return new Response();
    }

    /**
     * @Route("/stat/joueur/{id_match}/{id_player}", name="stat_joueur", defaults={"id_match"=-1, "id_player"=-1})
     */

    public function index(Request $request, TeamRepository $teamrepo, PlayerRepository $playerrepo, $id_match, $id_player, FlashyNotifier $flashy)
    {


        $player = $playerrepo->find($id_player);
        $player->setCurrentMatch($id_match);
        $form = $this->createForm(PlayerMatchStatsType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($player);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('match_composition', ['id_match' => $id_match  ]));
        }

        return $this->render('stat_joueur/stat_joueur.html.twig', [
            'controller_name' => 'StatJoueurController',
            'form' => $form->createView(),
            'id_match' => $id_match,
            'id_player' => $id_player,
        ]);
    }
}
