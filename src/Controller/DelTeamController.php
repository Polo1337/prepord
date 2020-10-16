<?php

namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfToken;

class DelTeamController extends AbstractController
{
    /**
     * @Route("/del/team/{id_team}", name="del_team")
     */
    public function index(TeamRepository $teamRepo, $id_team, Request $request, CsrfTokenManagerInterface $csrfTokenManager)
    {

        $token = new CsrfToken('delete', $request->query->get('_csrf_token'));

        if (!$csrfTokenManager->isTokenValid($token)) {
            // throw $this->createAccessDeniedException('Token CSRF invalide');
            return $this->redirectToRoute('team_screen');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $team = $teamRepo->find($id_team);

        if($team->getUsers()->contains($this->getUser()))
        {
            $entityManager->remove($team);
            $entityManager->flush();
        }
        return $this->redirectToRoute('team_screen');
    }
}
