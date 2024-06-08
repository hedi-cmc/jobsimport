<?php

namespace Domain\Import;

class XMLImportStrategy extends ImportStrategy implements ImportStrategyInterface
{
    public function importData($data): int
    {
        
        /* parse XML file */
        $xml = simplexml_load_string($data);

        /* import each item */
        $count = 0;
        $stmt = $this->db->prepare("
            INSERT INTO job (reference, title, description, url, company_name, publication) VALUES (:reference, :title, :description, :url, :company_name, :publication)
        ");
        foreach ($xml->item as $item) {
            $stmt->execute([
                ':reference' => (string) $item->ref,
                ':title' => (string) $item->title,
                ':description' => (string) $item->description,
                ':url' => (string) $item->url,
                ':company_name' => (string) $item->company,
                ':publication' => (string) $item->pubDate,
            ]);
            $count++;
        }
        return $count;
    }
}