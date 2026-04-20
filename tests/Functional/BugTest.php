<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Factory\ArtistFactory;
use App\Tests\Factory\ReleaseFactory;
use App\Tests\Factory\ReleaseTrackArtistFactory;
use App\Tests\Factory\ReleaseTrackFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;

class BugTest extends KernelTestCase
{
    use Factories;

    protected function setUp(): void
    {
        parent::setUp();
        static::bootKernel();
    }

    public function test_it_fails(): void
    {
        $release = ReleaseFactory::new()->create();

        $artist = ArtistFactory::new()->create();

        $track = ReleaseTrackFactory::new(['release' => $release])->create();

        ReleaseTrackArtistFactory::new()->withTrack($track)->withArtist($artist)->create();

        $track->_refresh();

        self::assertTrue(true);
    }
}
