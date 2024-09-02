<?php

namespace App\Filament\App\Resources\BoardResource\Pages;

use App\Filament\App\Resources\BoardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBoard extends EditRecord
{
    protected static string $resource = BoardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
