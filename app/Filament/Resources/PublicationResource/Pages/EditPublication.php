<?php

namespace App\Filament\Resources\PublicationResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Storage;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\PublicationResource;

class EditPublication extends EditRecord
{
    protected static string $resource = PublicationResource::class;

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

        if (isset($data['file'])) {


            $filePath = $data['file'];

            $fullPath = Storage::disk('public')->path($filePath);

            if (Storage::disk('public')->exists($filePath)) {
                $pdfParser = new Parser();
                $pdf = $pdfParser->parseFile($fullPath);
                $pages = $pdf->getPages();
                $numberOfPages = count($pages);

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

                // Assignez le nombre de pages au champ approprié
                $data['pages'] = $numberOfPages;
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
