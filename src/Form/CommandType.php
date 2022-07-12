<?php

namespace App\Form;

use App\Entity\Command;
use App\Entity\Services;
use App\Entity\SousServices;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CommandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('idClient')
            ->add('idSousService',EntityType::class, [
                // looks for choices from this entity
                'class' => SousServices::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'Name',
            
                // used to render a select box, check boxes or radios
            
            ])
            ->add('DateCammand')
            ->add('Description')
            // ->add('statut')
            ->add('DateLivraison')
            ->add('Email')
            ->add('Tel')
            ->add('Adresse')
            ->add('ville', ChoiceType::class, [
                'choices'  => [
                    'Marrakech' => 'Marrakech',
                    'Casablanca' => 'Casablanca',
                    'Mohammedia' => 'Mohammedia',
                    'Rabat' => 'Rabat',
                    'salé' => 'salé',
                    'Fes' => 'Fes',
                    'Meknes' => 'Meknes',
                    'Oujda'=> 'Oujda',
                ],
                ])
            ->add('statut', ChoiceType::class, [
                    'choices'  => [
                        'No payée' => 'No payée',
                        'payée' => 'payée',
                    ],
                    ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Command::class,
        ]);
    }
}
