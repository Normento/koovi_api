<?php

namespace App\Filament\Resources\HomeResource\Pages;

use App\Filament\Resources\HomeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageHomes extends ManageRecords
{
    protected static string $resource = HomeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
