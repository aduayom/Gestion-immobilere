<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfilFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $libelle=["Gestionnaire","Client","Propriétaire"];
        foreach ($libelle as $key => $libelles) {
            $profil= new Profil();
            $profil->setLibelle($libelles);
            $manager->persist($profil);
        }
        $manager->flush();
    }
}
