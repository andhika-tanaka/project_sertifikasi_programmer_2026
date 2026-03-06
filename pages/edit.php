<?php
require_once __DIR__ ."/../vendor/autoload.php";

use App\Models\Books;

$booksModel = new Books();

$id = $_GET['id'];
$book = $booksModel->getById($id);

if(isset($_POST['submit'])){

     
    $title  = $_POST['title'];
    $author  = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $qty = $_POST ['qty'];

    $booksModel->update($id,$title, $author, $publisher, $year, $qty);

    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ubah Buku</title>
</head>
<body>

<h2>Ubah Data Buku</h2>

<form method="POST">

<table>

<tr>
<td>Judul Buku</td>
<td><input type="text" name="title" required value="<?= $book['title']; ?>"></td>
</tr>

<tr>
<td>Penulis</td>
<td><input type="text" name="author" required value="<?= $book['author']; ?>"></td>
</tr>

<tr>
<td>Penerbit</td>
<td><input type="text" name="publisher" required value="<?= $book['publisher']; ?>"></td>
</tr>

<tr>
<td>Tahun</td>
<td><input type="number" name="year" required value="<?= $book['year']; ?>">
</tr>

<tr>
<td>Jumlah</td>
<td><input type="number" name="qty" required value="<?= $book['qty']; ?>"></td>
</tr>

<tr>
<td></td>
<td>
<button type="submit" name="submit">Simpan</button>
<a href="../index.php">Kembali</a>
</td>
</tr>

</table>

</form>

</body>
</html>