<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 *
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("commande")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups("commande")
     */
    private $prixtot;

    /**
     * @ORM\Column(type="date")
     * @Groups("commande")

     */
    private $datecomm;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("commande")
     */
    private $modepaiement;



    /**
     * @ORM\Column(type="string", length=55)
     * @Groups("commande")
     */
    private $etatcomm;

    /**
     * @ORM\Column(type="string", length=90)
     * @Groups("commande")
     */
    private $addressecom;

    /**
     * @ORM\Column(type="integer")
     * @Groups("commande")
     */
    private $numtel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("commande")
     */
    private $mail;

//    /**
//     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
//     * @ORM\JoinColumn(nullable=false)
//     */
//    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, inversedBy="commandes")
     */
    private $produit;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixtot(): ?float
    {
        return $this->prixtot;
    }

    public function setPrixtot(float $prixtot): self
    {
        $this->prixtot = $prixtot;

        return $this;
    }

    public function getDatecomm(): ?\DateTimeInterface
    {
        return $this->datecomm;
    }

    public function setDatecomm(\DateTimeInterface $datecomm): self
    {
        $this->datecomm = $datecomm;

        return $this;
    }

    public function getModepaiement(): ?string
    {
        return $this->modepaiement;
    }

    public function setModepaiement(string $modepaiement): self
    {
        $this->modepaiement = $modepaiement;

        return $this;
    }


    public function getEtatcomm(): ?string
    {
        return $this->etatcomm;
    }

    public function setEtatcomm(string $etatcomm): self
    {
        $this->etatcomm = $etatcomm;

        return $this;
    }

    public function getAddressecom(): ?string
    {
        return $this->addressecom;
    }

    public function setAddressecom(string $addressecom): self
    {
        $this->addressecom = $addressecom;

        return $this;
    }

    public function getNumtel(): ?int
    {
        return $this->numtel;
    }

    public function setNumtel(int $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        $this->produit->removeElement($produit);

        return $this;
    }
//    public function getUser(): ?User
//    {
//        return $this->user;
//    }
//
//    public function setUser(?User $user): self
//    {
//        $this->user = $user;
//
//        return $this;
//    }


}
