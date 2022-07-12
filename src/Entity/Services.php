<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Image;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name_Service;

    #[ORM\Column(type: 'string', length: 255)]
    private $discription;

    #[ORM\OneToMany(mappedBy: 'idService', targetEntity: SousServices::class)]
    private $sousServices;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'services')]
    private $idCatégorie;

    public function __construct()
    {
        $this->sousServices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getNameService(): ?string
    {
        return $this->Name_Service;
    }

    public function setNameService(string $Name_Service): self
    {
        $this->Name_Service = $Name_Service;

        return $this;
    }

    public function getDiscription(): ?string
    {
        return $this->discription;
    }

    public function setDiscription(string $discription): self
    {
        $this->discription = $discription;

        return $this;
    }

    /**
     * @return Collection<int, SousServices>
     */
    public function getSousServices(): Collection
    {
        return $this->sousServices;
    }

    public function addSousService(SousServices $sousService): self
    {
        if (!$this->sousServices->contains($sousService)) {
            $this->sousServices[] = $sousService;
            $sousService->setIdService($this);
        }

        return $this;
    }

    public function removeSousService(SousServices $sousService): self
    {
        if ($this->sousServices->removeElement($sousService)) {
            // set the owning side to null (unless already changed)
            if ($sousService->getIdService() === $this) {
                $sousService->setIdService(null);
            }
        }

        return $this;
    }

    public function getIdCatégorie(): ?Categorie
    {
        return $this->idCatégorie;
    }

    public function setIdCatégorie(?Categorie $idCatégorie): self
    {
        $this->idCatégorie = $idCatégorie;

        return $this;
    }

    public function __toString() {
        return $this->Name_Service;
    }
}
