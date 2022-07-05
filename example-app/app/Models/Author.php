<?php

namespace App\Models;

use DateTimeImmutable;

final class Author
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public DateTimeImmutable $birthday;
    public string $gender;
    public string $placeOfBirth;
    /** @var Book[] $books */
    public array $books;

    /**
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param DateTimeImmutable $birthday
     * @param string $gender
     * @param string $placeOfBirth
     */
    public function __construct(int               $id,
                                string            $firstName,
                                string            $lastName,
                                DateTimeImmutable $birthday,
                                string            $gender,
                                string            $placeOfBirth,
                                array             $books)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthday = $birthday;
        $this->gender = $gender;
        $this->placeOfBirth = $placeOfBirth;
        $this->books = $books;
    }

    function getFullName(): string
    {
        return "$this->firstName $this->lastName";
    }

    /**
     * @param array $authorsArray
     * @return Author[]
     */
    public static function hydrate(array $authorsArray): array
    {
        /** @var Author[] $authors */
        $authors = [];

        foreach($authorsArray as $author) {
            $authors[] = self::fromJson($author);
        }

        return $authors;
    }

    public static function fromJson(array $author): Author
    {
        return new Author(
            $author['id'],
            $author['first_name'],
            $author['last_name'],
            new DateTimeImmutable($author['birthday']),
            $author['gender'],
            $author['place_of_birth'],
            Book::hydrate($author['books'] ?? [])
        );
    }
}
