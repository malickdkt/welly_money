<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
   
    private $encoder;

     public function __construct(UserPasswordEncoderInterface $encoder)
     {
         $this->encoder = $encoder;
     }
    public function load(ObjectManager $manager)
    {
        $role_admin_system = new Role();
        $role_admin_system->setLibelle("ROLE_ADMIN_SYSTEM");
        $manager->persist($role_admin_system);

        $role_admin = new Role();
        $role_admin->setLibelle("ROLE_ADMIN");
        $manager->persist($role_admin);

        $role_caissier = new Role();
        $role_caissier->setLibelle("ROLE_CAISSIER");
        $manager->persist($role_caissier);

        $this->addReference('role_admin_system',$role_admin_system);
        $this->addReference('role_admin',$role_admin);
        $this->addReference('role_caissier',$role_caissier);
        
        $roleAdmdinSystem = $this->getReference('role_admin_system');
        $roleAdmin = $this->getReference('role_admin');
        $roleCaissier = $this->getReference('role_caissier');

        $user = new User();
        $user->setUsername('malickdkt');
        $user->setRole($roleAdmdinSystem);
        $user->setPassword('miko');
        $user->setRoles(["ROLE_ADMIN_SYSTEM"]);
        $user->setPrenom("malick");
        $user->setNom("diakhate");
        $user->setEmail("malickdkt@gmail.com");
        $user->setIsActive(true);    
        $manager->persist($user);
        $manager->flush();
  
       
    }
}
