<?php

namespace App\Form;

use App\Entity\PromotionCode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionCodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productName', TextType::class, [
                'label' => 'Nom du produit'
            ])
            ->add('rate', IntegerType::class, [
                'label' => 'Pourcentage',
                'attr' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ])
            ->add('code', TextType::class, [
                'label' => 'Code de la promotion'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PromotionCode::class,
        ]);
    }
}
