<?php 

namespace Domain\Import;

interface ImportStrategyInterface {
    public function importData($data);
}