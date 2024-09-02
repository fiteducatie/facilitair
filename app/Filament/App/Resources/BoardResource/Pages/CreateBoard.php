<?php

namespace App\Filament\App\Resources\BoardResource\Pages;

use App\Filament\App\Resources\BoardResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBoard extends CreateRecord
{
    protected static string $resource = BoardResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }

}
