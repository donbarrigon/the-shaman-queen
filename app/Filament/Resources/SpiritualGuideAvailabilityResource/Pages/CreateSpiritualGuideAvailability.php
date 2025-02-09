<?php

namespace App\Filament\Resources\SpiritualGuideAvailabilityResource\Pages;

use App\Filament\Resources\SpiritualGuideAvailabilityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSpiritualGuideAvailability extends CreateRecord
{
    protected static string $resource = SpiritualGuideAvailabilityResource::class;

    protected function afterCreate(): void
    {
        // Mantener el valor del user_id después de crear
        $this->form->fill([
            'user_id' => $this->form->getState()['user_id']
        ]);
    }
}
