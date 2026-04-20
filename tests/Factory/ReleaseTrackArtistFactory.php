<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\Artist;
use App\Entity\ReleaseTrack;
use App\Entity\ReleaseTrackArtist;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<ReleaseTrackArtist>
 */
final class ReleaseTrackArtistFactory extends PersistentObjectFactory
{
    public function withTrack(object $track): self
    {
        return $this->with([
            'track' => $track,
            'release' => $track->getRelease(),
        ]);
    }

    public function withArtist(object $artist): self
    {
        return $this->with([
            'artist' => $artist,
        ]);
    }

    public static function class(): string
    {
        return ReleaseTrackArtist::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'position' => 1,
        ];
    }
}
