<?php

namespace App\Form\Admin;

use App\Entity\Admin\Reservations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class ReservationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userid')
            ->add('transportsid')
            ->add('name')
            ->add('surname')
            ->add('email')
            ->add('departuretime', DateTimeType::class, [
                'date_label' => 'Starts On',
            ])
            ->add('total')
            ->add('status')
            ->add('created_at')
            ->add('updated_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservations::class,
        ]);
    }
}
