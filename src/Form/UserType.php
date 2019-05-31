<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use App\Utils\TypeConfigurator;
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

        $builder
            ->add('username', TextType::class, $this->getConfiguration("Pseudo : ", "Pseudo"))
            ->add('password', RepeatedType::class, [
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
            ])
            ->add('firstname', TextType::class, $this->getConfiguration("Prénom :", "Votre prénom" ) )
            ->add('lastname', TextType::class, $this->getConfiguration("Nom :", "Votre nom de famille") )
            ->add('email', EmailType::class, $this->getConfiguration("Email :", "Votre adresse mail"))
            ->add('age', IntegerType::class, $this->getConfiguration("Age : ","Votre âge "))
            ->add('weight',  IntegerType::class, $this->getConfiguration("Poids : ","Votre poids en Kilo ", false))
            ->add('height', IntegerType::class, $this->getConfiguration("Taille : ","Votre Taille en cm ", false))
            ->add('gender', ChoiceType::class,[
                'choices' => [
                    'homme' => 'homme',
                    'femme' => 'femme',
                ],
                'label' =>'Sexe :'
                ])
            ->add('avatar', UrlType::class, $this->getConfiguration("Photo :", "Votre photo de profil" ))
            ->add('is_active')
            ->add('role', EntityType::class, [
                'label' => 'Choisir un role à l\'utilisateur :',
                'class' => Role::class,
                'choice_label' => 'role',
                'multiple' => false,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
