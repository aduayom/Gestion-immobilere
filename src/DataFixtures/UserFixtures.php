<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Repository\ProfilRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $repoProfil;
    private $encoder;
    public function __construct(ProfilRepository $repoProfil,UserPasswordEncoderInterface $encoder)
    {
        $this->repoProfil=$repoProfil;
        $this->encoder=$encoder;
    }

    public function load(ObjectManager $manager)
    {
        
        $profil=$this->repoProfil->findAll();
        foreach ( $profil as $key => $profils) {
            for ($i=1; $i < 3; $i++) { 
                $user= new User();
                //encoder password
                $pwd=$this->encoder->encodePassword($user,12345);
                //fin encodage
            $user->setEmail($profils->getLibelle().$i."d@gmail.com")
                ->setNom("daniel")
                ->setPrenom("Messan")
                ->setAdresse("Gueule Tapée")
                ->setProfil($profils)
                ->setPassword($pwd)
                ;
                $manager->persist($user);
            }
           
        }
        $manager->flush();
    }
}
