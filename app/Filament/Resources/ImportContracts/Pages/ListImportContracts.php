<?php

namespace App\Filament\Resources\ImportContracts\Pages;

use App\Filament\Resources\ImportContracts\ImportContractResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListImportContracts extends ListRecords
{
    protected static string $resource = ImportContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
