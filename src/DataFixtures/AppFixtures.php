<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Nelmio\Alice\Loader\NativeLoader;
use App\DataFixtures\MyCustomNativeLoader;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture {

    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        // Fixture à la main pour les trois user et rôle
        $roleUser = new Role();
        $roleUser->setCode('ROLE_USER');
        $roleUser->setRole('user');
        
        $roleAdmin = new Role();
        $roleAdmin->setCode('ROLE_ADMIN');
        $roleAdmin->setRole('admin');

        $roleModerator = new Role();
        $roleModerator->setCode('ROLE_MODERATOR');
        $roleModerator->setRole('Moderator');

        // Fixture pour la création d'utilisateurs en associant a chaque fois un role différent
        $admin = new User();
        //j'encode mon mot de passe avant de le stocker dans ma propriété password
        $encodedPassword = $this->encoder->encodePassword($admin, 'admin');
        $admin->setusername('admin')
            ->setFirstname('OH grand maître')
            ->setLastname('admin')
            ->setEmail('admin@admin.fr')
            ->setPassword($encodedPassword)
            ->setAvatar('http://lorempixel.com/output/food-q-c-64-64-4.jpg')
            ->setRole($roleAdmin);

        $user = new User();
        $encodedPassword = $this->encoder->encodePassword($user, 'user');
        $user->setusername('user')
            ->setFirstname('Simple utilisateur')
            ->setLastname('user')
            ->setEmail('user@user.fr')
            ->setPassword($encodedPassword)
            ->setAvatar('http://lorempixel.com/output/food-q-c-64-64-4.jpg')
            ->setRole($roleUser); 

        $moderator = new User();
        $encodedPassword = $this->encoder->encodePassword($moderator, 'moderator');
        $moderator->setusername('moderator')
            ->setFirstname('Sous chef de grade moderateur')
            ->setLastname('moderator')
            ->setEmail('moderator@moderator.fr')
            ->setPassword($encodedPassword)
            ->setAvatar('http://lorempixel.com/output/food-q-c-64-64-4.jpg')
            ->setRole($roleModerator);

        // Enregistrement en BDD
        $manager->persist($roleAdmin);
        $manager->persist($roleUser);
        $manager->persist($roleModerator);
        $manager->persist($admin);
        $manager->persist($user);
        $manager->persist($moderator);

        $manager->flush();

        
        // ******************* Fixtures Alice *******************
        // $loader = new NativeLoader();
        $loader = new MyCustomNativeLoader();

        //importe le fichier de fixtures et récupère les entités générés
        $entities = $loader->loadFile(__DIR__.'/fixtures.yml')->getObjects();
        
        //empile la liste d'objet à enregistrer en BDD
        foreach ($entities as $entity) {
            $manager->persist($entity);
        };
        
        //enregistre
        $manager->flush();

    }
}