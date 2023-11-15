<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'membre', targetEntity: Album::class, orphanRemoval: true)]
    private Collection $albums;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'createur', targetEntity: Equipe::class)]
    private Collection $equipes;

    #[ORM\OneToMany(mappedBy: 'membre', targetEntity: Panini::class, orphanRemoval: true)]
    private Collection $paninis;

    #[ORM\OneToOne(inversedBy: 'membre', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
        $this->equipes = new ArrayCollection();
        $this->paninis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): static
    {
        if (!$this->albums->contains($album)) {
            $this->albums->add($album);
            $album->setMembre($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): static
    {
        if ($this->albums->removeElement($album)) {
            // set the owning side to null (unless already changed)
            if ($album->getMembre() === $this) {
                $album->setMembre(null);
            }
        }

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getId();
    }

    /**
     * @return Collection<int, Membre>
     */

    /**
     * @return Collection<int, Equipe>
     */
    public function getEquipes(): Collection
    {
        return $this->equipes;
    }

    public function addEquipe(Equipe $equipe): static
    {
        if (!$this->equipes->contains($equipe)) {
            $this->equipes->add($equipe);
            $equipe->setCreateur($this);
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): static
    {
        if ($this->equipes->removeElement($equipe)) {
            // set the owning side to null (unless already changed)
            if ($equipe->getCreateur() === $this) {
                $equipe->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Panini>
     */
    public function getPaninis(): Collection
    {
        return $this->paninis;
    }

    public function addPanini(Panini $panini): static
    {
        if (!$this->paninis->contains($panini)) {
            $this->paninis->add($panini);
            $panini->setMembre($this);
        }

        return $this;
    }

    public function removePanini(Panini $panini): static
    {
        if ($this->paninis->removeElement($panini)) {
            // set the owning side to null (unless already changed)
            if ($panini->getMembre() === $this) {
                $panini->setMembre(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }
}