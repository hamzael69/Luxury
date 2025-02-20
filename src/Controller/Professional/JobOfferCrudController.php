<?php

namespace App\Controller\Professional;

use App\Entity\JobCategory;
use App\Entity\JobOffer;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bundle\SecurityBundle\Security;

class JobOfferCrudController extends AbstractCrudController
{

    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }







    public static function getEntityFqcn(): string
    {
        return JobOffer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Nom de l\'offre'),
            TextField::new('compagnyName', 'Nom de la société'),
            EmailField::new('contactEmail', 'Email de contact'),
            DateTimeField::new('createdAt', 'Date de création')->hideOnForm(),
            AssociationField::new('jobCategory', "Catégorie"),
            AssociationField::new('professional', 'Recruteur')
                ->setDisabled()
                ->setRequired(true)
                ->onlyOnDetail(),
        ];
    }


    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    if (!$entityInstance instanceof JobOffer) {
        return;
    }

    // Associer l'offre au recruteur connecté

    /** @var User */
    $user = $this->security->getUser();

    $professional = $user->getProfessional();

    $entityInstance->setProfessional($professional);
    $entityInstance->setCreatedAt(new \DateTimeImmutable());

    parent::persistEntity($entityManager, $entityInstance);
}



}
