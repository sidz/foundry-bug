<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'release_tracks')]
#[ORM\Entity]
class ReleaseTrack
{
    #[ORM\Column(name: 'id', type: 'integer', nullable: false, options: ['unsigned' => true])]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Release::class, inversedBy: 'tracks')]
    #[ORM\JoinColumn(name: 'release_id', nullable: false)]
    private Release $release;

    /**
     * @var Collection<int, ReleaseTrackArtist>
     */
    #[ORM\OneToMany(mappedBy: 'track', targetEntity: ReleaseTrackArtist::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $artists;

    private function __construct()
    {
        $this->artists = new ArrayCollection();
    }

    public function getRelease(): Release
    {
        return $this->release;
    }
}
