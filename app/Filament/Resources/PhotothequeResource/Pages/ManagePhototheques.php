<?php

namespace App\Filament\Resources\PhotothequeResource\Pages;

use App\Filament\Resources\PhotothequeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePhototheques extends ManageRecords
{
    protected static string $resource = PhotothequeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
