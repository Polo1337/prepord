<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\PlayerFormType;
use App\Repository\PlayerRepository;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class PlayerFormController extends AbstractController
{
    /**
     * @Route("/player/form/{id}", name="player_form", defaults={"id"=-1})
     */
    public function index(PlayerRepository $PlayerRepo, Request $request, $id, SluggerInterface $slugger, FlashyNotifier $flashy)
    {

        if($id == -1)
        {
            $player = new Player();
        } else {
            $player = $PlayerRepo->find($id);
        }

        $form = $this->createForm(PlayerFormType::class, $player);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form['picture']->getData();

            if ($task) {
                $originalFilename = pathinfo($task->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = "player".$id;
                $newFilename = $safeFilename.'-'.uniqid().'.'.$task->guessExtension();

                try {
                    $task->move(
                        $this->getParameter('pictures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

            }

            $player->setPicture($newFilename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($player);
            $entityManager->flush();

            }

            return $this->redirect($this->generateUrl('player_form'));
        }
            
        return $this->render('player_form/index.html.twig', [
            'controller_name' => 'PlayerFormController',
            'form' => $form->createView(),
        ]);
    }




    
}
