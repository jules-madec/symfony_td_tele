<?php

namespace App\Form;

use App\Entity\News;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsformType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('type', ChoiceType::class, [
            'choices' => [
                'Campus' => 'campus',
                'Compiegne' => 'compiegne',
                'Anniversaire' => 'anniversaire',
                'Celebration' => 'celebration',
                'Mouvement social' => 'mouvement_social',
                'News IT/Digital/Design' => 'it_digital_design',
                'Fun fact' => 'fun_fact',
            ],
            'placeholder' => '-- Choisir un type --',
        ]);

        $builder->add('titre');
        $builder->add('contenu');
        $builder->add('source');
        $builder->add('date_debut');
        $builder->add('date_fin');
        $builder->add('actif');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
