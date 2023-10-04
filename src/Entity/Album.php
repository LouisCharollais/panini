<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Panini::class, orphanRemoval: true)]
    private Collection $paninis;

    #[ORM\ManyToOne(inversedBy: 'albums')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Membre $membre = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    public function __construct()
    {
        $this->paninis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $panini->setAlbum($this);
        }

        return $this;
    }

    public function removePanini(Panini $panini): static
    {
        if ($this->paninis->removeElement($panini)) {
            // set the owning side to null (unless already changed)
            if ($panini->getAlbum() === $this) {
                $panini->setAlbum(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getId();
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): static
    {
        $this->membre = $membre;

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

}
