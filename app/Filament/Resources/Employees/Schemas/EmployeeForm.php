<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Image;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Str;
class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Components
                Grid::make(1)
                ->columnSpanFull()
                ->schema([
                    Section::make()->schema([
                        Flex::make([
                            Section::make([
                                TextInput::make('full_name')->required(),
                                TextInput::make('username')
                                ->afterStateHydrated(function ($set, $state, $record) {
                                    if ($record && $record->user) {
                                        $set('username', $record->user->name);
                                        $set('email', $record->user->email);
                                    }
                                })
                                ->required(),
                                TextInput::make('password')->password()->required(),
                                TextInput::make('address'),
                            ]),
                            Section::make([
                                TextInput::make('email')->required(),
                                FileUpload::make('image')
                                ->label('Ảnh đại diện')
                                ->disk('cloudinary')
                                ->directory('employees')
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                    return Str::uuid() . '.' . $file->getClientOriginalExtension();
                                })
                                ->imageEditor()
                                ->image(),
                                DateTimePicker::make('date_of_birth'),

                            ]),
                        ]),
                    ])
                    ]),
                    Grid::make(1)
                    ->columnSpanFull()
                    ->schema([
                        Section::make()->schema([
                            Select::make('role_id')
                            ->label('Vai trò')
                            ->multiple()
                            ->preload()
                            ->relationship('role', 'name')->required(),
                        ])
                    ])
            ]);
    }
}
