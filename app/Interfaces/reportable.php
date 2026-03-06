<?php

namespace App\Interfaces;

interface Reportable {
    public function generateCSV();
    public function generateReport();
}
