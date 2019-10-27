<?php

namespace App\Form;

use App\Entity\Opt;
use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedrooms')
            ->add('floor')
            ->add('prince')
            ->add('heat',ChoiceType::class,[
                 'choices' => array(
                    'Gaz' => '0',
                    'Bois' => '1',
                    'Electrique' => '2')
            ])
            ->add('opts', EntityType::class,[
                'class' => Opt::class,
                'choice_label' => 'name',
                'multiple' => true

            ])
            ->add('city')
            ->add('adress')
            ->add('postal_code')
            ->add('sold')
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }

}