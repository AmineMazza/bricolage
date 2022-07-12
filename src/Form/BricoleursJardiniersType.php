<?php

namespace App\Form;

use App\Entity\BricoleursJardiniers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BricoleursJardiniersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('Last_name')
            ->add('Phone')
            ->add('Job')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BricoleursJardiniers::class,
        ]);
    }
}
