<?php

namespace App\DataFixtures;

use App\Entity\RecipeCatalog;
use App\Factory\RecipeCatalogFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private static function fillCatalogLevel(?RecipeCatalog $parent, int $depth, int $minItems, int $maxItems)
    {
        if ($depth <= 0) {
            return;
        }

        /** @var array<RecipeCatalog> $levelItems */
        $levelItems = [];
        $numItems = rand($minItems, $maxItems);

        for ($i = 0; $i < $numItems; $i++) {
            $levelItems[] = RecipeCatalogFactory::createOne(['parent' => $parent, 'type' => RecipeCatalog\CategoryTypeEnum::random()->value]);
        }

        foreach ($levelItems as $levelItem) {
            if ($levelItem->getType() === RecipeCatalog\CategoryTypeEnum::CONTAINER->value) {
                self::fillCatalogLevel($levelItem->object(), $depth - 1, $minItems, $minItems);
            }
        }
    }

    public function load(ObjectManager $manager): void
    {
        $depth = 3;
        $minItems = 5;
        $maxItems = 8;

        self::fillCatalogLevel(null, $depth, $minItems, $maxItems);

        $manager->flush();
    }
}
