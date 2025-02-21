<?php

namespace App\Controller;

use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JobController extends AbstractController
{

    private JobOfferRepository $jobOfferRepository;

    public function __construct(JobOfferRepository $jobOfferRepository)
    {
        $this->jobOfferRepository = $jobOfferRepository;
    }
    
    #[Route('/job', name: 'app_job')]
    public function index(): Response
    {
        $jobOffers = $this->jobOfferRepository->findAll();
        return $this->render('job/index.html.twig', [
            'jobOffers' => $jobOffers,
         
        ]);
    }

 





    #[Route('/job/{title}', name: 'app_job_show')]
    public function show(string $title): Response
    {
        $jobOffer = $this->jobOfferRepository->findOneBy(['title' => $title]);
        return $this->render('job/show.html.twig', [
            'jobOffer' => $jobOffer,
         
        ]);
    }
}
