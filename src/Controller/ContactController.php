<?php
// src/Controller/ContactController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $subject = $request->request->get('subject');
            $message = $request->request->get('message');

            $emailMessage = (new Email())
                ->from($email)
                ->to('bouzidioussema16@gmail.com')
                ->subject($subject)
                ->text($message);

            $mailer->send($emailMessage);

            $this->addFlash('success', 'Message sent successfully!');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig');
    }
}
