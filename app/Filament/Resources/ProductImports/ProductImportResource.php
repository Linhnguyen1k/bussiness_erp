<?php

namespace App\Filament\Resources\ProductImports;

use App\Filament\Resources\ProductImports\Pages\CreateProductImport;
use App\Filament\Resources\ProductImports\Pages\EditProductImport;
use App\Filament\Resources\ProductImports\Pages\ListProductImports;
use App\Filament\Resources\ProductImports\Schemas\ProductImportForm;
use App\Filament\Resources\ProductImports\Tables\ProductImportsTable;
use App\Models\ProductImport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductImportResource extends Resource
{
    protected static ?string $model = ProductImport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ProductImport';

    public static function form(Schema $schema): Schema
    {
        return ProductImportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductImportsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductImports::route('/'),
            'create' => CreateProductImport::route('/create'),
            'edit' => EditProductImport::route('/{record}/edit'),
        ];
    }
}
