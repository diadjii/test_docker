<?php

namespace App\Controller;

use App\Entity\Pin;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/pins", name="pins")
     */
    public function index(): Response
    {
        return $this->render('pins/index.html.twig');
    }

    /**
     * @Route("/pins/create")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            
            $pin = new Pin;

            $pin
                ->setTitle($data['title'])
                ->setDescription($data['description']);

            $em->persist($pin);
            $em->flush();
        }

        return $this->render('pins/create.html.twig');
    }
}
