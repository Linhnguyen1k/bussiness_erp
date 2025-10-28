<?php

namespace App\Filament\Resources\ProductPrices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductPriceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product_id')
                    ->required()
                    ->numeric(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('type')
                    ->required()
                    ->default('retail'),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
            ]);
    }
}
