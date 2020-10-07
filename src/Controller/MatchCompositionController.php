<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Entity\Match;
use App\Form\ChatType;
use App\Repository\MatchRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchCompositionController extends AbstractController
{

    private $composition;

    /**
     * @Route("/match/composition/{id_match}/{id_composition}", name="match_composition", defaults={"id_composition"=0})
     */
    public function index(MatchRepository $matchRep, Request $request, $id_match, $id_composition)
    {
        $date=$matchRep->find($id_match)->getDate()->format('Y-m-d H:i:s');
        $today=date('Y-m-d H:i:s');
        ;
        // if($today>$date){
        //     $return = $this->redirectToRoute('stat_match',["id"=>$id_match]);
        // }else{
            $match=$matchRep->find($id_match);
            $compo = $match->getComposition();
            $team = $match->getTeams()[0];
            $id_team = $team->getId();
            $players = $team->getPlayers();

            foreach($players as $p) {
                $p->setCurrentMatch($id_match);
        // }

        $chat = new Chat();
                $formchat = $this->createForm(ChatType::class, $chat);
                $formchat->handleRequest($request);

                if ($formchat->isSubmitted() && $formchat->isValid()) {
                    $chat->setAuteur($this->getUser()->getUsername());
                    $chat->setMatch($match);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($chat);
                    $entityManager->flush();
                }

        $return = $this->render('match_composition/index.html.twig', [
            'controller_name' => 'MatchCompositionController',
            'id_match' => $id_match,
            'players' => $players,
            'composition' => json_encode($compo),
            'idteam' => $id_team,
            'idcomposition' => $id_composition,
            'chat' => $formchat->createView(),
            'match' => $match,
        ]);
    }
    return $return;
}
}
