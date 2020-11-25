<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SendEmailController extends AbstractController
{
    /**
     * @Route("/send/email", name="send_email")
     */
    public function index($name, $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
        ->setFrom('contact@adrennes-boutique.fr')
        ->setTo('poucet@simplon-charleville.fr')
        ->setBody(
            // $this->renderView(
            //     // templates/emails/registration.html.twig
            //     'emails/registration.html.twig',
            //     ['name' => $name]
            // ),
            // 'text/html'
            'rfgierjgi'
        )

        // // you can remove the following code if you don't define a text version for your emails
        // ->addPart(
        //     $this->renderView(
        //         // templates/emails/registration.txt.twig
        //         'emails/registration.txt.twig',
        //         ['name' => $name]
        //     ),
        //     'text/plain'
        // )
    ;

    $mailer->send($message);

        return $this->render('send_email/index.html.twig', [
            'controller_name' => 'SendEmailController',
        ]);
    }
}
