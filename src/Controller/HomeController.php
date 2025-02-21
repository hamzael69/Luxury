<?php

namespace App\Controller;

use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{

    private JobOfferRepository $jobOfferRepository;

    public function __construct(JobOfferRepository $jobOfferRepository)
    {
        $this->jobOfferRepository = $jobOfferRepository;
    }


    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $jobOffers = $this->jobOfferRepository->findAll();
        return $this->render('home/index.html.twig', [
            'jobOffers' => $jobOffers,
          
        ]);
    }
}
