<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReportFilterForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('place', ChoiceType::class, [
                'choices' => [
                    'Place 1' => 'Place 1',
                    'Place 2' => 'Place 2',
                    'Place 3' => 'Place 3',
                    'Place 4' => 'Place 4',
                    'Place 5' => 'Place 5',
                    'Place 6' => 'Place 6',
                ],
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('from', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('to', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank(),
                ]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }

}