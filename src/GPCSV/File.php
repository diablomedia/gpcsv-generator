<?php declare(strict_types=1);

namespace GPCSV;

use GPCSV\Payment;

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

    public function __toString(): string
    {
        $csvBody = '';
        foreach ($this->payments as $payment) {
            $csvBody .= (string)$payment . "\n";
        }

        return $csvBody;
    }
}
