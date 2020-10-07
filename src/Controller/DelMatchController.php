<?php

namespace App\Controller;

use App\Repository\MatchRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DelMatchController extends AbstractController
{
    /**
     * @Route("/del/match/{id_match}/{id_team}", name="del_match")
     */
    public function index(MatchRepository $matchRep,$id_match, $id_team)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $match=$matchRep->find($id_match);
        $entityManager->remove($match);
        $entityManager->flush();

        
        return $this->redirectToRoute('match_calendar',array(
            'id_team' => $id_team,
        ));
    }
}
