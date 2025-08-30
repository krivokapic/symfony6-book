<?php

namespace App\Controller;

use App\Entity\Conference;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

final class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Enviroment $twig, ConferenceRepository $conferenceRepository): Response
    {
        dump($conferenceRepository->findAll());
        return new Response($twig->render('conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]));
    }

    #[Route('/conference/{id}', name: 'conference')]
    public function show(Environment $twig, Conference $conference, CommentRepository $commentRepository): Response
    {
        return new Response($twig->render('conference/show.html.twig', [
            'conference' => $conference,
            'comments' => $commentRepository->findBy(['conference' => $conference], ['createdAt' => 'DESC'])
        ]));
    }
}
