<?php

class Ticket
{
    private int $id;
    private string $title;
    private string $description;
    private DateTime $creationDate;
    private DateTime $closingDate;
    private TicketState $state;
    private string $mail;
    private string $name;

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param DateTime $creationDate
     * @param DateTime $closingDate
     * @param TicketState $state
     * @param string $mail
     * @param string $name
     */
    public function __construct(int $id, string $title, string $description, DateTime $creationDate, DateTime $closingDate, TicketState $state, string $mail, string $name)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->creationDate = $creationDate;
        $this->closingDate = $closingDate;
        $this->state = $state;
        $this->mail = $mail;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }

    public function getClosingDate(): DateTime
    {
        return $this->closingDate;
    }

    public function setClosingDate(DateTime $closingDate): void
    {
        $this->closingDate = $closingDate;
    }

    public function getState(): TicketState
    {
        return $this->state;
    }

    public function setState(TicketState $state): void
    {
        $this->state = $state;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}

enum TicketState
{
    case Open;
    case Validated;
    case InProgress;
    case Closed;
}