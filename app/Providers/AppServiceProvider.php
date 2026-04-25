<?php

namespace App\Providers;

use App\Models\HypothesisTest;
use App\Observers\HypothesisTestObserver;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();

        Carbon::setLocale('es');

        HypothesisTest::observe(HypothesisTestObserver::class);
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Model::unguard();
        
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );

        DateTimePicker::macro('dateMex', function () {
            return $this
                ->hint('DD/MM/AAAA')
                ->native(false)
                ->displayFormat('d / m / Y — h:i A')
                ->seconds(false);
        });
    }
}
