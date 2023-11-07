<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'equipes', targetEntity: Membre::class)]
    private Collection $créateur;

    #[ORM\ManyToMany(targetEntity: Panini::class, inversedBy: 'equipes')]
    private Collection $paninis;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    public function __construct()
    {
        $this->créateur = new ArrayCollection();
        $this->paninis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Membre>
     */
    public function getCréateur(): Collection
    {
        return $this->créateur;
    }

    public function addCrAteur(Membre $crAteur): static
    {
        if (!$this->créateur->contains($crAteur)) {
            $this->créateur->add($crAteur);
            $crAteur->setEquipes($this);
        }

        return $this;
    }

    public function removeCrAteur(Membre $crAteur): static
    {
        if ($this->créateur->removeElement($crAteur)) {
            // set the owning side to null (unless already changed)
            if ($crAteur->getEquipes() === $this) {
                $crAteur->setEquipes(null);
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
        }

        return $this;
    }

    public function removePanini(Panini $panini): static
    {
        $this->paninis->removeElement($panini);

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
