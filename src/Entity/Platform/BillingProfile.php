<?php

namespace App\Entity\Platform;

use App\Repository\Platform\BillingProfileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillingProfileRepository::class)]
class BillingProfile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $zip = null;

    #[ORM\Column(length: 64)]
    private ?string $settlement = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $vat = null;

    #[ORM\Column(length: 16, nullable: true)]
    private ?string $euVat = null;

    #[ORM\Column(length: 128, nullable: true)]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getZip(): ?int
    {
        return $this->zip;
    }

    public function setZip(int $zip): static
    {
        $this->zip = $zip;

        return $this;
    }

    public function getSettlement(): ?string
    {
        return $this->settlement;
    }

    public function setSettlement(string $settlement): static
    {
        $this->settlement = $settlement;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getVat(): ?string
    {
        return $this->vat;
    }

    public function setVat(?string $vat): static
    {
        $this->vat = $vat;

        return $this;
    }

    public function getEuVat(): ?string
    {
        return $this->euVat;
    }

    public function setEuVat(?string $euVat): static
    {
        $this->euVat = $euVat;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }
}
