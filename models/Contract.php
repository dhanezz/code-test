<?php
require_once 'core/BaseClass.php';
require_once 'core/Utilities.php';

class Contract extends BaseClass
{
    public string $id;
    public string $fractionSymbol;
    public string $type;
    public array $terms;
    public bool $accepted;
    public bool $fulfilled;
    public DateTime $expiration;
    public DateTime $deadlineToAccept;

    public function renderContractHTML(int $contractNumber = 0): string
    {

        $buttonsHTML = "";

        if ($this->isExpired()) {
            $buttonsHTML =  "<input type='hidden' name='action' value='negotiate_contract'><button class='btn btn-light' type=>Negotiate Contract</button>";
        } else if (!$this->accepted) {
            $buttonsHTML = "<input type='hidden' name='action' value='accept_contract'><button type='submit' class='btn btn-warning'>Accept</button>";
        }

        // NOTE: Backticks and Single-Comma can't/shouldn't be used for string interpolation PHP 8 is stricter;

        return "<div class='accordion-item'>
                            <h2 class='accordion-header'>
                                <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#contract$contractNumber' aria-expanded='true' aria-controls='contract$contractNumber'>
                                    <div class='container-fluid d-flex flex-row justify-content-between'>
                                        <span>
                                            Contract #$contractNumber
                                        </span>
                                        {$this->renderContractBadgeHTML()}
                                    </div>
                                </button>
                            </h2>
                            <div id='collapseOne' class='accordion-collapse collapse show' data-bs-parent='#accordionExample'>
                                <div class='accordion-body'>
                                    <small>Type: {$this->type}</small>
                                    {$this->renderContractTermsHTML()}
                                    <hr>
                                    <div class='contract-buttons d-flex justify-content-end'>
                                    <form method='POST' action='?page=cockpit'>
                                    <input type='hidden' name='contract_id' value='{$this->id}'>

                                        $buttonsHTML
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>";
    }

    public function isExpired(): bool
    {
        return $this->expiration < new DateTime();
    }

    public function renderContractBadgeHTML(): string
    {
        $isExpired = $this->isExpired();
        $badgeHTML = "";

        if (!$this->accepted) {
            $badgeHTML .= "<span class='badge rounded-pill text-bg-secondary me-2'>{$this->countDeadlineToAccept()}</span>";
        } elseif ($this->accepted && $this->fulfilled) {
            $deadline = formatToHumanDateTime($this->terms['deadline']);
            $badgeHTML .= "<span class='badge rounded-pill text-bg-warning me-2'>ONGOING DEADLING $deadline</span>";
        } elseif ($this->accepted && !$this->fulfilled && $isExpired) {
            $badgeHTML .= "<span class='badge rounded-pill text-bg-danger me-2'>EXPIRED</span>";
        } elseif ($this->accepted && $this->fulfilled && !$isExpired) {
            $badgeHTML .= "<span class='badge rounded-pill text-bg-success me-2'>DELIVERED</span>";
        }

        return $badgeHTML;
    }

    public function countDeadlineToAccept(): string
    {
        return (new DateTime())->diff($this->deadlineToAccept)->format("%H:%I:%S (Full days: %a)") . "";
    }

    public function renderContractTermsHTML(): string
    {
        $deadlineDate = formatToHumanDateTime($this->terms['deadline']);
        $paymentOnAccepted = formatToCurrency($this->terms['payment']['onAccepted']);
        $paymentOnFulfilled = formatToCurrency($this->terms['payment']['onFulfilled']);

        $sumPayment = formatToCurrency(($this->terms['payment']['onAccepted'] + $this->terms['payment']['onFulfilled']));

        $acceptedRowClass = $this->accepted ? 'table-success' : 'table-warning';
        $fulfilledRowClass = $this->fulfilled ? 'table-success' : 'table-warning';

        return "
            <p>Deadline: $deadlineDate</p>
            <table class='table table-sm'>
                <tr>
                    <th scope='row'>Payment</th>
                </tr>
                <tr class='$acceptedRowClass'>
                    <td>Contract accepted</td>
                    <td>$paymentOnAccepted</td>
                </tr>
                <tr class='$fulfilledRowClass'>
                    <td>Contract fulfilled</td>
                    <td>$paymentOnFulfilled</td>
                </tr>
                <tr>
                    <th scope='row'>Summe</th>
                    <td>$sumPayment</td>
                </tr>
            </table>" . $this->renderDeliveryHTML();
    }

    public function renderDeliveryHTML(): string
    {
        $deliveryHTML = "<hr>
            <h3>Deliver</h3>";
        foreach ($this->terms['deliver'] as $deliverItem) {

            $tradeSymbol = $deliverItem['tradeSymbol'];
            $destinationSymbol =  $deliverItem['destinationSymbol'];
            $unitsRequired =  $deliverItem['unitsRequired'];
            $unitsFulfilled =  $deliverItem['unitsFulfilled'];
            $columnColor = '';

            if ($this->accepted) {
                if ($unitsFulfilled < $unitsRequired) {
                    $columnColor = 'table-warning';
                } else {
                    $columnColor = 'table-success';
                }
            }

            $deliveryHTML .= "<table class='table table-sm'>
                <tr>
                    <th scope='row'>Trade</th>
                    <td>$tradeSymbol</td>
                </tr>
                <tr>
                    <td>Destination</td>
                    <td>$destinationSymbol</td>
                </tr>
                <tr>
                    <th>Units Required</th>
                    <th>Units Fulfilled</th>
                </tr>
                <tr>
                    <th>$unitsRequired</th>
                    <td class='$columnColor'>$unitsFulfilled</td>
                </tr>
            </table>";
        }

        return $deliveryHTML;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getFractionSymbol(): string
    {
        return $this->fractionSymbol;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTerms(): array
    {
        return $this->terms;
    }

    public function getAccepted(): bool
    {
        return $this->accepted;
    }

    public function getFulfilled(): bool
    {
        return $this->fulfilled;
    }

    public function getExpiration(): DateTime
    {
        return $this->expiration;
    }

    public function getDeadlineToAccept(): DateTime
    {
        return $this->deadlineToAccept;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setFractionSymbol(string $fractionSymbol): void
    {
        $this->fractionSymbol = $fractionSymbol;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setTerms(array $terms): void
    {
        $this->terms = $terms;
    }

    public function setAccepted(bool $accepted): void
    {
        $this->accepted = $accepted;
    }

    public function setFulfilled(bool $fulfilled): void
    {
        $this->fulfilled = $fulfilled;
    }

    public function setExpiration(DateTime $expiration): void
    {
        $this->expiration = $expiration;
    }

    public function setDeadlineToAccept(DateTime $deadlineToAccept): void
    {
        $this->deadlineToAccept = $deadlineToAccept;
    }
}
