<?php

namespace App\Factory;

use App\Entity\Car;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Car>
 */
final class CarFactory extends PersistentProxyObjectFactory
{

    public function __construct()
    {
    }

    public static function class(): string
    {
        return Car::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'day_price' => self::faker()->randomFloat(2,50,120),
            'description' => self::faker()->text(),
            'gearbox' => 'Automatique',
            'month_price' => self::faker()->randomFloat(2,500,1500),
            'name' => self::faker()->text(255),
            'seat' => self::faker()->numberBetween(1,5),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Car $car): void {})
        ;
    }
}
