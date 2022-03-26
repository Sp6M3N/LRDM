<?php

namespace App\Form;

use App\Entity\EventReservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('createdAt')
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('tel')
            ->add('quantity')
            ->add('paid')
            ->add('event')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EventReservation::class,
        ]);
    }
}
