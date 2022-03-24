<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=EventType::class, inversedBy="events")
     */
    private $eventType;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $eventDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $detail;

    /**
     * @ORM\OneToMany(targetEntity=EventPost::class, mappedBy="event", orphanRemoval=true)
     */
    private $eventPosts;

    /**
     * @ORM\OneToMany(targetEntity=EventImage::class, mappedBy="event", orphanRemoval=true)
     */
    private $eventImages;

    /**
     * @ORM\OneToMany(targetEntity=EventReservation::class, mappedBy="event", orphanRemoval=true)
     */
    private $eventReservations;

    public function __construct()
    {
        $this->eventPosts = new ArrayCollection();
        $this->eventImages = new ArrayCollection();
        $this->eventReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventType(): ?EventType
    {
        return $this->eventType;
    }

    public function setEventType(?EventType $eventType): self
    {
        $this->eventType = $eventType;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEventDate(): ?\DateTimeImmutable
    {
        return $this->eventDate;
    }

    public function setEventDate(\DateTimeImmutable $eventDate): self
    {
        $this->eventDate = $eventDate;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * @return Collection<int, EventPost>
     */
    public function getEventPosts(): Collection
    {
        return $this->eventPosts;
    }

    public function addEventPost(EventPost $eventPost): self
    {
        if (!$this->eventPosts->contains($eventPost)) {
            $this->eventPosts[] = $eventPost;
            $eventPost->setEvent($this);
        }

        return $this;
    }

    public function removeEventPost(EventPost $eventPost): self
    {
        if ($this->eventPosts->removeElement($eventPost)) {
            // set the owning side to null (unless already changed)
            if ($eventPost->getEvent() === $this) {
                $eventPost->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EventImage>
     */
    public function getEventImages(): Collection
    {
        return $this->eventImages;
    }

    public function addEventImage(EventImage $eventImage): self
    {
        if (!$this->eventImages->contains($eventImage)) {
            $this->eventImages[] = $eventImage;
            $eventImage->setEvent($this);
        }

        return $this;
    }

    public function removeEventImage(EventImage $eventImage): self
    {
        if ($this->eventImages->removeElement($eventImage)) {
            // set the owning side to null (unless already changed)
            if ($eventImage->getEvent() === $this) {
                $eventImage->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EventReservation>
     */
    public function getEventReservations(): Collection
    {
        return $this->eventReservations;
    }

    public function addEventReservation(EventReservation $eventReservation): self
    {
        if (!$this->eventReservations->contains($eventReservation)) {
            $this->eventReservations[] = $eventReservation;
            $eventReservation->setEvent($this);
        }

        return $this;
    }

    public function removeEventReservation(EventReservation $eventReservation): self
    {
        if ($this->eventReservations->removeElement($eventReservation)) {
            // set the owning side to null (unless already changed)
            if ($eventReservation->getEvent() === $this) {
                $eventReservation->setEvent(null);
            }
        }

        return $this;
    }
}
