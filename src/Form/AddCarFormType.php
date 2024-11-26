<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCarFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Nom',
            ])
            ->add('description',TextareaType::class, [
                'label' => 'Description',
            ])
            ->add('month_price', MoneyType::class, [
                'label' => 'Prix Mensuel ',
            ])
            ->add('day_price', MoneyType::class, [
                'label' => 'Prix Journalier ',
            ])
            ->add('seat', ChoiceType::class, [
                'choices' => [
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6',
                    7 => '7',
                    8 => '8',
                    9 => '9',
                ],
                'label' => 'Nombre de sièges',
            ])
            ->add('gearbox', ChoiceType::class, [
                'choices' => [
                    'Automatique ' => 'Automatique',
                    'Manuelle' => 'Manuelle',
                ],
                'label' => 'Boite de vitesse'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Ajouter une voiture',
                'attr' => ['class' => 'btn-add']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
            'seat' => '20'
        ]);
    }
}
