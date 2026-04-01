<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Event;
use App\Repository\EventRepository;
use App\Repository\NewsRepository;
use App\Service\RssService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[IsGranted("IS_AUTHENTICATED_FULLY")]
class AdminController extends AbstractController
{
    #[Route("/admin", name: "app_admin")]
    public function index(EventRepository $eventRepository, NewsRepository $newsRepository): Response
    {
        $events = $eventRepository->findBy([], ['date_debut' => 'ASC']);

        $emploiDuTemps = [];
        foreach ($events as $event) {
            $promo = $event->getPromo()->getNom();
            $jour = $event->getDateDebut()->format('Y-m-d');
            $emploiDuTemps[$promo][$jour][] = $event;
        }

        $news = $newsRepository->findBy([], ['date_debut' => 'DESC']);

        return $this->render("adminpannels/admin.html.twig", [
            "emploiDuTemps" => $emploiDuTemps,
            "news" => $news,
        ]);
    }

    #[Route("/admin/publier-event/{id}", name: "app_publier_event", methods: ["POST"])]
    public function publierEvent(int $id, EntityManagerInterface $em): Response
    {
        $event = $em->find(Event::class, $id);
        $event->setActif(true);
        $em->flush();

        return $this->redirectToRoute('app_admin');
    }

    #[Route("/admin/depublier-event/{id}", name: "app_depublier_event", methods: ["POST"])]
    public function depublierEvent(int $id, EntityManagerInterface $em): Response
    {
        $event = $em->find(Event::class, $id);
        $event->setActif(false);
        $em->flush();

        return $this->redirectToRoute('app_admin');
    }

    #[Route("/admin/publier-news/{id}", name: "app_publier_news", methods: ["POST"])]
    public function publierNews(int $id, EntityManagerInterface $em): Response
    {
        $news = $em->find(News::class, $id);
        $news->setActif(true);
        $em->flush();

        return $this->redirectToRoute('app_admin');
    }

    #[Route("/admin/depublier-news/{id}", name: "app_depublier_news", methods: ["POST"])]
    public function depublierNews(int $id, EntityManagerInterface $em): Response
    {
        $news = $em->find(News::class, $id);
        $news->setActif(false);
        $em->flush();

        return $this->redirectToRoute('app_admin');
    }
}
