<?php

namespace App\Form;

use App\Entity\Voiture;
use Dom\Entity;
use Masterminds\HTML5\Entities;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('serie', TextType::class)
            ->add('dateMiseEnMarche', DateType::class)
            ->add('modele', EntityType::class, [
                'class' => 'App\Entity\Modele',
                'choice_label' => 'libelle',
                'placeholder' => 'Choose a modele',
            ])
            ->add('prixJour', TextType::class)
        ;
    }

    public function getName() {
        return 'voiture';
    }
}
