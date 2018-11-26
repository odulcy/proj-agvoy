<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtapeRepository")
 * @Vich\Uploadable
 */
class Etape
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $numeroEtape;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $villeEtape;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nombreJours;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Circuit", inversedBy="etapes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $circuit;

    /**
     * @Vich\UploadableField(mapping="etape_image", fileNameProperty="imageName")
     * @Assert\Image(
     *      mimeTypes="image/jpeg")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroEtape(): ?int
    {
        return $this->numeroEtape;
    }

    public function setNumeroEtape(int $numeroEtape): self
    {
        $this->numeroEtape = $numeroEtape;

        return $this;
    }

    public function getVilleEtape(): ?string
    {
        return $this->villeEtape;
    }

    public function setVilleEtape(string $villeEtape): self
    {
        $this->villeEtape = $villeEtape;

        return $this;
    }

    public function getNombreJours(): ?int
    {
        return $this->nombreJours;
    }

    public function setNombreJours(int $nombreJours): self
    {
        $this->nombreJours = $nombreJours;

        return $this;
    }

    public function getCircuit(): ?Circuit
    {
        return $this->circuit;
    }

    public function setCircuit(?Circuit $circuit): self
    {
        $this->circuit = $circuit;

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

}
