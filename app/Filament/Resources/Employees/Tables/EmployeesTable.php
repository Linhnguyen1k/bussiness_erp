<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Checkbox::make('id'),
                TextColumn::make('full_name')->sortable()->searchable(),
                TextColumn::make('user.email')->searchable(),
                TextColumn::make('date_of_birth')->sortable(),
                TextColumn::make('phone')->sortable(),
                TextColumn::make('joined_date')->sortable(),

            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()->hidden(function () {
                     $employee = Filament::auth()->user()?->employee;
                $roleIds = $employee?->role->pluck('id')->toArray() ?? [];
                return collect([1, 2])->intersect($roleIds)->isEmpty();
                }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ;
    }
   
}
