<?php

namespace App\Controller\Professional;

use App\Entity\Candidature;
use App\Entity\JobOffer;
use App\Entity\Professional;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[AdminDashboard(routePath: '/pro', routeName: 'pro')]
class ProDashboardController extends AbstractDashboardController
{
    #[Route('/pro', name: 'pro')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('professional/professional.html.twig') ;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Luxury');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Mon Dashboard Pro', 'fa fa-briefcase', Professional::class)
    ->setController(ProfessionalCrudController::class)
    ->setPermission('ROLE_PROFESSIONAL');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);



        yield MenuItem::subMenu('Offres d\'emploi', 'fas fa-briefcase')
    ->setPermission('ROLE_PROFESSIONAL')
    ->setSubItems([
        MenuItem::linkToCrud('Créer une offre', 'fas fa-plus', JobOffer::class)->setAction('new'),
        MenuItem::linkToCrud('Mes offres', 'fas fa-list', JobOffer::class),
        MenuItem::linkToCrud('Mes candidatures', 'fas fa-list', Candidature::class),
    ]);
    }
}
