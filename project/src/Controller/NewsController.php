<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsformType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[IsGranted("IS_AUTHENTICATED_FULLY")]
class NewsController extends AbstractController
{
    #[Route("/news", name: "app_news")]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $news = new News();

        $form = $this->createForm(NewsformType::class, $news);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('app_admin');
        }

        return $this->render("News/news.html.twig", [
            "form" => $form->createView(),
            "news" => $news,
        ]);
    }
}
