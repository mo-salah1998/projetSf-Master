<?php

namespace App\Entity;

use App\Repository\SitehRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SitehRepository::class)
 */
class Siteh
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="string", length=255)
     * @Groups ("post:read")
     */
    private $nom;

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
     * @ORM\ManyToMany(targetEntity="App\Entity\Photos", mappedBy="siteh", orphanRemoval=true, cascade={"persist", "refresh", "remove"})
     */
    private $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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
     * @return Collection|Photos[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photos $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setSiteh($this);
        }

        return $this;
    }

    public function remove(Photos $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getSiteh() === $this) {
                $photo->setSiteh(null);
            }
        }

        return $this;
    }
}

