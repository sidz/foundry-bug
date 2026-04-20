<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\Release;
use Doctrine\Common\Collections\ArrayCollection;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Release>
 */
final class ReleaseFactory extends PersistentObjectFactory
{
    public static function class(): string
    {
        return Release::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'artists' => new ArrayCollection(),
            'tracks' => new ArrayCollection(),
        ];
    }
}
