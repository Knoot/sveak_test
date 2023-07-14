<?php

namespace App\DataFixtures;

use App\Entity\MobileOperator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MobileOperatorFixtures extends Fixture
{
    public static $mobileOperators = [
        'МегаФон' => [
            '25',
            '26',
            '29',
            '36',
            '99',
        ],
        'Билайн'  => [
            '03',
            '05',
            '06',
            '09',
            '62',
            '63',
            '64',
            '65',
            '66',
            '67',
            '68',
            '69',
            '80',
            '83',
            '86',
        ],
        'МТС'     => [
            '10',
            '15',
            '16',
            '17',
            '19',
            '85',
            '86',
        ],
    ];

    private $score = [
        'МегаФон' => 10,
        'Билайн' => 5,
        'МТС' => 3,
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::$mobileOperators as $name => $codes) {
            foreach ($codes as $code) {
                $education = new MobileOperator();
                $education
                    ->setName($name)
                    ->setCode($code)
                    ->setScore($this->score[$name])
                ;
    
                $manager->persist($education);
            }
        }

        $manager->flush();
    }
}
