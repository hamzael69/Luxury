<?php

namespace App\Entity;

use App\Repository\JobCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobCategoryRepository::class)]
class JobCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'jobCategory', cascade: ['persist', 'remove'])]
    private ?Candidate $candidate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCandidate(): ?Candidate
    {
        return $this->candidate;
    }

    public function setCandidate(?Candidate $candidate): static
    {
        // unset the owning side of the relation if necessary
        if ($candidate === null && $this->candidate !== null) {
            $this->candidate->setJobCategory(null);
        }

        // set the owning side of the relation if necessary
        if ($candidate !== null && $candidate->getJobCategory() !== $this) {
            $candidate->setJobCategory($this);
        }

        $this->candidate = $candidate;

        return $this;
    }
}
