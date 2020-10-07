<?php

namespace App\Controller;

use App\Entity\Match;
use App\Repository\MatchRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompositionUpdateController extends AbstractController
{
    private $composition;

    /**
     * @Route("/match/composition/update/{id_match}", name="match_composition_update")
     */
    public function update(Request $request, MatchRepository $matchRep, $id_match) {

            $entityManager = $this->getDoctrine()->getManager();
            
            $match=$matchRep->find($id_match);
            $compo = $request->request->get('composition');

            $match->setComposition($compo);
            
            $entityManager->persist($match);
            $entityManager->flush();

            return new Response('success');
        

    }
}
