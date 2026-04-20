<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'release_track_artists')]
#[ORM\Entity]
class ReleaseTrackArtist
{

    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private int $id;

    #[ORM\Column(name: 'position', type: 'smallint', nullable: false)]
    private int $position;

    #[ORM\ManyToOne(targetEntity: Release::class, inversedBy: 'artists')]
    #[ORM\JoinColumn(name: 'release_id', nullable: false)]
    private Release $release;

    #[ORM\ManyToOne(targetEntity: ReleaseTrack::class, inversedBy: 'artists')]
    #[ORM\JoinColumn(name: 'release_track_id', nullable: false)]
    private ReleaseTrack $track;

    #[ORM\ManyToOne(targetEntity: Artist::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Artist $artist;

    public function __construct(Artist $artist, ReleaseTrack $track, int $position)
    {
        $this->artist = $artist;
        $this->position = $position;
        $this->track = $track;
        $this->release = $track->getRelease();
    }
}
