<?php
class TicketState
{
    private ?int $id;
    private string $state;

    public function __construct(?int $id, string $state)
    {
        $this->id = $id;
        $this->state = $state;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }
}