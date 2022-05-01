<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Contrat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('createdAt', DateType::class,[
                'label' => 'Date de début du contrat',
                'widget'=>'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('finishedAt', DateType::class, [
                'label' => 'Date de fin de contrat',
                'widget'=>'single_text',
                'required' => false,
                'format' => 'yyyy-MM-dd',
                'empty_data' => '1900-01-01',

            ])
            ->add('mission')
            ->add('noteperso', TextType::class, [
                'label' => 'Note Personnel',
                'required' => false,
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,



            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
