<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BienRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass=BienRepository::class)
 * @Vich\Uploadable
 */
class Bien
{
    //pour le statut on doit imposer des types de choix
    const STATUTS = ["publier"=>"publier","depublier"=>"depublier","brouillon"=>"brouillon"];
    const TYPE = ["Villa"=>"Villa","Immeuble"=>"Immeuble","Chambre"=>"Chambre","Studio"=>"Studio","Appartement"=>"Appartement"];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private $Prix;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(choices=Bien::TYPE, message="Veuillez saisir un statut valable")
     */
    private $Typebien;

    /**
     * @ORM\Column(type="date")
     */
    private $Periode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Etat;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(choices=Bien::STATUTS, message="Veuillez saisir un statut valable")
     */
    private $Statut="brouillon";

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="biens")
     * @ORM\JoinColumn(nullable=true)
     */
    private $User;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->Prix;
    }

    public function setPrix(int $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getTypebien(): ?string
    {
        return $this->Typebien;
    }

    public function setTypebien(string $Typebien): self
    {
        $this->Typebien = $Typebien;

        return $this;
    }

    public function getPeriode(): ?\DateTimeInterface
    {
        return $this->Periode;
    }

    public function setPeriode(\DateTimeInterface $Periode): self
    {
        $this->Periode = $Periode;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->Etat;
    }

    public function setEtat(string $Etat): self
    {
        $this->Etat = $Etat;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

}
