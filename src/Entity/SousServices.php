<?php

namespace App\Entity;

use App\Repository\SousServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousServicesRepository::class)]
class SousServices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'string', length: 255)]
    private $Description;

    #[ORM\ManyToOne(targetEntity: Services::class, inversedBy: 'sousServices')]
    private $idService;

    #[ORM\OneToMany(mappedBy: 'id_sous_service', targetEntity: Command::class)]
    private $commands;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;


    public function __construct()
    {
        $this->commands = new ArrayCollection();
    }

    #[ORM\Column(type: 'integer')]

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

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

    public function getIdService(): ?Services
    {
        return $this->idService;
    }

    public function setIdService(?Services $idService): self
    {
        $this->idService = $idService;

        return $this;
    }

    /**
     * @return Collection<int, Command>
     */
    public function getCommands(): Collection
    {
        return $this->commands;
    }

    public function addCommand(Command $command): self
    {
        if (!$this->commands->contains($command)) {
            $this->commands[] = $command;
            $command->setIdSousService($this);
        }

        return $this;
    }

    public function removeCommand(Command $command): self
    {
        if ($this->commands->removeElement($command)) {
            // set the owning side to null (unless already changed)
            if ($command->getIdSousService() === $this) {
                $command->setIdSousService(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

}
