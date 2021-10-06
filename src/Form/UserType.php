<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices' => [
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                ],
            ]) 
            ->add('password', TextType::class, [
                'label' => 'Mot de passe',
                ]
            )
            ->add('isVerified', CheckboxType::class, [
                'label' => 'Compte vérifié',
                ]
            )
        ;

        $builder->get('roles')
                ->addModelTransformer(new CallbackTransformer(
                    function($rolesArray) {
                        return count($rolesArray) ? $rolesArray[0] : null;
                    },
                    function($rolesString) {
                        return [$rolesString];
                    }
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
