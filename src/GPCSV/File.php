<?php declare(strict_types=1);

namespace GPCSV;

class File
{
    /**
     * @var array<Payment>
     */
    private $payments = [];
    
    public function addPayment(Payment $payment): void
    {
        $this->payments[] = $payment;
    }

    /**
     * @param array<\GPCSV\Payment> $payments
     */
    public function addPayments(array $payments): void
    {
        foreach ($payments as $payment) {
            $this->addPayment($payment);
        }
    }

    public function getCsvString(): string
    {
        $csvBody = '';
        foreach ($this->payments as $payment) {
            $csvBody .= $payment->getCsvString() . "\n";
        }

        return $csvBody;
    }
}
