<?php

namespace App\Entity;

use App\Repository\QuizzHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizzHistoryRepository::class)
 */
class QuizzHistory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="quizzHistories")
     * @ORM\JoinColumn(name="id_user", nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class)
     * @ORM\JoinColumn(name="id_categorie", nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfQuestions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $datePassed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getNumberOfQuestions(): ?int
    {
        return $this->numberOfQuestions;
    }

    public function setNumberOfQuestions(int $numberOfQuestions): self
    {
        $this->numberOfQuestions = $numberOfQuestions;

        return $this;
    }

    public function getDatePassed(): ?string
    {
        return $this->datePassed;
    }

    public function setDatePassed(string $datePassed): self
    {
        $this->datePassed = $datePassed;

        return $this;
    }

}
