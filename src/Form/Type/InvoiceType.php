<?php

// src/Form/Type/InvoiceType.php
namespace App\Form\Type;

use App\Entity\Invoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class InvoiceType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add(
        'invoice_number', 
        IntegerType::class,
        [
          'validation_groups' => [new NotBlank()],
          'attr' => ['class' => 'form-control']
        ]
        )
      ->add(
        'invoice_date', 
        DateType::class,
        [
          'attr' => ['class' => 'form-control-date']
        ]
        )
      ->add(
        'invoice_client_id',
        IntegerType::class,
        [
          'validation_groups' => [new NotBlank()],
          'attr' => ['class' => 'form-control']
        ]
      )
      ->add(
        'create',
        SubmitType::class,
        [
          'attr' => ['class' => 'form-control btn-primary pull-right'],
          'label' => 'Save!'
        ]
      )
      ->add(
        'invoiceRow', 
        CollectionType::class, 
        [
          'entry_type' => InvoiceRowType::class,
          'entry_options' => ['label' => false],
          'allow_add' => true,
          'by_reference' => false
      ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults([
          'data_class' => Invoice::class,
      ]);
  }
}