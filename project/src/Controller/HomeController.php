<?php

namespace App\Controller;

use App\Service\RssService;
use App\Repository\EventRepository;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route("/", name: "app_home")]
    public function index(RssService $rss, NewsRepository $newsRepository, EventRepository $eventRepository): Response
    {
        $actualites = $rss->fetch('https://www.agglo-compiegne.fr/rss/actualites');
        $news = $newsRepository->findBy(['actif' => true]);

        $events = $eventRepository->findBy(['actif' => true], ['date_debut' => 'ASC']);

        $emploiDuTemps = [];

        foreach ($events as $event) {
            $promo = $event->getPromo()->getNom();
            $jour = $event->getDateDebut()->format('Y-m-d');
            $emploiDuTemps[$promo][$jour][] = $event;
        }

        return $this->render('home/index.html.twig', [
            "actualites" => $actualites,
            'emploiDuTemps' => $emploiDuTemps,
            'news'          => $news,
        ]);
    }
}
