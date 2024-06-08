<?php

namespace Domain\Import;

class ImportContext {
    private $strategy;

    public function setStrategy(ImportStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function importData($data)
    {
        $this->strategy->importData($data);
    }
}