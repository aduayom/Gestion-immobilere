<?php

namespace App\DataFixtures;
use App\Entity\Bien;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BienFixtures extends Fixture
{
    private $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo=$repo;
    }
   
    public function load(ObjectManager $manager)
    {
        $categorie=$this->repo->findAll();
        foreach ($categorie as $key => $categorie) {
            for ($i=0; $i <6 ; $i++) {
                $biens=new Bien();
                $biens->setDescription("Même si maison et villa désignent tous deux un bâtiment d’habitation et de logement, certaines de leurs caractéristiques peuvent les distinguer l’une de l’autre. Voici alors quelques critères qui peuvent faire la différence entre une maison et une villa.");
                $biens->setPrix("5140000");
                $biens->setTypebien("Villa");
                $biens->setPeriode(new \DateTime());
                $biens->setEtat("contstruit");
                $biens->setStatut("Non loué");
                
                $manager->persist($biens);
            }
        }
        $manager->flush();
    }
}
