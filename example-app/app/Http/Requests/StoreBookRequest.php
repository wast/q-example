<?php

namespace App\Http\Requests;

use DateTimeImmutable;
use Illuminate\Foundation\Http\FormRequest;

final class StoreBookRequest extends FormRequest
{
    public ?string $title = null;
    public string $description;
    public DateTimeImmutable $releaseDate;
    public string $isbn;
    public string $bookFormat; // $format is taken
    public int $numberOfPages;
    public int $authorId;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
