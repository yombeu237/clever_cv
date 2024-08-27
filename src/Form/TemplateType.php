<?php

namespace App\Form;

use App\Entity\Abonemment;
use App\Entity\Categorie;
use App\Entity\ModeDePaiement;
use App\Entity\Template;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TemplateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image')
            ->add('type')
            ->add('prix')
            ->add('modepaiement', EntityType::class, [
                'class' => ModeDePaiement::class,
                'choice_label' => 'id',
            ])
            ->add('abonnement', EntityType::class, [
                'class' => Abonemment::class,
                'choice_label' => 'id',
            ])
            ->add('categorieCv', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Template::class,
        ]);
    }
}
