<?php

namespace App\Controller;

use DateTime;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\Match;
use App\Form\AddMatchFormType;
use App\Repository\ClubRepository;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use App\Repository\MatchRepository;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AddMatchController extends AbstractController
{
    /**
     * @Route("/add/match/{id_team}{id_match}", name="add_match", defaults={"id_match"=-1})
     */
    public function index(Request $request,MatchRepository $matchRep, UserRepository $user, TeamRepository $teams,$id_match, $id_team, FlashyNotifier $flashy)
    {   

        if($id_match==-1){
            $match= new Match();
        }else{
            $match=$matchRep->find($id_match);
        }
        $id = $this->getUser()->getId();

        $connectedUser = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->find($id);
        $userTeams = $connectedUser->getCoaches();

        $form = $this->createForm(AddMatchFormType::class, $match,[
            'teams' => $userTeams,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $task=$form->get('domicile');

            $data=$task->getViewData();

                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $task = $form->getData();
                // ... perform some action, such as saving the task to the database
                // for example, if Task is a Doctrine entity, save it!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($match);
                $entityManager->flush();
        
             // return $this->redirectToRoute('task_success');
            
            if($data==1){
                $localTeam= $user->find($connectedUser)->getFinances()->getName();
                $visitorTeam=$form->get("local_team")->getViewData();
            }else{
                $localTeam=$form->get("local_team")->getViewData();
                $visitorTeam=$user->find($connectedUser)->getFinances()->getName();
            }
            
            $match->setLocalTeam($localTeam);
            $match->setVisitorTeam($visitorTeam);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();
            
            $match->addTeam( $this->getDoctrine()->getRepository(Team::class)->find($id_team) );

            $teams->find($id_team)->addPlayMatch($match);
            
            $entityManager->persist($match);
            $entityManager->flush();
            
            // return $this->redirectToRoute('match_calendar',['id_team'=>$user->find($connectedUser)->getFinances()->getId()]);
        
        }

        return $this->render('add_match/index.html.twig', [
            'controller_name' => 'AddMatchController',
            'form' => $form->createView(),
            'idteam' => $id_team,
        ]);
    }
}
