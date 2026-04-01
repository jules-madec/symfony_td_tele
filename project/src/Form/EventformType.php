<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Promo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventformType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('titre');
        $builder->add('description');
        $builder->add('date_debut');
        $builder->add('date_fin');
        $builder->add('salle');
        $builder->add('intervenant');

        $builder->add('promo', EntityType::class, [
            'class' => Promo::class,
            'choice_label' => 'nom',
            'placeholder' => '-- Choisir une promo --',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
