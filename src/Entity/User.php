<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    use Traits\IdTrait;
    use Traits\NameTrait;
    use Traits\ScoreTrait;

    const AGREEMENT_SCORE = 4; //bad way

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[Assert\Length(exactly: 9)]
    #[ORM\Column(length: 9)]
    private ?string $phone = null;

    #[Assert\Email]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?bool $agreement = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(referencedColumnName: 'id', nullable: false)]
    private ?Education $education = null;

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function isAgreement(): ?bool
    {
        return $this->agreement;
    }

    public function setAgreement(bool $agreement): self
    {
        $this->agreement = $agreement;

        return $this;
    }

    public function getEducation(): ?Education
    {
        return $this->education;
    }

    public function setEducation(?Education $education): self
    {
        $this->education = $education;

        return $this;
    }

    public function getEmailDomain(): string
    {
        $domain = substr($this->email, strpos($this->email, '@') + 1);

        return substr($domain, 0, strrpos($domain, '.') ?: null);
    }

    public function getMobileOperatorCode(): string
    {
        return substr($this->phone, 0, 2);
    }

    public function getFullPhone(): string
    {
        return '+79' . $this->phone;
    }
}
