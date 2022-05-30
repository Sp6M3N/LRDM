<?php

namespace App\Form;

use App\Entity\Event;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('eventType', null, [
                'class' => \App\Entity\EventType::class,
                'choice_label' => 'wording'
            ])
            ->add('eventDate', DateTimeType::class, [
                'attr' => ['class' => 'col-6'],
                'date_label' => 'Date de l\évènement',
//                'date_widget' => 'single_text',
//                'time_widget' => 'single_text',
                'widget' => 'single_text'

            ])
            ->add('detail', CKEditorType::class)
            ->add('images', FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
