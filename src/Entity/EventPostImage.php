<?php

namespace App\Entity;

use App\Repository\EventPostImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventPostImageRepository::class)
 */
class EventPostImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=EventPost::class, inversedBy="eventPostImages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eventPost;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventPost(): ?EventPost
    {
        return $this->eventPost;
    }

    public function setEventPost(?EventPost $eventPost): self
    {
        $this->eventPost = $eventPost;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
