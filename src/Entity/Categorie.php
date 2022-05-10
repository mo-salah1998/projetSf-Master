<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
//test
/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("categorie")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("categorie")
     */
    private $nameCategorie;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="categorie")
     */
    private $questions;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("categorie")
     */
    private $nbrQuestion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("categorie")
     */
    private $nbrVueCategorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("categorie")
     */
    private $Tag;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="categories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;



    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategorie(): ?string
    {
        return $this->nameCategorie;
    }

    public function setNameCategorie(string $nameCategorie): self
    {
        $this->nameCategorie = $nameCategorie;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setCategorie($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getCategorie() === $this) {
                $question->setCategorie(null);
            }
        }

        return $this;
    }

    public function getNbrQuestion(): ?int
    {
        return $this->nbrQuestion;
    }

    public function setNbrQuestion(?int $nbrQuestion): self
    {
        $this->nbrQuestion = $nbrQuestion;

        return $this;
    }

    public function getNbrVueCategorie(): ?int
    {
        return $this->nbrVueCategorie;
    }

    public function setNbrVueCategorie(?int $nbrVueCategorie): self
    {
        $this->nbrVueCategorie = $nbrVueCategorie;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->Tag;
    }

    public function setTag(?string $Tag): self
    {
        $this->Tag = $Tag;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }



}
