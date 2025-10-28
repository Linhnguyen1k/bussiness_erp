<?php

namespace App\Filament\Resources\ProductImportItems\Pages;

use App\Filament\Resources\ProductImportItems\ProductImportItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductImportItems extends ListRecords
{
    protected static string $resource = ProductImportItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
