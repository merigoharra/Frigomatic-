<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use App\Utils\TypeConfigurator;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends TypeConfigurator
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        // Listener pour ajouter les champs isActive et Role si l'utilisateur est admin
        $listener = function(FormEvent $event) {

            $userData = $event->getData();
            $userForm = $event->getForm();

            if($userData->getId()) {
                if($userData->getRole()->getRole() == 'admin') {
                    $userForm->add('is_active')
                            ->add('role', EntityType::class, [
                        'label' => 'Choisir un role à l\'utilisateur :',
                        'class' => Role::class,
                        'choice_label' => 'role',
                        'multiple' => false,
                        'expanded' => true,
                    ]);
                } else {
                    return;
                }
            } else {
                $userForm->add('password', RepeatedType::class, [
                    'constraints' => [new NotBlank()],
                    'first_options' => [
                        'label' => 'Mot de passe :',
                        'attr' => [
                            'placeholder' => 'Choissez un mot de passe',
                        ]],
                    'second_options' => [
                        'label' => 'Mot de passe :',
                        'attr' => [
                            'placeholder' => 'Confirmer le mot de passe'
                        ]],
                    'type' => PasswordType::class
                ]);
            }

        };

        
        $builder
            ->add('username', TextType::class, $this->getConfiguration("Pseudo : ", "Pseudo"))
            ->addEventListener(FormEvents::PRE_SET_DATA, $listener)
            ->add('firstname', TextType::class, $this->getConfiguration("Prénom :", "Votre prénom" ) )
            ->add('lastname', TextType::class, $this->getConfiguration("Nom :", "Votre nom de famille") )
            ->add('email', EmailType::class, $this->getConfiguration("Email :", "Votre adresse mail"))
            ->add('avatar', UrlType::class, $this->getConfiguration("Photo :", "Votre photo de profil", false))
            ->add('age', IntegerType::class, $this->getConfiguration("Age : ","Votre âge ", false))
            ->add('weight',  IntegerType::class, $this->getConfiguration("Poids : ","Votre poids en Kilo ", false))
            ->add('height', IntegerType::class, $this->getConfiguration("Taille : ","Votre Taille en cm ", false))
            ->add('gender', ChoiceType::class, $this->getConfiguration("Sexe : ","", false, ['choices' => [
                    'homme' => 'homme',
                    'femme' => 'femme',
                ]
            ]))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
