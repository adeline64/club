<?php

namespace App\Entity;

use App\Repository\DisciplineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DisciplineRepository::class)
 */
class Discipline
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Coach::class, inversedBy="disciplines")
     */
    private $Coach;

    public function __construct()
    {
        $this->Coach = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Coach[]
     */
    public function getCoach(): Collection
    {
        return $this->Coach;
    }

    public function addCoach(Coach $coach): self
    {
        if (!$this->Coach->contains($coach)) {
            $this->Coach[] = $coach;
        }

        return $this;
    }

    public function removeCoach(Coach $coach): self
    {
        $this->Coach->removeElement($coach);

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
