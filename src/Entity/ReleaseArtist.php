<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'release_artists')]
#[ORM\Entity]
class ReleaseArtist
{
    #[ORM\Column(name: 'id', type: 'integer', nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private int $id;

    #[ORM\Column(name: 'position', type: 'smallint', nullable: false)]
    private int $position;

    #[ORM\ManyToOne(targetEntity: Release::class, inversedBy: 'artists')]
    #[ORM\JoinColumn(name: 'release_id', nullable: false, onDelete: 'CASCADE')]
    private Release $release;

    #[ORM\ManyToOne(targetEntity: Artist::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Artist $artist;

    public function __construct(Artist $artist, Release $release, int $position)
    {
        $this->artist = $artist;
        $this->release = $release;
        $this->position = $position;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
