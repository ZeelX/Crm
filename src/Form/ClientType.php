<?php

namespace App\Form;

use App\Entity\Client;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class)
            ->add('nom',TextType::class)
            ->add('entreprise',TextType::class)
            ->add('mail', EmailType::class)
            ->add('telephone')
            ->add('notePerso',TextType::class)
            ->add('Adresse',TextType::class)
            ->add('codePostal')
            ->add('ville',TextType::class)
            ->add('secteur');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
