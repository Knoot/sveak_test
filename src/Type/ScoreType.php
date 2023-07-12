<?php
namespace App\Type;

class ScoreType extends EnumType
{
    protected $name = 'enumScore';
    protected $values = [
        'education',
        'mobileOperator',
        'emailDomain',
        'agreement',
    ];
}

\Doctrine\DBAL\Types\Type::addType('enumScore', 'App\Type\ScoreType');
