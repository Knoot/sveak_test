<?php

namespace App\Service;

use App\Entity\EmailDomain;
use App\Entity\MobileOperator;
use App\Entity\User;
use App\Repository\EducationRepository;
use App\Repository\EmailDomainRepository;
use App\Repository\MobileOperatorRepository;

class ScoreService
{
    public function __construct(
        private MobileOperatorRepository $mobileOperatorRepo,
        private EducationRepository $educationRepo,
        private EmailDomainRepository $emailDomainRepo
    ) {
    }

    public function calculateScore(User $user): int
    {
        return
            $this->getAgreementScore($user)
            + $this->getEmailDomainScore($user)
            + $this->getMobileOperatorScore($user)
            + $this->getEducationScore($user)
        ;
    }

    public function getDetail(User $user): array
    {
        return [
            'Agreement'       => $this->getAgreementScore($user),
            'Email Domain'    => $this->getEmailDomainScore($user),
            'Mobile Operator' => $this->getMobileOperatorScore($user),
            'Education'       => $this->getEducationScore($user),
        ];
    }

    private function getAgreementScore(User $user): int
    {
        return $user->isAgreement() ? User::AGREEMENT_SCORE : 0;
    }

    private function getEmailDomainScore(User $user): int
    {
        return $this->emailDomainRepo->findOneByName($user->getEmailDomain())?->getScore() ?? EmailDomain::DEFAULT_SCORE;
    }

    private function getMobileOperatorScore(User $user): int
    {
        return $this->mobileOperatorRepo->findOneByCode($user->getMobileOperatorCode())?->getScore() ?? MobileOperator::DEFAULT_SCORE;
    }

    private function getEducationScore(User $user): int
    {
        return $user->getEducation()->getScore();
    }
}
