<?php

namespace App\Controller;

use App\Repository\MatchRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DelMatchController extends AbstractController
{
    /**
     * @Route("/del/match/{id_match}/{id_team}", name="del_match")
     */
    public function index(MatchRepository $matchRep,$id_match, $id_team, Request $request, CsrfTokenManagerInterface $csrfTokenManager)
    {

        $token = new CsrfToken('delete', $request->query->get('_csrf_token'));

        if (!$csrfTokenManager->isTokenValid($token)) {
            throw $this->createAccessDeniedException('Token CSRF invalide');
            return $this->redirectToRoute('app_login');
        }
            // if ($this->isCsrfTokenValid('delete' . $id_team.$id_match->))

        $entityManager = $this->getDoctrine()->getManager();
        $match=$matchRep->find($id_match);
        $entityManager->remove($match);
        $entityManager->flush();

        
        return $this->redirectToRoute('match_calendar',array(
            'id_team' => $id_team,
        ));
    }
}
