<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("question")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("question")
     */
    private $question;


    protected $captchaCode;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="questions")
     */
    private $categorie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("question")
     */
    private $nbrVue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("question")
     */
    private $nbrReponse;

    /**
     * @ORM\OneToMany(targetEntity=Reponse::class, mappedBy="question")
     */
    private $reponse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("question")
     */
    private $Tag;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }


    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getNbrVue(): ?int
    {
        return $this->nbrVue;
    }

    public function setNbrVue(?int $nbrVue): self
    {
        $this->nbrVue = $nbrVue;

        return $this;
    }

    public function getNbrReponse(): ?int
    {
        return $this->nbrReponse;
    }

    public function setNbrReponse(?int $nbrReponse): self
    {
        $this->nbrReponse = $nbrReponse;

        return $this;
    }
    /**
     * @return Collection|Reponse[]
     */
    public function getReponse(): Collection
    {
     return   $this->reponse;
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
