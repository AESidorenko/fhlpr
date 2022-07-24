<?php

namespace App\Factory;

use App\Entity\RecipeCatalog;
use App\Repository\RecipeCatalogRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<RecipeCatalog>
 *
 * @method static RecipeCatalog|Proxy createOne(array $attributes = [])
 * @method static RecipeCatalog[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static RecipeCatalog|Proxy find(object|array|mixed $criteria)
 * @method static RecipeCatalog|Proxy findOrCreate(array $attributes)
 * @method static RecipeCatalog|Proxy first(string $sortedField = 'id')
 * @method static RecipeCatalog|Proxy last(string $sortedField = 'id')
 * @method static RecipeCatalog|Proxy random(array $attributes = [])
 * @method static RecipeCatalog|Proxy randomOrCreate(array $attributes = [])
 * @method static RecipeCatalog[]|Proxy[] all()
 * @method static RecipeCatalog[]|Proxy[] findBy(array $attributes)
 * @method static RecipeCatalog[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static RecipeCatalog[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static RecipeCatalogRepository|RepositoryProxy repository()
 * @method RecipeCatalog|Proxy create(array|callable $attributes = [])
 */
final class RecipeCatalogFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'type' => null, // TODO add APP\ENTITY\RECIPECATALOG\CATEGORYTYPEENUM ORM type manually
            'title' => self::faker()->text(25),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(RecipeCatalog $recipeCatalog): void {})
        ;
    }

    protected static function getClass(): string
    {
        return RecipeCatalog::class;
    }
}
