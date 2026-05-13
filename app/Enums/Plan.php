<?php

namespace App\Enums;

enum Plan: string
{
    case Free = 'free';
    case Pro = 'pro';
    case Business = 'business';

    public function label(): string
    {
        return (string) config("billing.plans.{$this->value}.name", ucfirst($this->value));
    }

    public function isPaid(): bool
    {
        return $this !== self::Free;
    }

    public function stripePrice(): ?string
    {
        return config("billing.plans.{$this->value}.stripe_price");
    }

    /** Look up the matching plan by Stripe price ID, falling back to Free. */
    public static function fromStripePrice(?string $priceId): self
    {
        if ($priceId === null) {
            return self::Free;
        }
        foreach (self::cases() as $plan) {
            if ($plan->stripePrice() === $priceId) {
                return $plan;
            }
        }
        return self::Free;
    }
}
