<?php

namespace App\Form;

use App\Entity\Candidate;
use App\Entity\Gender;
use App\Entity\User;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'last_name',
                ],
                'label' => 'Lastname',
            ])


            ->add('firstname', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'first_name',
                ],
                'label' => 'First name',
            ])

            ->add('currentLocation', TextType::class, [
                'required' => false,
                'attr' => [
                    'id' => 'current_location',
                ],
                'label' => 'Current location',
            ])

            ->add('address', TextType::class, [
                'required' => false,
                'attr' => [
                    'id' => 'address',
                ],
                'label' => 'Address',
            ])

            ->add('country', TextType::class, [
                'required' => false,
                'attr' => [
                    'id' => 'country',
                ],
                'label' => 'Country',
            ])

            ->add('nationality', TextType::class, [
                'required' => false,
                'attr' => [
                    'id' => 'nationality',
                ],
                'label' => 'Nationality',
            ])

            ->add('birthplace', TextType::class, [
                'required' => false,
                'attr' => [
                    'id' => 'birth_place',
                ],
                'label' => 'Birthplace',
            ])

            ->add('description', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'materialize-textarea',
                    'id' => 'description',
                    'cols' => '50',
                    'rows' => '10',
                ],
                'label' => 'Description',
            ])


            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'Choose an option...',
                'label' => 'Gender',
                'attr' => [
                    'id' => 'gender',
                ],
                'label_attr' => [
                    'class' => 'active',
                ],
            ])


            
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
