<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Services\Reports;

$report = new Reports;
$type = $_GET['type'] ?? '';

if ($type === "csv") {
    echo nl2br($report->generateCSV());
} elseif ($type === "pdf") {
    // stream the PDF to the browser, which is the default behaviour
    $report->generateReport(true);
} else {
    echo "Invalid report type";
}




