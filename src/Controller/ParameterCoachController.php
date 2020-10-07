<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\User;
use App\Form\CoachFormType;
use App\Form\AddMatchFormType;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ParameterCoachController extends AbstractController
{
    /**
     * @Route("/parameter/coach/{id_team}", name="parameter_coach")
     */

    //  recuperer email, verifie que c est un un doublon
    // verifie l existence du user
    // chercher l id du detenteur du compte 
    // regarder l id du connecter et l ajouter 
    // ajouter l id_team du connecter avec l id du mail ci dessus 

    public function index(TeamRepository $teamReP, UserRepository $userRep, TeamRepository $teams, Request $request, SluggerInterface $slugger, $id_team, FlashyNotifier $flashy)
    {   
        $form = $this->createForm(CoachFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $email=$form->get('email')->getViewData();
            $count = count($userRep->findBy(['email'=>$email]));

            if($count != 0){
                $coach=$userRep->findBy(['email'=>$email]);
                $team=$teamReP->find($id_team);
                $coach[0]->addCoach($team);
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($coach[0]);
                $entityManager->flush();
                $flashy->success('Coach ajouté');

                } else {
                    $flashy->error('e-mail non existant');
            }
        }
        
        return $this->render('parameter_coach/index.html.twig', [
            'controller_name' => 'ParameterCoachController',
            'form' => $form->createView(),
            'idteam' => $id_team,
        ]);
    }
}
