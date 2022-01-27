<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'label' => false,
                'constraints' => array(
                    new NotBlank(['message' => 'Il faut une adresse email !']),
                    new Email(['message' => 'L\'adresse email n\'est pas valide !']),
                ),
                'attr' => [
                    'placeholder' => 'Votre adresse email',
                    'class' => 'mb-3',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'constraints' => array(
                    new NotBlank(['message' => 'Il faut un message !']),
                    new Length(['min' => 10, 'minMessage' => 'Le message est trop court !']),
                ),
                'attr' => [
                    'placeholder' => 'Votre message',   
                    'rows' => '12',
                    'style' => 'resize:none',
                    'class' => 'mb-3',
                ],
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
