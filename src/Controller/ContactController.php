<?php

namespace App\Controller;


use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact_index", methods={"GET"})
     * @param ContactRepository $contactRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ContactRepository $contactRepository) : Response
    {
        return $this->render('contact/index.html.twig', [
            'contact' => $contactRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="contact_new", methods={"POST"})
     */
    public function new(Request $request) : Response {

        if ($this->isCsrfTokenValid("form_contact", $request->request->get('token'))) {

            $contact = new Contact();
            $contact->setFirstname($request->request->get('first_name'));
            $contact->setLastname($request->request->get('last_name'));
            $contact->setEmail($request->request->get('email'));
            $contact->setMessage($request->request->get('message'));

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($contact);
            $manager->flush();

            return $this->redirectToRoute("accueil");
        }

        return $this->redirectToRoute("accueil");

    }
}
