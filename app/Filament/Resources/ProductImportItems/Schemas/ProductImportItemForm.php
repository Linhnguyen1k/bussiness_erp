<?php

namespace App\Filament\Resources\ProductImportItems\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductImportItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_import_id')
                    ->required()
                    ->numeric(),
                TextInput::make('product_id')
                    ->required()
                    ->numeric(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('import_price')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('subtotal')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
