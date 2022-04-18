<?php

namespace App\Form;


use App\Entity\Client;
use App\Entity\Secteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('secteur', EntityType::class, [
        'class' => Secteur::class,
        'choice_label' => 'name',
        'label' => 'secteur',
        'expanded' => true
    ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
