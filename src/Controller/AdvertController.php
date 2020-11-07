<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Repository\AdvertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvertController extends AbstractController
{
    /**
     * @Route("/adverts", name="adverts_index", methods={"GET"})
     * @param AdvertRepository $advertRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AdvertRepository $advertRepository) : Response
    {
        return $this->render('adverts/index.html.twig', [
            'adverts' => $advertRepository->findAll(),
        ]);
    }

    /**
     * @Route("/adverts/{id}", name="advert_show", methods={"GET"}, priority=0)
     * @param Advert $advert
     * @return Response
     */
    public function show(Advert $advert) : Response
    {
        return $this->render('adverts/voir.html.twig', [
            'advert' => $advert
        ]);
    }

    /**
     * @Route("/adverts/{id}/delete", name="advert_delete", methods={"DELETE"})
     * @param Request $request
     * @param Advert $advert
     * @return Response
     */
    public function delete(Request $request, Advert $advert) : Response {

        $token = $request->request->get('token');

        if ($this->isCsrfTokenValid('delete_advert', $token)) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($advert);
            $manager->flush();
        }

        return $this->redirectToRoute("adverts_index");
    }

    /**
     * @Route("/adverts/add", name="adverts_add", methods={"GET"}, priority=1)
     */
    public function create() : Response {

        return $this->render('adverts/form.html.twig');
    }

    /**
     * @Route("/adverts", name="adverts_new", methods={"POST"})
     */
    public function new(Request $request) : Response {

        if ($this->isCsrfTokenValid("form_advert", $request->request->get('token'))) {

            $advert = new Advert();
            $advert->setTitle($request->request->get('title'));
            $advert->setDescription($request->request->get('description'));
            $advert->setType($request->request->get('type'));
            $advert->setLocation($request->request->get('rent_price'));
            $advert->setVente($request->request->get('sell_price'));

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($advert);
            $manager->flush();

            return $this->redirectToRoute("advert_show", [ "id" => $advert->getId() ]);
        }

        return $this->redirectToRoute("adverts_index");

    }




}
