<?php

namespace App\Controller;

use App\Entity\VinylMix;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\String\u;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class VinylController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    function homepage(): Response
    {
        $tracks = [
            ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['song' => 'Waterfalls', 'artist' => 'TLC'],
            ['song' => 'Creep', 'artist' => 'Radiohead'],
            ['song' => 'Kiss from a Rose', 'artist' => 'Seal'],
            ['song' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
            ['song' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];
        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'ISET Kélibia',
            'tracks' => $tracks,
        ]);
    }
    #[Route('/browse/{slug}', name: 'app_browse')]
    function browse(EntityManagerInterface $entityManager, string $slug = null): Response
    {
        $genre = $slug ? u(str_replace("-", " ", $slug))->title(true) : null;
        $mixRepository = $entityManager->getRepository(VinylMix::class);
        $mixes = $mixRepository->findAllOrderedByVotes($slug);
        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
}
