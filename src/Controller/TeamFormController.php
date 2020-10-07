<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\FormAddTeamType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class TeamFormController extends AbstractController
{
    /**
     * @Route("/team/form", name="team_form")
     */
    public function index(Request $request,$id)
    {
        // instancier la class team
        // instance of the class team
        $team = new Team();
        // Création du formulaire à partir de fomraddtype
        // Create the form from formaddtype
        $form = $this->createForm(FormAddTeamType::class, $team);
        $form->handleRequest($request);
        // condition pour executer la création si il est valide
        // condition for execute the creation if he is valid
        if ($form->isSubmitted() && $form->isValid()) {
            // récupèration de la photo si il y en a une
            // take the picture if one is put
            $task = $form['picture']->getData();

            if ($task) {
                // enregistre dans la table team
                // save in the table team
                $safeFilename = "team";
                // crée l'id de l'image
                // create the id of the picture
                $newFilename = $safeFilename.'-'.uniqid().'.'.$task->guessExtension();
                    // met les photos dans le dossier indiqué
                    // put the picture in the right folder
                $task->move(
                    $this->getParameter('pictures_directory'),
                    $newFilename
                );
                // définie le nom de l'image dans l'instance team par l'attribut picture
                // set the picture of the instance team by the picture attribute
                $team->setPicture($newFilename);
                // si aucune photo alors une photo est définie
                // default picture
            } else {
                $team->setPicture("default_avatar.png");
            }
            // récupère les outils pour l'envoie en bdd
            // retrieve the tool allowing to send to the  database
            $entityManager = $this->getDoctrine()->getManager();
            // prépare l'envoie
            // prepare to persist
            $entityManager->persist($team);
            // autorise la donnée a etre envoyer en bdd
            // allow to send in database
            $entityManager->flush();
        }
        // génére la vue en passant un tableau de variables en paramètre
        // the template path is the relative file path from templates
        return $this->render('team_form/index.html.twig', [
            'controller_name' => 'TeamFormController',
            'form' => $form->createView()
        ]);
    }
}