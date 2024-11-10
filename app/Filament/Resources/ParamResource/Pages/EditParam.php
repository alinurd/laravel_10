<?php

namespace App\Filament\Resources\ParamResource\Pages;

use App\Filament\Resources\ParamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParam extends EditRecord
{
    protected static string $resource = ParamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
