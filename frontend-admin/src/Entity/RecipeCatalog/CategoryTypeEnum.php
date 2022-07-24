<?php

namespace App\Entity\RecipeCatalog;

enum CategoryTypeEnum: string
{
    case CONTAINER = 'container';
    case RECIPE = 'recipe';

    static public function random(): self
    {
        return self::cases()[array_rand(self::cases())];
    }
}