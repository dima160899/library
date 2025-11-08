<?php

namespace App\Entity;

use App\Repository\ReadingProgressRepository;
use Cassandra\UuidInterface;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ReadingProgressRepository::class)]
class ReadingProgress
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME)]
    private Uuid $id;

    #[ORM\Column]
    private int $percent;

    #[ORM\Column(nullable: true)]
    private ?int $currentPage = null;

    #[ORM\Column(nullable: true)]
    private ?int $countOfPages = null;

    #[ORM\OneToOne(inversedBy: 'progress', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Book $book;

    #[ORM\Column]
    private DateTimeImmutable $updatedAt;

    public function __construct(
        Uuid $id,
        Book $bookId,
    ) {
        $this->id = $id;
        $this->book = $bookId;
        $this->percent = 0;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getPercent(): int
    {
        return $this->percent;
    }

    public function setPercent(int $percent): self
    {
        $this->percent = $percent;

        return $this;
    }

    public function getCurrentPage(): ?int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(?int $currentPage): self
    {
        $this->currentPage = $currentPage;

        return $this;
    }

    public function getCountOfPages(): ?int
    {
        return $this->countOfPages;
    }

    public function setCountOfPages(?int $countOfPages): self
    {
        $this->countOfPages = $countOfPages;

        return $this;
    }

    public function getBook(): Book
    {
        return $this->book;
    }

    public function setBook(Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
