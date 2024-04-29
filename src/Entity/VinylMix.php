<?php

namespace App\Entity;

use App\Repository\VinylMixRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\String_;

#[ORM\Entity(repositoryClass: VinylMixRepository::class)]
class VinylMix
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $trackCount = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column]
    private int $Vote = 0;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTrackCount(): ?int
    {
        return $this->trackCount;
    }

    public function setTrackCount(int $trackCount): static
    {
        $this->trackCount = $trackCount;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getVote(): ?int
    {
        return $this->Vote;
    }

    public function setVote(int $Vote): static
    {
        $this->Vote = $Vote;

        return $this;
    }

    public function getVotesString(): String
    {
        $prefix = ($this->Vote >= 0) ? '+' : '-';
        return sprintf('%s %d', $prefix, abs($this->Vote));
    }

    public function getImageUrl(int $width): string
    {
        return sprintf(
            'https://picsum.photos/id/%d/%d',
            ($this->getId() + 50) % 1000,
            $width
        );
    }
}
