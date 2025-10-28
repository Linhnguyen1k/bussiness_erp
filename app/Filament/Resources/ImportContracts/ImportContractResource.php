<?php

namespace App\Filament\Resources\ImportContracts;

use App\Filament\Resources\ImportContracts\Pages\CreateImportContract;
use App\Filament\Resources\ImportContracts\Pages\EditImportContract;
use App\Filament\Resources\ImportContracts\Pages\ListImportContracts;
use App\Filament\Resources\ImportContracts\Schemas\ImportContractForm;
use App\Filament\Resources\ImportContracts\Tables\ImportContractsTable;
use App\Models\ImportContract;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ImportContractResource extends Resource
{
    protected static ?string $model = ImportContract::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ImportContract';

    public static function form(Schema $schema): Schema
    {
        return ImportContractForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ImportContractsTable::configure($table);
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
            'index' => ListImportContracts::route('/'),
            'create' => CreateImportContract::route('/create'),
            'edit' => EditImportContract::route('/{record}/edit'),
        ];
    }
}
