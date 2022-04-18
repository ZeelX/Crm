<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $entreprise;

    #[ORM\Column(type: 'string', length: 255)]
    private $mail;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private $telephone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $notePerso;

    #[ORM\ManyToOne(targetEntity: Secteur::class, inversedBy: 'clients')]
    #[ORM\JoinColumn(nullable: false)]
    private $secteur;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: ContratEnded::class)]
    private $contratEnded;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Adresse;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $codePostal;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ville;

    public function __construct()
    {
        $this->contratEnded = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNotePerso(): ?string
    {
        return $this->notePerso;
    }

    public function setNotePerso(?string $notePerso): self
    {
        $this->notePerso = $notePerso;

        return $this;
    }

    public function getSecteur(): ?Secteur
    {
        return $this->secteur;
    }

    public function setSecteur(?Secteur $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * @return Collection<int, ContratEnded>
     */
    public function getContratEnded(): Collection
    {
        return $this->contratEnded;
    }

    public function addContratEnded(ContratEnded $contratEnded): self
    {
        if (!$this->contratEnded->contains($contratEnded)) {
            $this->contratEnded[] = $contratEnded;
            $contratEnded->setClient($this);
        }

        return $this;
    }

    public function removeContratEnded(ContratEnded $contratEnded): self
    {
        if ($this->contratEnded->removeElement($contratEnded)) {
            // set the owning side to null (unless already changed)
            if ($contratEnded->getClient() === $this) {
                $contratEnded->setClient(null);
            }
        }

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

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

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
}
