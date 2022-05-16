<?php

namespace App\Entity;

use App\Repository\PhotosRepository;
use App\Entity\Siteh;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotosRepository::class)
 */
class Photos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Exposee::class, inversedBy="photo")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $exposee;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Siteh", inversedBy="photos")
     */
    private $siteh;
    /**
     * @ORM\ManyToOne(targetEntity=Blog::class, inversedBy="name")
     *  @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $Blog;

    public function __construct()
    {
        $this->siteh = new ArrayCollection();
    }

    public function getBlog(): ?Blog
    {
        return $this->Blog;
    }

    public function setBlog(?Blog $Blog): self
    {
        $this->Blog = $Blog;

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getExposee(): ?Exposee
    {
        return $this->exposee;
    }

    public function setExposee(?Exposee $exposee): self
    {
        $this->exposee = $exposee;

        return $this;
    }

    /**
     * @return Collection|Siteh[]
     */
    public function getSiteh(): Collection
    {
        return $this->siteh;
    }
    public function setSiteh(Siteh $siteH): self
    {
        if (!$this->siteh->contains($siteH)) {
            $this->siteh[] = $siteH;
        }
        return $this;
    }
    public function removeSiteh(Siteh $siteH): self
    {
        if ($this->siteh->contains($siteH)) {
            $this->siteh->removeElement($siteH);
        }
        return $this;
    }




}
