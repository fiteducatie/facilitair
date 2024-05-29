<?php

namespace App\Filament\Resources\PinResource\Pages;

use App\Filament\Resources\PinResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPin extends EditRecord
{
    protected static string $resource = PinResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Bekijken')
                ->icon('heroicon-o-eye')
                ->url(fn ($record) => route('pin.show', $record)),
            Actions\DeleteAction::make(),
        ];
    }
}
