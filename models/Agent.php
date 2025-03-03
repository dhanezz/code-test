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
    public array $startingLocation;
    public array $contracts;

    public function getSystemSymbol(): string
    {
        $waypointArray = explode('-', $this->headquarters);
        array_pop($waypointArray);
        return implode('-', $waypointArray);
    }

    public function getWaypointSystem(): string
    {
        return $this->headquarters;
    }

    public function getCurrentLocation(string $symbol): string
    {
        if ($symbol == $this->headquarters) return "Headquarters ($symbol)";
        return $symbol;
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

    public function getStartingLocation(): array
    {
        return $this->startingLocation;
    }

    public function getContracts(): array
    {
        return $this->contracts;
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

    public function setStartingLocation(array $startingLocation): void
    {
        $this->startingLocation = $startingLocation;
    }

    public function setContracts(array $contracts): void
    {
        $this->contracts = $contracts;
    }
}
