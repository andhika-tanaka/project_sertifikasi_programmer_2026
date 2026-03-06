<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Services\Reports;
use Config\Conf;

final class ReportsTest extends TestCase
{
    private Reports $reports;
    private \mysqli $conn;

    protected function setUp(): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';

        $config       = new Conf();
        $this->conn   = $config->connect();
        $this->conn->begin_transaction();
        $this->reports = new Reports($this->conn);

        @mkdir(__DIR__ . '/../files', 0755, true);
    }

    protected function tearDown(): void
    {
        $this->conn->rollback();
        $this->conn->close();
        @unlink(__DIR__ . '/../files/laporan_buku.csv');
        @unlink(__DIR__ . '/../files/laporan_buku.pdf');
    }

    public function testGenerateCSV(): void
    {
        $this->reports->insert('CSV Judul','CSV Author','CSV Publ',2000,1);
        $csv = $this->reports->generateCSV();

        $this->assertStringContainsString('ID,Judul Buku,Penulis', $csv);
        $this->assertStringContainsString('CSV Judul', $csv);

        $path = __DIR__ . '/../files/laporan_buku.csv';
        $this->assertFileExists($path);
        $this->assertStringEqualsFile($path, $csv);
    }

    public function testGenerateReport(): void
    {
        // prepare a record so there is something to render
        $this->reports->insert('PDF Judul', 'PDF Author', 'PDF Publ', 2021, 2);

        // generate report and capture output
        // disable streaming in tests so headers are not sent unexpectedly
        $pdf = $this->reports->generateReport(false);

        // basic sanity checks on the PDF content and file
        $this->assertStringStartsWith('%PDF', $pdf);
        $this->assertGreaterThan(100, strlen($pdf), 'PDF output should be non‑empty');

        $path = __DIR__ . '/../files/laporan_buku.pdf';
        $this->assertFileExists($path);
        $this->assertStringEqualsFile($path, $pdf);
    }
}