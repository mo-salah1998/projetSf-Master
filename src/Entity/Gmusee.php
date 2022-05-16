<?php

namespace App\Entity;

use App\Repository\GmuseeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=GmuseeRepository::class)
 */
class Gmusee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups ("post:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_musee;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("post:read")
     */
    private  $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("post:read")
     */
    private $place;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("post:read")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="gmusee", orphanRemoval=true, cascade={"persist", "refresh", "remove"})
     */
    private $images;

    /**
     * Gmusee constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMusee(): ?string
    {
        return $this->id_musee;
    }

    public function setIdMusee(string $id_musee): self
    {
        $this->id_musee = $id_musee;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setGmusee($this);
        }

        return $this;
    }

    public function deleteImage(Images $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getGmusee() === $this) {
                $image->setGmusee(null);
            }
        }

        return $this;
    }
}

