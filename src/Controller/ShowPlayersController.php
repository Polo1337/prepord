<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerFormType;
use App\Repository\PlayerRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TeamRepository;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ShowPlayersController extends AbstractController
{
    /**
     * @Route("/show/players/{id_team}/{id_player}", name="show_players", defaults={"id_player"=-1})
     */
    public function index(Request $request, TeamRepository $teamrepo, PlayerRepository $playerrepo, $id_team, $id_player, FlashyNotifier $flashy)
    {
        $open_modal = false;

        if($id_player == -1)
        {
            $player = new Player();
        } else if($id_player == -2) {
            $player = new Player();
            $open_modal = true;
        } else {
            $player = $playerrepo->find($id_player);
            $open_modal = true;
        }

        $thisTeam = $teamrepo->findById($id_team)[0];
        $thisPlayers = $thisTeam->getPlayers();

        $form = $this->createForm(PlayerFormType::class, $player);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form['picture']->getData();
            
            if ($task) {
                $originalFilename = pathinfo($task->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = "player";
                $newFilename = $safeFilename.'-'.uniqid().'.'.$task->guessExtension();

                try {
                    $task->move(
                        $this->getParameter('pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                $player->setPicture($newFilename);

            } else {
                $player->setPicture("default_avatar.png");
            }
            $player->setStats([]);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($player);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('show_players', [
                'id_team' => $id_team,
            ]));
        }
        
        return $this->render('show_players/index.html.twig', [
            'controller_name' => 'ShowPlayersController',
            "players" => $thisPlayers,
            "team" => $thisTeam,
            "idteam" => $id_team,
            "openmodal" => $open_modal,
            'form' => $form->createView()
        ]);
    }
}
