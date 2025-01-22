<?php

namespace App\Factory;

use App\Entity\PromotionCode;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<PromotionCode>
 */
final class PromotionCodeFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return PromotionCode::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        $code = "#";
        $code .= self::faker()->regexify('[A-Z]{4}[0-9]{3}[A-Z]{2}');

        $rate = self::faker()->numberBetween(0, 100);
        while (($rate % 5) !== 0) {
            $rate = self::faker()->numberBetween(0, 100);
        }
        
        return [
            'code' => $code,
            'productName' => self::faker()->word(),
            'rate' => $rate,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(PromotionCode $promotionCode): void {})
        ;
    }
}
