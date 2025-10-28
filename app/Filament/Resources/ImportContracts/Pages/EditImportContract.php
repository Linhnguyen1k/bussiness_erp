<?php

namespace App\Filament\Resources\ImportContracts\Pages;

use App\Filament\Resources\ImportContracts\ImportContractResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditImportContract extends EditRecord
{
    protected static string $resource = ImportContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
