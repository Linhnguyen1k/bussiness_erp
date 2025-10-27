<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class Checkin extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-calendar-days';
    protected string $view = 'filament.pages.checkin';
    protected static ?string $navigationLabel = 'Quản lý chấm công';
    protected static ?string $title   = 'Chấm công';


}
