<?php

namespace App\Filament\App\Resources\BoardResource\Pages;

use App\Filament\App\Resources\BoardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBoards extends ListRecords
{
    protected static string $resource = BoardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
