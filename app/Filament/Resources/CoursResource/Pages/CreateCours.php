<?php

namespace App\Filament\Resources\CoursResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Filament\Resources\CoursResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCours extends CreateRecord
{
    protected static string $resource = CoursResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array

    {

        if (isset($data['file'])) {
            $filePath = $data['file'];
            if (Storage::disk('public')->exists($filePath)) {

                $fileSizeInBytes = Storage::disk('public')->size($filePath);

                if ($fileSizeInBytes >= 1048576) { // 1 Mo = 1 048 576 octets
                    $fileSizeInMB = $fileSizeInBytes / 1048576;
                    $data['file_size'] = round($fileSizeInMB, 2) . ' Mo'; // Format Mo
                } elseif ($fileSizeInBytes >= 1024) { // 1 Ko = 1 024 octets
                    $fileSizeInKB = $fileSizeInBytes / 1024;
                    $data['file_size'] = round($fileSizeInKB, 2) . ' Ko'; // Format Ko
                } else {
                    $data['file_size'] = $fileSizeInBytes . ' octets'; // Moins de 1 Ko
                }

            } else {
                // Gestion des erreurs si le fichier n'existe pas
                $data['file_size'] = 'Erreur: Le fichier n\'existe pas.';
                $data['pages'] = 0;
            }
        }

        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        return $data;

    }
}
