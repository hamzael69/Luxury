<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Repository\CandidateRepository;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CandidatureController extends AbstractController
{
    #[Route('/candidature', name: 'app_candidature')]
    public function index(Request $request,
    EntityManagerInterface $entityManager,
    CandidateRepository $candidateRepository,
    JobOfferRepository $jobOfferRepository): Response
    {

            /** 
         * @var User $user
         */
        $user = $this->getUser();


        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $candidature = new Candidature();
        $candidate = $candidateRepository->findOneBy(['user' => $user->getId()]);
        $jobOffer = $jobOfferRepository->findOneBy(['id' => $request->query->get('id')]);

        

        $candidature->setJobOffer($jobOffer);
        $candidature->setCandidate($candidate);


        $existingCandidature = $entityManager->getRepository(Candidature::class)->findOneBy([
            'candidate' => $candidate,
            'jobOffer' => $jobOffer,
        ]);


        if ($existingCandidature) {
            $this->addFlash('error', 'Vous avez déjà postulé à cette offre.');
            return $this->redirectToRoute('app_job');
        }

        
        // $form = $this->createForm(CandidatureType::class, $candidature);
        // $form->handleRequest($request);


        $entityManager->persist($candidature);
        $entityManager->flush();

        $this->addFlash('success', 'Votre candidature a bien été envoyée.');



        return $this->redirectToRoute('app_job');


       
    }
}
