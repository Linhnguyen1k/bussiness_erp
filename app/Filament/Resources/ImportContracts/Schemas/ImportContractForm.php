<?php

namespace App\Filament\Resources\ImportContracts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ImportContractForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('supplier_id')
                    ->required()
                    ->numeric(),
                TextInput::make('contract_code')
                    ->required(),
                DatePicker::make('signed_date')
                    ->required(),
                DatePicker::make('delivery_expected'),
                TextInput::make('total_estimated')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('payment_term_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
                TextInput::make('file_path')
                    ->default(null),
            ]);
    }
}
