<?php

namespace App\Filament\Resources\SpiritualGuideAvailabilityResource\Pages;

use App\Filament\Resources\SpiritualGuideAvailabilityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpiritualGuideAvailability extends EditRecord
{
    protected static string $resource = SpiritualGuideAvailabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
