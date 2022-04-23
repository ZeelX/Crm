<?php

namespace App\Entity;


use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PropertyAccess\PropertyAccess;

#[ORM\Entity(repositoryClass: ContratRepository::class)]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $finishedAt;

    #[ORM\Column(type: 'text')]
    private $mission;

    #[ORM\Column(type: 'text', nullable: true)]
    private $noteperso;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'contrat')]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    /**
     * @param $id
     */
    public function __construct()
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()
            ->enableMagicCall()
            ->getPropertyAccessor();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFinishedAt(): ?\DateTimeInterface
    {
        return $this->finishedAt;
    }

    public function setFinishedAt(\DateTimeInterface $finishedAt): self
    {
        $this->finishedAt = $finishedAt;

        return $this;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(string $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getNoteperso(): ?string
    {
        return $this->noteperso;
    }

    public function setNoteperso(?string $noteperso): self
    {
        $this->noteperso = $noteperso;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function __call($name, $args)
    {
        $property = lcfirst(substr($name, 3));
        if (str_starts_with($name, 'get')) {
            return $this->children[$property] ?? null;
        } elseif (str_starts_with($name, 'set')) {
            $value = 1 == count($args) ? $args[0] : null;
            $this->children[$property] = $value;
        }
    }


}
