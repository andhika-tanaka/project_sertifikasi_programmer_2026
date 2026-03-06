<?php

use PHPUnit\Framework\TestCase;
use App\Models\Books;

class BooksTest extends TestCase
{
    private Books $books;

    protected function setUp(): void
    {
        $this->books = new Books();
    }

    public function testInsertBook()
    {
        $result = $this->books->insert(
            "Belajar PHP",
            "Andi",
            "Informatika",
            2024,
            5
        );

        $this->assertTrue($result);
    }

    public function testGetBookById()
    {
        $this->books->insert("Belajar PHP", "Andi", "Informatika", 2024, 5);
        $all  = $this->books->getAll();
        $book = end($all);

        $found = $this->books->getById((int)$book['id']);
        $this->assertNotNull($found);
    }

    public function testUpdateBook()
    {
        $this->books->insert("Belajar PHP", "Andi", "Informatika", 2024, 5);
        $all  = $this->books->getAll();
        $book = end($all);

        $result = $this->books->update(
            (int)$book['id'],
            "Belajar PHP Update",
            "Andi",
            "Informatika",
            2024,
            5
        );
        $this->assertTrue($result);

        $updated = $this->books->getById((int)$book['id']);
        $this->assertEquals("Belajar PHP Update", $updated['title']);
        $this->assertEquals("Andi", $updated['author']);
        $this->assertEquals("Informatika", $updated['publisher']);
        $this->assertEquals(2024, $updated['year']);
        $this->assertEquals(5, $updated['qty']);
    }

    public function testDeleteBook(){
        $this->books->insert("Belajar PHP", "Andi", "Informatika", 2024, 5);
        $all  = $this->books->getAll();
        $book = end($all);

        $result = $this->books->delete((int)$book['id']);
        
        $this->assertTrue($result);
    }
}