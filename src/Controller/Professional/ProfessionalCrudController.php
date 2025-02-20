<?php

namespace App\Controller\Professional;

use App\Entity\Professional;
use App\Repository\ProfessionalRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;

class ProfessionalCrudController extends AbstractCrudController
{

    private Security $security;
    private EntityRepository $entityRepository;
    private ProfessionalRepository $professionalRepository;

    public function __construct(Security $security, EntityRepository $entityRepository, ProfessionalRepository $professionalRepository) {
        $this->security = $security;
        $this->entityRepository = $entityRepository;
        $this->professionalRepository = $professionalRepository;
    }



    public static function getEntityFqcn(): string
    {
        return Professional::class;
    }


    
    public function createEntity(string $entityFqcn)
    {
        $professional = new Professional();
        $professional->setUser($this->getUser());
        return $professional;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityPermission('ROLE_PROFESSIONAL')  ;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $response = $this->entityRepository->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $response->andWhere('entity.user = :user')->setParameter('user', $this->getUser());

        return $response;
    }


    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('companyName','Nom de la société'),
            TextField::new('contactEmail', 'Email de contact'),
        ];
    }


    public function configureActions(Actions $actions): Actions
    {
        $user = $this->security->getUser();
        $existingProfessional = $this->professionalRepository->findOneBy(['user' => $user]);

        if ($existingProfessional) {
            return $actions
                ->disable(Action::NEW);
        }

        return $actions;
    }

    
}
