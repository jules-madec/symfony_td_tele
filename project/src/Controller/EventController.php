<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventformType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[IsGranted("IS_AUTHENTICATED_FULLY")]
class EventController extends AbstractController
{
    #[Route("/event", name: "app_event")]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $event = new Event();

        $form = $this->createForm(EventformType::class, $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render("Event/event.html.twig", [
            "form" => $form->createView(),
            "event" => $event,
        ]);
    }
}
