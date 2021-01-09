<?php

declare(strict_types=1);

namespace drupol\primes\benchmarks;

use drupol\primes\Iterator\ListIterator;
use drupol\primes\Primes;
use drupol\primes\Primes2;
use drupol\primes\Primes3;
use drupol\primes\Primes4;
use Iterator;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;

/**
 * @Groups({"Primes"})
 * @Iterations(10)
 * @BeforeMethods({"init"})
 * @Warmup(2)
 * @Revs(200)
 */
class PrimesBench
{
    private int $limit;

    private ListIterator $list;

    public function benchPrimes1(): void
    {
        $this->loop(Primes::generator($this->list));
    }

    public function benchPrimes2(): void
    {
        $this->loop(Primes2::generator($this->list));
    }

    public function benchPrimes3(): void
    {
        $this->loop(Primes3::generator($this->list));
    }

    public function benchPrimes4(): void
    {
        $this->loop(Primes4::generator($this->list));
    }

    public function init(): void
    {
        $this->limit = 500;
        $this->list = new ListIterator(2, static fn (int $n): int => $n + 1);
    }

    private function loop(Iterator $iterator): void
    {
        for ($i = 0; $i < $this->limit; $i++,$iterator->next()) {
        }
    }
}
