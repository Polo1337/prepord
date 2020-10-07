<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CoachFormType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoachFormController extends AbstractController
{
    /**
     * @Route("/coach/form", name="coach_form")
     */
    public function index()
    {
        $user = new User();

        $form = $this->createForm(CoachFormType::class, $user);

        return $this->render('coach_form/index.html.twig', [
            'controller_name' => 'CoachFormController',
            'form' => $form->createView(),
        ]);
    }
}
