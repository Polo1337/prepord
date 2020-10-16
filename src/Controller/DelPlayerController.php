<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class DelPlayerController extends AbstractController
{
    /**
     * @Route("/del/player/{id_player}/{id_team}", name="del_player")
     */
    public function index(PlayerRepository $playerRepo, $id_player,$id_team, Request $request, CsrfTokenManagerInterface $csrfTokenManager)
    {

        $token = new CsrfToken('delete', $request->query->get('_csrf_token'));

        if (!$csrfTokenManager->isTokenValid($token)) {
            // throw $this->createAccessDeniedException('Token CSRF invalide');
            return $this->redirectToRoute('team_screen');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $player = $playerRepo->find($id_player);
        if($player->getPlayIn()->getUsers()->contains($this->getUser()))
        {
            $entityManager->remove($player);
            $entityManager->flush();
        }

        return $this->redirectToRoute('show_players',array(
            'id_team' => $id_team,
        ));
    }
}
