<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#Validation
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CircuitRepository")
 * @Vich\Uploadable
 */
class Circuit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $paysDepart;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $villeArrivee;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $villeDepart;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $dureeCircuit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Etape", mappedBy="circuit", orphanRemoval=true)
     */
    private $etapes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProgrammationCircuit", mappedBy="circuit")
     */
    private $programmationCircuits;

    /**
     * @Vich\UploadableField(mapping="circuit_image", fileNameProperty="imageName")
     * @Assert\Image(
     *    mimeTypes="image/jpeg")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;


    public function __construct()
    {
        $this->etapes = new ArrayCollection();
        $this->programmationCircuits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPaysDepart(): ?string
    {
        return $this->paysDepart;
    }

    public function setPaysDepart(?string $paysDepart): self
    {
        $this->paysDepart = $paysDepart;

        return $this;
    }

    public function getVilleArrivee(): ?string
    {
        return $this->villeArrivee;
    }

    public function setVilleArrivee(?string $villeArrivee): self
    {
        $this->villeArrivee = $villeArrivee;

        return $this;
    }

    public function getVilleDepart(): ?string
    {
        return $this->villeDepart;
    }

    public function setVilleDepart(?string $villeDepart): self
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    public function getDureeCircuit(): ?int
    {
        return $this->dureeCircuit;
    }

    public function setDureeCircuit(): self
    {
        $dureeCircuit = 0;
        $etapes = $this -> $etapes;
        foreach ($etapes as $etape) {
          $dureeCircuit+= $etape.getNombreJours();
        }

        $this->dureeCircuit = $dureeCircuit;

        return $this;
    }

    /**
     * @return Collection|Etape[]
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etape $etape): self
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes[] = $etape;
            $etape->setCircuit($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): self
    {
        if ($this->etapes->contains($etape)) {
            $this->etapes->removeElement($etape);
            // set the owning side to null (unless already changed)
            if ($etape->getCircuit() === $this) {
                $etape->setCircuit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProgrammationCircuit[]
     */
    public function getProgrammationCircuits(): Collection
    {
        return $this->programmationCircuits;
    }
    public function addProgrammationCircuit(ProgrammationCircuit $programmationCircuit): self
    {
        if (!$this->programmationCircuits->contains($programmationCircuit)) {
            $this->programmationCircuits[] = $programmationCircuit;
            $programmationCircuit->setCircuit($this);
        }
        return $this;
    }

    public function removeProgrammationCircuit(ProgrammationCircuit $programmationCircuit): self
    {
        if ($this->programmationCircuits->contains($programmationCircuit)) {
            $this->programmationCircuits->removeElement($programmationCircuit);
            // set the owning side to null (unless already changed)
            if ($programmationCircuit->getCircuit() === $this) {
                $programmationCircuit->setCircuit(null);
            }
        }

        return $this;
    }

    public function setImageFile(?File $imageFile): self
    {
      $this->imageFile = $imageFile;
      if($this->imageFile instanceof UploadedFile){
        $this->updated_at = new \DateTime('now');
      }

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }


    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function __toString() {
      return (string) $this->getId();
    }
}
