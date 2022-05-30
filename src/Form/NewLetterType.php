<?php

namespace App\Form;

use App\Entity\NewLetter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewLetterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'col-6',
                    'placeholder' => 'Votre email ici au format "name@example.com"'
                ],
                'label' => 'Vous souhaitez être informé de nos prochains évènenment ? laissez votre email ici',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewLetter::class,
        ]);
    }
}
