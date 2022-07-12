<?php

namespace App\Form;

use App\Entity\BricoleursDemenageurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BricoleursDemenageursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('Last_name')
            ->add('phone')
            ->add('Job')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BricoleursDemenageurs::class,
        ]);
    }
}
