<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait ScoreTrait
{
    #[ORM\Column]
    private ?int $score = null;

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }
}
