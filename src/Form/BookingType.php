<?php
namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date', DateType::class,[
            'label' => 'Jour du rendez-vous',
            'label_attr' => [
                'class' => 'text-dark'
            ],
            'attr'=>[
                'class' => 'mb-3'
            ],
            'disabled'=>false,
            'widget' => 'single_text',
            
        ])

        ->add('hour', TimeType::class,[
            'label' => false,
            'placeholder' => [
                'hour' => 'Choisir l\'heure du rendez-vous'
            ],
            'attr'=>[
                'class' => 'mb-3'
            ],
            'widget' => 'choice',
            'with_minutes' => false,
            'with_seconds' => false,
            'hours'=> [ 9, 10, 11, 14, 15, 16 ],
        ])

        ->add('name', TextType::class,[
            'attr' => [
                'placeholder' => "Votre nom",
                'class'=>'mt-2'
            ],
            'label' => false,
            'constraints' => array(
                new NotBlank(['message' => 'Il faut un nom !']),
                new Length(['min' => 3, 'minMessage' => 'Votre nom est trop court !']),
            ),
        ])

        ->add('phone', TextType::class, [
            'attr' => [
                'placeholder' => 'Votre numéro de téléphone',
                'class'=>'mt-2'
            ],
            'label' => false,
            'constraints' => array(
                new NotBlank(['message' => 'Il faut un numéro de téléphone !']),
                new Length([
                    'min' => 8, 
                    'max' => 15,
                    'minMessage' => 'Votre numéro est trop court !',
                    'maxMessage'=> 'Votre numéro est trop long !'
                ]),
            ),
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
