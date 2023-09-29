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
}
