<?php

namespace App\Controller;

use App\Entity\Match;
use App\Form\MatchStatsType;
use App\Form\AddMatchFormType;
use App\Entity\PlayerMatchStats;
use App\Repository\TeamRepository;
use App\Repository\MatchRepository;
use App\Repository\MatchTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class StatMatchController extends AbstractController
{
    /**
     * @Route("/stat/match/{id}", name="stat_match")
     */
    public function index(MatchRepository $matchRep, MatchTypeRepository $Type,TeamRepository $teamMatch, Request $request, SluggerInterface $slugger, $id)
    {   

        $match = $matchRep->find($id);
        $local = $match->getLocalTeam();
        $visitor = $match->getVisitorTeam();
        $type = $match->getMatchType();
        $type_name = $type->getName();
        $teams = $match->getTeams();
        $recScore = $match->getRecScore();
        $visitorScore = $match->getVisiteurScore();
        $yellows = $match->getYellows();
        $essais = $match->getEssais();
        $transformations = $match->getTransformations();
        $penalites = $match->getPenalites();
        $drops = $match->getDrops();
        $team = $teams[0];
        $team_id = $team->getId();
        $joueurs = $team->getPlayers();

        foreach($joueurs as $j)
        {
            $j->setCurrentMatch($id);
        }

        $mergedForms = [
            'match'     =>      $match,
            'players'   =>      $joueurs,
        ];

        $form = $this->createForm(MatchStatsType::class, $match);
        $form->submit($request->request->get('match_stats'), false);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Ajouté avec succes !');
            
            $task = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();

            return $this->redirectToRoute('match_calendar',array(
                'id_team' => $team_id,
            ));
        }
        

        return $this->render('stat_match/index.html.twig', [
            'form' => $form->createView(),
            'idteam' => $team->getId(),
        ]);
    }
}
