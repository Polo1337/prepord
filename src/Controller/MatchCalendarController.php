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
use App\Repository\MatchTypeRepository;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchCalendarController extends AbstractController
{
    /**
     * @Route("/match/calendar/{id_team}{id_match}", name="match_calendar", defaults={"id_match"=-1})
     */
    public function index(Request $request, MatchRepository $match,TeamRepository $team,$id_team, UserRepository $user, $id_match, ClubRepository $clubRepo, FlashyNotifier $flashy)
    {
        $matches=$team->find($id_team)->getPlayMatches();

        $match_id=$team->find($id_team);

        $resultat = [];
        $stat = [];

        $userConnect = $this->getUser();
        $userClub=$user->find($userConnect)->getFinances()->getId();
        $club=$clubRepo->find($userClub)->getName();
        $count=$matches->count($club);
        
        if($count > 0) {

            $y=-1;
            for($i=$count;$i>$count-5;$i--){
                $y++;
                $local=$team;
                if($club==$local){
                    if(($team->find($id_team)->getPlayMatches()[$y]->getStats()!=NULL) && (isset($score[0]['score']))){
                        $score=$team->find($id_team)->getPlayMatches()[$y]->getStats();
                        $score=$score[0]['score'];
                        $score1=$score{0};
                        $score2=$score{2};

                        if($score1>$score2){
                            $resultat[$i]=1;

                            }else if($score1<$score2){
                                $resultat[$i]=2;

                                }else{
                                $resultat[$i]=0;
                        }
                    }
                }
            }

            $z=2;
            $i=0;

            if(null==$team->find($id_team)->getPlayMatches()){

                while($z!=0){
                    
                    if(isset($team->find($id_team)->getPlayers()[$i])){
                        $current_match_id = $team->find($id_team)->getPlayMatches()[$y]->getId();
                        $joueur[$i] = $team->find($id_team)->getPlayers()[$i];
                        $stat[$i][0]=$joueur[$i]->getLestName();
                        $stat[$i][1]=$joueur[$i]->getFirstName();
                        $i++;
                        if($i==5){
                        $z=0;
                    }
                            }else{
                                $z=0;
                }  
            }
            arsort($stat);
        }
    }

        // form add match

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
            $this->addFlash('success', 'Ajouté avec succes !');
            $task=$form->get('domicile');
            $data=$task->getViewData();
                $task = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($match);
                $entityManager->flush();

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
            $team->find($id_team)->addPlayMatch($match);
            
            $entityManager->persist($match);
            $entityManager->flush();

            return $this->redirectToRoute('match_calendar',['id_team'=>$id_team]);
        }
        
        return $this->render('match_calendar/index.html.twig', [
            'match'=>$matches,
            'resultat'=>$resultat,
            'meilleur_buteur'=>$stat,
            'idteam' => $id_team,
            'form' => $form->createView(),
        ]);
    }
}