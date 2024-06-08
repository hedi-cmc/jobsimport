<?php

declare(strict_types=1);

namespace Domain\Job;

class Job
{
    public function __construct(
        public string $id,
    ) {
    }
}
