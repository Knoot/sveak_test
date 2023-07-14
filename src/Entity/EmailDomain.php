<?php

namespace App\Entity;

use App\Repository\EmailDomainRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmailDomainRepository::class)]
class EmailDomain
{
    use Traits\IdTrait;
    use Traits\NameTrait;
    use Traits\ScoreTrait;

    const DEFAULT_SCORE = 3; //bad way
}
