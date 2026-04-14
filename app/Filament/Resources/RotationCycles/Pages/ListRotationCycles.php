<?php

namespace App\Filament\Resources\RotationCycles\Pages;

use App\Filament\Resources\RotationCycles\RotationCycleResource;
use App\Models\Hook;
use App\Models\RotationCycle;
use App\Services\CycleNameGenerator;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListRotationCycles extends ListRecords
{
    protected static string $resource = RotationCycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generateCycle')
                ->label('Generate Cycle')
                ->color('primary')
                ->requiresConfirmation()
                ->action(function () {
                    DB::transaction(function () {
                        RotationCycle::query()->update([
                            'is_active' => false,
                        ]);

                        $cycle = RotationCycle::create([
                            'name' => CycleNameGenerator::generateUnique(),
                            'generated_at' => now(),
                            'is_active' => true
                        ]);

                        $hooks = Hook::query()
                            ->inRandomOrder()
                            ->get();

                        foreach ($hooks as $index => $hook) {
                            $cycle->items()->create([
                                'hook_id' => $hook->id,
                                'position' => $index + 1,
                                'done' => false,
                                'idea_id' => null,
                            ]);
                        }
                    });
                }),
        ];
    }
}
