<?php

namespace App\Entity;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vish\UploaderBundle\Mapping\Annotation\UploadbleFile;
use Vich\UploaderBundle\Mapping\Annotation\Uploable;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @Vich\Uploadable
 */
class User implements UserInterface ,\Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("user")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups("user")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(
     *     min=8
     *     )
     * @Groups("user")
     *
     */
    private $password;

    /**
     *
     * @Assert\EqualTo(propertyPath="password" , message="this should be equal To your password")
     */
    public $Confirmer_password;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user")
     */
    public $code;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups("user")
     */
    private $reset_code;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("user")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user")
     */
    private $tel;
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     * @Groups("user")
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="event_image", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="user", orphanRemoval=true)
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity=Reponse::class, mappedBy="user", orphanRemoval=true)
     */
    private $reponses;

    /**
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="user", orphanRemoval=true)
     */
    private $categories;

//    /**
//     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="user", orphanRemoval=true)
//     */
//    private $commandes;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->reponses = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;
        return $this;

        /*if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }*/
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    public function adminDashboard()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // or add an optional message - seen by developers
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
    }

    public function getResetCode(): ?string
    {
        return $this->reset_code;
    }

    public function setResetCode(?string $reset_code): self
    {
        $this->reset_code = $reset_code;

        return $this;
    }
    public function getName(): string
    {
        return (string) $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->tel,
            $this->password,
            $this->roles,
            $this->image,
            $this->questions,

        ));
        // $this->image = base64_encode($this->image);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->tel,
            $this->password,
            $this->roles,
            $this->image,
            $this->questions,
            ) = unserialize($serialized, array('allowed_classes' => false));
        //$this->image = base64_decode($this->image);
    }
    /**
     * Transform to string
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
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
            $question->setUser($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getUser() === $this) {
                $question->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reponse[]
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses[] = $reponse;
            $reponse->setUser($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getUser() === $this) {
                $reponse->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setUser($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getUser() === $this) {
                $category->setUser(null);
            }
        }

        return $this;
    }

//    /**
//     * @return Collection|Commande[]
//     */
//    public function getCommandes(): Collection
//    {
//        return $this->commandes;
//    }
//
//    public function addCommande(Commande $commande): self
//    {
//        if (!$this->commandes->contains($commande)) {
//            $this->commandes[] = $commande;
//            $commande->setUser($this);
//        }
//
//        return $this;
//    }
//
//    public function removeCommande(Commande $commande): self
//    {
//        if ($this->commandes->removeElement($commande)) {
//            // set the owning side to null (unless already changed)
//            if ($commande->getUser() === $this) {
//                $commande->setUser(null);
//            }
//        }
//
//        return $this;
//    }



    public function setId(int $id): self
    {
        $this->$id = $id;

        return $this;
    }

}
