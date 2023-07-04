<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'tache', targetEntity: SousTache::class, orphanRemoval: true)]
    private Collection $sousTaches;

    public function __construct()
    {
        $this->sousTaches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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
     * @return Collection<int, SousTache>
     */
    public function getSousTaches(): Collection
    {
        return $this->sousTaches;
    }

    public function addSousTach(SousTache $sousTach): self
    {
        if (!$this->sousTaches->contains($sousTach)) {
            $this->sousTaches->add($sousTach);
            $sousTach->setTache($this);
        }

        return $this;
    }

    public function removeSousTach(SousTache $sousTach): self
    {
        if ($this->sousTaches->removeElement($sousTach)) {
            // set the owning side to null (unless already changed)
            if ($sousTach->getTache() === $this) {
                $sousTach->setTache(null);
            }
        }

        return $this;
    }
}
