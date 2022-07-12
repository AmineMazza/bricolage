<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandRepository::class)]
class Command
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $DateCammand;

    #[ORM\Column(type: 'date')]
    private $DateLivraison;

    #[ORM\Column(type: 'string', length: 255)]
    private $Description;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'commands')]
    private $idClient;

    #[ORM\Column(type: 'string', length: 255)]
    private $statut;

    #[ORM\ManyToOne(targetEntity: SousServices::class, inversedBy: 'commands')]
    private $id_sous_service;

    #[ORM\Column(type: 'string', length: 255)]
    private $Email;

    #[ORM\Column(type: 'string')]
    private $Tel;

    #[ORM\Column(type: 'string', length: 255)]
    private $ville;

    #[ORM\Column(type: 'string', length: 255)]
    private $Adresse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCammand(): ?\DateTimeInterface
    {
        return $this->DateCammand;
    }

    public function setDateCammand(\DateTimeInterface $DateCammand): self
    {
        $this->DateCammand = $DateCammand;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->DateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $DateLivraison): self
    {
        $this->DateLivraison = $DateLivraison;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getIdClient(): ?User
    {
        return $this->idClient;
    }

    public function getClientId()
    {
        return $this->idClient->getId();
    }

    public function setIdClient(?User $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getIdSousService(): ?SousServices
    {
        return $this->id_sous_service;
    }

    public function setIdSousService(?SousServices $id_sous_service): self
    {
        $this->id_sous_service = $id_sous_service;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }


    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }
	/**
	 * @return mixed
	 */
	function getTel(): ?string
    {
		return $this->Tel;
	}
	
	/**
	 * @param mixed $Tel 
	 * @return Command
	 */
	function setTel(string $Tel): self {
		$this->Tel = $Tel;
		return $this;
	}
}
