<?php

namespace App\Filament\Resources\BlogResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use App\Filament\Resources\BlogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        return $data;
    }
}
