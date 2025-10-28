<?php

namespace App\Filament\Resources\Suppliers\Pages;

use App\Filament\Resources\Suppliers\SuppliersResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditSuppliers extends EditRecord
{
    protected static string $resource = SuppliersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
