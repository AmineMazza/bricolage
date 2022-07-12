<?php

namespace App\Entity;

use App\Repository\BricoleursMinuisiersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BricoleursMinuisiersRepository::class)]
class BricoleursMinuisiers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'string', length: 255)]
    private $Last_name;

    #[ORM\Column(type: 'string', length: 255)]
    private $Phone;

    #[ORM\Column(type: 'string', length: 255)]
    private $Job;

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

    public function getLastName(): ?string
    {
        return $this->Last_name;
    }

    public function setLastName(string $Last_name): self
    {
        $this->Last_name = $Last_name;

        return $this;
    }



    public function getJob(): ?string
    {
        return $this->Job;
    }

    public function setJob(string $Job): self
    {
        $this->Job = $Job;

        return $this;
    }
	/**
	 * @return mixed
	 */
	function getPhone() {
		return $this->Phone;
	}
	
	/**
	 * @param mixed $Phone 
	 * @return BricoleursMinuisiers
	 */
	function setPhone($Phone): self {
		$this->Phone = $Phone;
		return $this;
	}
}
