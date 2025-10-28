<?php

namespace App\Filament\Resources\ProductImportItems;

use App\Filament\Resources\ProductImportItems\Pages\CreateProductImportItem;
use App\Filament\Resources\ProductImportItems\Pages\EditProductImportItem;
use App\Filament\Resources\ProductImportItems\Pages\ListProductImportItems;
use App\Filament\Resources\ProductImportItems\Schemas\ProductImportItemForm;
use App\Filament\Resources\ProductImportItems\Tables\ProductImportItemsTable;
use App\Models\ProductImportItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductImportItemResource extends Resource
{
    protected static ?string $model = ProductImportItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ProductImportItem';

    public static function form(Schema $schema): Schema
    {
        return ProductImportItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductImportItemsTable::configure($table);
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
            'index' => ListProductImportItems::route('/'),
            'create' => CreateProductImportItem::route('/create'),
            'edit' => EditProductImportItem::route('/{record}/edit'),
        ];
    }
}
