<?php

namespace App\Entity;

use App\Repository\EventPostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventPostRepository::class)
 */
class EventPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="eventPosts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="eventPost", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=EventPostImage::class, mappedBy="eventPost", orphanRemoval=true)
     */
    private $eventPostImages;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->eventPostImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setEventPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getEventPost() === $this) {
                $comment->setEventPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EventPostImage>
     */
    public function getEventPostImages(): Collection
    {
        return $this->eventPostImages;
    }

    public function addEventPostImage(EventPostImage $eventPostImage): self
    {
        if (!$this->eventPostImages->contains($eventPostImage)) {
            $this->eventPostImages[] = $eventPostImage;
            $eventPostImage->setEventPost($this);
        }

        return $this;
    }

    public function removeEventPostImage(EventPostImage $eventPostImage): self
    {
        if ($this->eventPostImages->removeElement($eventPostImage)) {
            // set the owning side to null (unless already changed)
            if ($eventPostImage->getEventPost() === $this) {
                $eventPostImage->setEventPost(null);
            }
        }

        return $this;
    }
}
