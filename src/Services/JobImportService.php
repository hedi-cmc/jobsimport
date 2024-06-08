<?php

namespace Services;

use Domain\Import\XMLImportStrategy;
use Domain\Import\JSONImportStrategy;
use Domain\Import\ImportContext;

class JobImportService
{

    private string $file;
    private string $dataSourceType;

    public function __construct(string $file, string $dataSourceType)
    {
        $this->file = $file;
        $this->dataSourceType = $dataSourceType;
    }

    public function run()
    {
        $dataSourceType = $this->dataSourceType;
        $data = file_get_contents($this->file);

        $context = new ImportContext();

        switch ($dataSourceType) {
            case 'xml':
                $context->setStrategy(new XMLImportStrategy());
                break;
            case 'json':
                $context->setStrategy(new JSONImportStrategy());
                break;
            default:
                throw new Exception('Unknown data source type');
        }

        return $context->importData($data);
    }
}