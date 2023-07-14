<?php

namespace App\DataFixtures;

use App\Entity\EmailDomain;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmailDomainFixtures extends Fixture
{
    public static $emailDomains = [
        'gmail'  => 10,
        'yandex' => 8,
        'mail'   => 6,
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::$emailDomains as $domain => $score) {
            $emailDomain = new EmailDomain();
            $emailDomain
                ->setName($domain)
                ->setScore($score)
            ;

            $manager->persist($emailDomain);
        }

        $manager->flush();
    }
}
