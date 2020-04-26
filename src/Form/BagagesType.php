<?php

namespace App\Form;

use App\Entity\Bagages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\Reservations;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use App\Entity\Voyages;

class BagagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeBagage')
            ->add('poids')
            ->add('listeBagages', TextareaType::class)
            // ->add('client', EntityType::class,[
            //     'class' => Reservations::class,
            //     'choice_label' => 'email',
            // ])
            ->add('reservation', EntityType::class,[
                'placeholder' => '',
                'class' => Reservations::class,
                'choice_label' => 'client.nomcli',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bagages::class,
        ]);
    }
}
