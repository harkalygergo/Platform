<?php

namespace App\Entity\Platform;

use App\Repository\Platform\InstanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstanceRepository::class)]
class Instance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 8)]
    private int $status = 0;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $intranet = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private $updatedAt;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'instances')]
    private Collection $users;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'ownInstances')]
    #[ORM\JoinColumn(nullable: true, options: ['default' => null])]
    private ?User $owner = null;

    /**
     * @var Collection<int, Service>
     */
    #[ORM\OneToMany(targetEntity: Service::class, mappedBy: 'service', orphanRemoval: true, cascade: ['persist'])]
    #[ORM\OrderBy(['createdAt' => 'DESC'])]
    private Collection $services;

    #[ORM\ManyToMany(targetEntity: BillingProfile::class, inversedBy: 'instances')]
    private Collection $billingProfiles;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->users = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->billingProfiles = new ArrayCollection();
    }

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

    public function getIntranet(): ?string
    {
        return $this->intranet;
    }

    public function setIntranet(?string $intranet): static
    {
        $this->intranet = $intranet;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addInstance($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeInstance($this);
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): void
    {
        $this->owner = $owner;
    }

    public function getServices(): Collection
    {
        return $this->services;
    }

    public function setServices(Collection $services): void
    {
        $this->services = $services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->setInstance($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getInstance() === $this) {
                $service->setInstance(null);
            }
        }

        return $this;
    }

    public function getBillingProfiles(): Collection
    {
        return $this->billingProfiles;
    }

    public function addBillingProfile(BillingProfile $billingProfile): self
    {
        if (!$this->billingProfiles->contains($billingProfile)) {
            $this->billingProfiles->add($billingProfile);
            $billingProfile->addInstance($this);
        }

        return $this;
    }

    public function removeBillingProfile(BillingProfile $billingProfile): self
    {
        if ($this->billingProfiles->removeElement($billingProfile)) {
            $billingProfile->removeInstance($this);
        }

        return $this;
    }

    public function setBillingProfiles(Collection $billingProfiles): void
    {
        $this->billingProfiles = $billingProfiles;
    }
}
