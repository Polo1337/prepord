<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;

class ShowTeamController extends AbstractController
{
    /**
     * @Route("/show/team", name="show_team")
     */
    public function index(TeamRepository $team, UserRepository $user)
    {   

        $userConnect = $this->getUser();
        
        $team = $user->find($userConnect)->getCoaches();
        
        return $this->render('show_team/index.html.twig', [
            'team'=>$team
        ]);
    }
}
