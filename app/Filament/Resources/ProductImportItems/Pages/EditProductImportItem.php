<?php

namespace App\Filament\Resources\ProductImportItems\Pages;

use App\Filament\Resources\ProductImportItems\ProductImportItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProductImportItem extends EditRecord
{
    protected static string $resource = ProductImportItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
