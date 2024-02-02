<?php

class Ticket
{
    private int $id;
    private TicketState $ticketState;
    private Customer $customer;
    private Employee $employee;
    private string $title;
    private string $description;
    private DateTime $creationDate;
    private DateTime $closingDate;


    /**
     * @param ?int $id
     * @param TicketState $ticketState
     * @param Customer $customer
     * @param Employee $employee
     * @param string $title
     * @param string $description
     * @param DateTime $creationDate
     * @param DateTime $closingDate
     */
    public function __construct(?int $id, TicketState $ticketState, Customer $customer, Employee $employee, string $title, string $description, DateTime $creationDate, DateTime $closingDate)
    {
        $this->id = $id;
        $this->ticketState = $ticketState;
        $this->customer = $customer;
        $this->employee = $employee;
        $this->title = $title;
        $this->description = $description;
        $this->creationDate = $creationDate;
        $this->closingDate = $closingDate;
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