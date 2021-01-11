<?php

declare(strict_types=1);

namespace spec\drupol\primes;

use ArrayIterator;
use drupol\primes\Primes;
use drupol\primes\Primes2;
use drupol\primes\Primes3;
use drupol\primes\Primes4;
use Iterator;
use PhpSpec\ObjectBehavior;

class PrimesSpec extends ObjectBehavior
{
    public function it_can_find_prime_numbers()
    {
        $this::generator($this->generateInitList())
            ->shouldIterateAs(Primes2::generator($this->generateInitList()));

        $this::generator($this->generateInitList())
            ->shouldIterateAs(Primes3::generator($this->generateInitList()));

        $this::generator($this->generateInitList())
            ->shouldIterateAs(Primes4::generator($this->generateInitList()));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Primes::class);
    }

    private function generateInitList(): Iterator
    {
        $input = range(2, 10000);

        return new ArrayIterator($input);
    }
}
