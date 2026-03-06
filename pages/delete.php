<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Models\Books;

if (isset($_GET['id'])) {
    $books = new Books();
    $books->delete($_GET['id']);
    header('Location: ../index.php');
    exit;
} else {
    header('Location: ../index.php');
    exit;
}