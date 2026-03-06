<?php

namespace App\Services;

use App\Models\Books;
use App\Interfaces\Reportable;
use Dompdf\Dompdf;

class Reports extends Books implements Reportable
{


    public function generateCSV()
    {
        $data = $this->getAll();

        $csv = "ID,Judul Buku,Penulis,Penerbit,Tahun,Jumlah\n";

        foreach ($data as $row) {
            $csv .= $row['id'] . "," .
                $row['title'] . "," .
                $row['author'] . "," .
                $row['publisher'] . "," .
                $row['year'] . "," .
                $row['qty'] . "\n";
        }

        $path = __DIR__ . '/../../files/laporan_buku.csv';
        file_put_contents($path, $csv);
        return $csv;
    }
    public function generateReport(bool $stream = true)
    {
        $data = $this->getAll();

        $dompdf = new Dompdf();

        $html = "<h2>Laporan Data Barang</h2>";
        $html .= "<table border='1'>
                    <tr>
                    <th>ID</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Jumlah</th>
                    </tr>";

        foreach ($data as $row) {
            $html .= "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['author'] . "</td>
                        <td>" . $row['publisher'] . "</td>
                        <td>" . $row['year'] . "</td>
                        <td>" . $row['qty'] . "</td>
                    </tr>";
        }

        $html .= "</table>";

        $dompdf->loadHtml($html);
        $dompdf->render();

        $output = $dompdf->output();

        $path = __DIR__ . '/../../files/laporan_buku.pdf';
        file_put_contents($path, $output);

        if ($stream) {
            $dompdf->stream("laporan_buku.pdf");
        }

        return $output;
    }
}
