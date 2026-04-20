<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'releases')]
#[ORM\Entity]
class Release
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'integer', nullable: false, options: ['unsigned' => true])]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    private ?int $id = null;

    /**
     * @var Collection<int, ReleaseArtist>
     */
    #[ORM\OneToMany(targetEntity: ReleaseArtist::class, mappedBy: 'release', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $artists;

    /**
     * @var Collection<int, ReleaseTrack>
     */
    #[ORM\OneToMany(targetEntity: ReleaseTrack::class, mappedBy: 'release', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $tracks;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->tracks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
