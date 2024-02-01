<?php

class Ticket
{
    private int $id;
    private string $title;
    private string $description;
    private DateTime $creationDate;
    private DateTime $closingDate;
    private TicketState $ticketState;
    private Customer $customer;
    private Employee $employee;

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param DateTime $creationDate
     * @param DateTime $closingDate
     * @param TicketState $state
     * @param Customer $customer;
     * @param Employee $employee;
     */
    public function __construct(int $id, string $title, string $description, DateTime $creationDate, DateTime $closingDate, TicketState $ticketState, Customer $customer, Employee $employee)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->creationDate = $creationDate;
        $this->closingDate = $closingDate;
        $this->ticketState = $ticketState;
        $this->customer = customer;
        $this->employee = employee;
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

    public function getTicketState(): TicketState
    {
        return $this->ticketState;
    }

    public function setTicketState(TicketState $ticketState): void
    {
        $this->ticketState = $ticketState;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee): void
    {
        $this->employee = $employee;
    }
}