<?php

namespace App\Filament\Resources\PinResource\Pages;

use App\Filament\Resources\PinResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePin extends CreateRecord
{
    protected static string $resource = PinResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
