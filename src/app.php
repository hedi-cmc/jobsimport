<?php

/************************************
Entry point of the project.
To be run from the command line.
************************************/

require_once(__DIR__.'/utils.php');

require_once 'autoloader.php';

use Domain\Job\JobsImporter;
use Domain\Job\JobsLister;

printMessage("Starting...");


/* import jobs from regionsjob.xml */
$jobsImporter = new JobsImporter();
$count = $jobsImporter->importJobs();

printMessage("> {count} jobs imported.", ['{count}' => $count]);


/* list jobs */
$jobsLister = new JobsLister();
$jobs = $jobsLister->listJobs();

printMessage("> all jobs ({count}):", ['{count}' => count($jobs)]);
foreach ($jobs as $job) {
    printMessage(" {id}: {reference} - {title} - {publication}", [
    	'{id}' => $job['id'],
    	'{reference}' => $job['reference'],
    	'{title}' => $job['title'],
    	'{publication}' => $job['publication']
    ]);
}


printMessage("Terminating...");
