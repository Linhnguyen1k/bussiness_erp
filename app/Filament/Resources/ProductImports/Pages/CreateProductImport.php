<?php

namespace App\Filament\Resources\ProductImports\Pages;

use App\Filament\Resources\ProductImports\ProductImportResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductImport extends CreateRecord
{
    protected static string $resource = ProductImportResource::class;
}
