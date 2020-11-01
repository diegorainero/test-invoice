<?php

// src/Form/Type/InvoiceRowType.php
namespace App\Form\Type;

use App\Entity\InvoiceRow;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DecimalType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class InvoiceRowType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add(
        'description', 
        TextType::class,
        [
          'validation_groups' => [new NotBlank()],
          'attr' => ['class' => 'form-control']
        ]
        )
      ->add(
        'quantity', 
        IntegerType::class,
        [
          'attr' => ['class' => 'form-control-date col-md-6']
        ]
        )
      ->add(
        'price',
        NumberType::class,
        [
          'validation_groups' => [new NotBlank()],
          'attr' => ['class' => 'form-control col-md-6']
        ]
      )
      ->add(
        'vat_price',
        NumberType::class,
        [
          'validation_groups' => [new NotBlank()],
          'attr' => ['class' => 'form-control col-md-6']
        ]
      )
      ->add(
        'total_price',
        NumberType::class,
        [
          'validation_groups' => [new NotBlank()],
          'attr' => ['class' => 'form-control col-md-6']
        ]
      );
  }
  
  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults([
          'data_class' => InvoiceRow::class,
      ]);
  }
}