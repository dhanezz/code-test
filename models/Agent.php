<?php
require_once 'core/BaseClass.php';

class Agent extends BaseClass
{

    public string $accountId;
    public string $symbol;
    public string $headquarters;
    public string $credits;
    public string $startingFaction;
    public string $shipCount;

    public function __construct(array $data)
    {
        $this->mapToClass($data);
    }

    public function getSystemSymbol(): string
    {
        $waypointArray = explode('-', $this->headquarters);
        array_pop($waypointArray);
        return implode('-', $waypointArray);
    }

    public function getWaypointSystem(): string
    {
        $waypointArray = explode('-', $this->headquarters);
        return end($waypointArray);
    }

    // GETTERS AND SETTERS

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getHeadquarters(): string
    {
        return $this->headquarters;
    }

    public function getCredits(): string
    {
        return $this->credits;
    }

    public function getStartingFaction(): string
    {
        return $this->startingFaction;
    }

    public function getShipCount(): string
    {
        return $this->shipCount;
    }

    public function setAccountId(string $accountId): void
    {
        $this->accountId = $accountId;
    }

    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }

    public function setHeadquarters(string $headquarters): void
    {
        $this->headquarters = $headquarters;
    }

    public function setCredits(string $credits): void
    {
        $this->credits = $credits;
    }

    public function setStartingFaction(string $startingFaction): void
    {
        $this->startingFaction = $startingFaction;
    }

    public function setShipCount(string $shipCount): void
    {
        $this->shipCount = $shipCount;
    }
}
