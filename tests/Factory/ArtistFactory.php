<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\Artist;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Artist>
 */
final class ArtistFactory extends PersistentObjectFactory
{
    public static function class(): string
    {
        return Artist::class;
    }


    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->name(),
        ];
    }
}
