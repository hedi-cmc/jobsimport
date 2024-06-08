<?php

namespace Domain\Import;

class JSONImportStrategy extends ImportStrategy implements ImportStrategyInterface
{
    public function importData($data): int
    {
        $json = json_decode($data, true);

        $url_prefix = $json['offerUrlPrefix'];

        /* import each item */
        $count = 0;
        $stmt = $this->db->prepare("
            INSERT INTO job (reference, title, description, url, company_name, publication) VALUES (:reference, :title, :description, :url, :company_name, :publication)
        ");
        foreach ($json['offers'] as $item) {
            $date_time = \DateTime::createFromFormat('D M d H:i:s e Y', $item['publishedDate']);
            $formatted_date = $date_time->format('Y-m-d H:i:s');
            $stmt->execute([
                ':reference' => (string) $item['reference'],
                ':title' => (string) $item['title'],
                ':description' => (string) $item['description'],
                ':url' => (string) $url_prefix.$item['urlPath'],
                ':company_name' => (string) $item['companyname'],
                ':publication' => (string) $formatted_date,
            ]);
            $count++;
        }
        return $count;
    }
}