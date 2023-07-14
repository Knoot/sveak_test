<?php

namespace App\Entity;

use App\Repository\MobileOperatorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MobileOperatorRepository::class)]
class MobileOperator
{
    use Traits\IdTrait;
    use Traits\SlugTrait;
    use Traits\NameTrait;

    #[ORM\Column(length: 2)]
    private ?string $code = null;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
