<?php

namespace App\Models;

use DateTimeImmutable;
use Illuminate\Support\Facades\Date;

final class Book
{
    public int $id;
    public string $title;
    public DateTimeImmutable $releaseDate;
    public string $description;
    public string $isbn;
    public string $format;
    public int $numberOfPages;

    /**
     * @param int $id
     * @param string $title
     * @param DateTimeImmutable $releaseDate
     * @param string $description
     * @param string $isbn
     * @param string $format
     * @param int $numberOfPages
     */
    public function __construct(int               $id,
                                string            $title,
                                DateTimeImmutable $releaseDate,
                                string            $description,
                                string            $isbn,
                                string            $format,
                                int               $numberOfPages)
    {
        $this->id = $id;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->description = $description;
        $this->isbn = $isbn;
        $this->format = $format;
        $this->numberOfPages = $numberOfPages;
    }

    /**
     * @param array $booksArray
     * @return Book[]
     */
    public static function hydrate(array $booksArray): array
    {
        /** @var Book[] $books */
        $books = [];

        foreach($booksArray as $book) {
            $books[] = new Book(
                $book['id'],
                $book['title'],
                new DateTimeImmutable($book['release_date']),
                $book['description'],
                $book['isbn'],
                $book['format'],
                $book['number_of_pages'],
            );
        }

        return $books;
    }
}
