<?php

namespace App\Form;

use App\Entity\Circuit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CircuitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description',TextType::class)
            ->add('paysDepart')
            ->add('villeArrivee')
            ->add('villeDepart')
            ->add('imageFile', FileType::class, [
              'required' => false
            ])
            ->add('category', CollectionType::class, array(
              'entry_type' => ChoiceType::class,
              'entry_options' => array(
                'label' => false,
                'choices' => $options['categories'],
              ),
              'allow_add' => true,
              'allow_delete' => true,
              'by_reference' => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Circuit::class,
            'categories' => null
        ]);
    }
}
