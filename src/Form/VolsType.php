<?php

namespace App\Form;

use App\Entity\Vols;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\CompagnieAeriennes;

class VolsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDepart', DateType::class, [
                'placeholder' => [
                    'day' => 'Jour', 'month' => 'Mois', 'year' => 'Année' ]
                ])
            ->add('heureDepart', TimeType::class, [
                'placeholder' => [
                    'Heure' => 12, 'minute' => 60 ]
                ])
            ->add('dateArrivee', DateType::class, [
                'placeholder' => [
                    'day' => 'Jour', 'month' => 'Mois', 'year' => 'Année' ]
                ])
            ->add('heureArrivee', TimeType::class, [
                'placeholder' => [
                    'Heure' => 12, 'minute' => 60 ]
                ])
            ->add('aeroportDepart', TextType::class)
            ->add('aeroportArrivee', TextType::class)
            ->add('compagnie', EntityType::class, [
                'class' => CompagnieAeriennes::class,
                'choice_label' => 'nomCompagnie'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vols::class,
        ]);
    }
}
