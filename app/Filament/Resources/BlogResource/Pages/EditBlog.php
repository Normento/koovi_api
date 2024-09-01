<?php

namespace App\Filament\Resources\BlogResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use App\Filament\Resources\BlogResource;
use Filament\Resources\Pages\EditRecord;

class EditBlog extends EditRecord
{
    protected static string $resource = BlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        return $data;
    }


}
