<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\ReleaseTrack;
use Doctrine\Common\Collections\ArrayCollection;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<ReleaseTrack>
 */
class ReleaseTrackFactory extends PersistentObjectFactory
{
    public static function class(): string
    {
        return ReleaseTrack::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'release' => ReleaseFactory::new(),
            'artists' => new ArrayCollection(),
        ];
    }
}
