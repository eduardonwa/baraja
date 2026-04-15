<?php

namespace App\Filament\Widgets;

use App\Models\ContentMetric;
use Filament\Widgets\Widget;

class FunnelBreakdownWidget extends Widget
{
    protected string $view = 'filament.widgets.funnel-breakdown-widget';

    protected int | string | array $columnSpan = 8;

    protected static ?int $sort = 1;

    public function getViewData(): array
    {
        $metrics = ContentMetric::query()
            ->withConversionData()
            ->get();

        $avgViewToProfile = round(
            $metrics->avg(fn (ContentMetric $metric) => $metric->view_to_profile_conversion_rate) ?? 0,
            2
        );

        $avgProfileToFollow = round(
            $metrics->avg(fn (ContentMetric $metric) => $metric->profile_visit_to_follow_conversion_rate) ?? 0,
            2
        );

        return [
            'subheading' => 'Dónde se está rompiendo el recorrido entre views, profile visits y follows.',

            'viewToProfileLabel' => 'Views → Profile (7d)',
            'viewToProfileValue' => $this->formatPercentage($avgViewToProfile),
            'viewToProfileText' => $this->getViewToProfileSupportText($avgViewToProfile),

            'profileToFollowLabel' => 'Profile → Follow (7d)',
            'profileToFollowValue' => $this->formatPercentage($avgProfileToFollow),
            'profileToFollowText' => $this->getProfileToFollowSupportText($avgProfileToFollow),
        ];
    }

    protected function formatPercentage(float $value, bool $precise = false): string
    {
        if ($precise || ($value > 0 && $value < 1)) {
            return number_format($value, 2) . '%';
        }

        return number_format($value) . '%';
    }

    protected function getViewToProfileSupportText(float $score): string
    {
        if ($score >= 10) {
            return 'Buen gancho inicial. El contenido sí empuja visitas al perfil.';
        }

        if ($score >= 5) {
            return 'Interés medio. Parte de la audiencia entra al perfil, pero todavía hay fuga.';
        }

        return 'Pocas personas pasan de ver el contenido a visitar el perfil.';
    }

    protected function getProfileToFollowSupportText(float $score): string
    {
        if ($score >= 20) {
            return 'Buen cierre. Cuando entran al perfil, una parte importante termina siguiendo.';
        }

        if ($score >= 10) {
            return 'Conversión media desde el perfil. Hay intención, pero falta rematar.';
        }

        return 'La gente entra al perfil, pero casi no se convierte en follow.';
    }
}