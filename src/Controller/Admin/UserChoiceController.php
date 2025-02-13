<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserChoiceController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


  public function configureFields(string $pageName): iterable
   {
      return [
        TextField::new('email'),
        TextField::new('password'),
        // ArrayField::new('roles'),

        ChoiceField::new('roles', 'Rôles')
                ->setChoices([
                    'Administrateur' => 'ROLE_ADMIN',
                    'Candidat' => 'ROLE_CANDIDATE',
                    'Professionnel' => 'ROLE_PROFESSIONAL',

                ])

                ->allowMultipleChoices(),

        ];
     }
   
}
