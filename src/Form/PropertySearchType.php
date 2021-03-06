<?php

namespace App\Form;

use App\Entity\Opt;
use App\Entity\PropertySearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrince', IntegerType::class,[

                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'prix maximum'
                ]
            ])
            ->add('minSurface', IntegerType::class,[

                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'surface minimum'
                ]
            ])
            ->add('opt' , EntityType::class ,[
                'required' => false,
                'label' => false,
                'class' => Opt::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('chercher', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'get',
            'csrf_protection' => false,

        ]);
    }

    public function getBlockPrefix(){

        return '';
    }
}
