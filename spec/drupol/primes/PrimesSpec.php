<?php

declare(strict_types=1);

namespace spec\drupol\primes;

use ArrayIterator;
use drupol\primes\Primes;
use drupol\primes\Primes2;
use drupol\primes\Primes3;
use drupol\primes\Primes4;
use PhpSpec\ObjectBehavior;

class PrimesSpec extends ObjectBehavior
{
    public function it_can_find_prime_numbers()
    {
        $list1 = new ArrayIterator(range(2, 10000));
        $list2 = new ArrayIterator(range(2, 10000));
        $list3 = new ArrayIterator(range(2, 10000));
        $list4 = new ArrayIterator(range(2, 10000));

        $this::generator($list1)
            ->shouldIterateAs(Primes2::generator($list2));

        $this::generator($list3)
            ->shouldIterateAs(Primes3::generator($list4));

        $this::generator($list3)
            ->shouldIterateAs(Primes4::generator($list4));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Primes::class);
    }
}
