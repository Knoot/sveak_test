<?php

namespace App\DataFixtures;

use App\Entity\Education;
use App\Entity\EmailDomain;
use App\Entity\User;
use App\Service\ScoreService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{

    public function __construct(private ScoreService $scoreService)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $count               = 20;
        $fakerEng            = Factory::create();
        $faker               = Factory::create('ru_RU');
        $educations          = $manager->getRepository(Education::class)->findAll();
        $emailDomains        = $manager->getRepository(EmailDomain::class)->findAll();
        $mobileOperatorCodes = array_reduce(
            array_values(MobileOperatorFixtures::$mobileOperators),
            fn(array $acc, array $codes) => array_merge($acc, $codes),
            []
        );

        for ($i = 0; $i < $count; $i++) {
            $phone = ($faker->boolean(25)
                ? sprintf("%02d", rand(0, 99))
                : $mobileOperatorCodes[array_rand($mobileOperatorCodes)]
            ) . '00000' . sprintf("%02d", $i);

            $email = ($faker->boolean(25)
                ? $faker->email
                : $fakerEng->firstName . '@' . $emailDomains[array_rand($emailDomains)]->getName() . '.ru'
            );

            $user = new User();
            $user
                ->setName($faker->firstName)
                ->setSurname($faker->lastName)
                ->setEmail($email)
                ->setPhone($phone)
                ->setAgreement($faker->boolean(70))
                ->setEducation($faker->randomElement($educations))
            ;
            $user->setScore($this->scoreService->calculateScore($user));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
