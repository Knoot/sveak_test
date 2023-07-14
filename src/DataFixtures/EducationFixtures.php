<?php

namespace App\DataFixtures;

use App\Entity\Education;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EducationFixtures extends Fixture
{
    public static $educations = [
        'Высшее образование' => 15,
        'Специальное образование' => 10,
        'Среднее образование' => 5,
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::$educations as $name => $score) {
            $education = new Education();
            $education
                ->setName($name)
                ->setScore($score)
            ;

            $manager->persist($education);
        }

        $manager->flush();
    }
}
