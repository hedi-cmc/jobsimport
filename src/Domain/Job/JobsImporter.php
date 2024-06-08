<?php

declare(strict_types=1);

namespace Domain\Job;

use Config\Config;
use Services\JobImportService;

final class JobsImporter
{
    
    public function importJobs()
    {
        $config = new Config();
        $res_dir = $config->ressources_dir;
        if (!is_dir($res_dir)) {
            throw new \InvalidArgumentException('Invalid resources directory provided');
        }

        $files = scandir($res_dir);
        foreach ($files as $file) {
            if ($file === "." || $file === "..") {
                continue;
            }

            $file_path = $res_dir . $file;

            if (is_file($file_path)) {
                $info = pathinfo($file_path);
                $extension = $info['extension'];
                
                echo (new JobImportService($file_path, $extension))->run();
            }
        }
    }
}
