<?php

namespace App\Filament\Widgets;

use App\Models\ContentMetric;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ConversionEfficiencyOverview extends BaseWidget
{
    protected static ?int $sort = 5;

    protected function getStats(): array
    {
        $metrics = ContentMetric::query()
            ->withConversionData()
            ->get();

        $avgScore = round(
            $metrics->avg(function (ContentMetric $metric) {
                return $this->calculateEfficiencyScore($metric);
            }) ?? 0,
            2
        );

        $bestPost = $metrics->sortByDesc(function (ContentMetric $metric) {
            return $this->calculateEfficiencyScore($metric);
        })->first();

        return [
            Stat::make('View-to-Follow Efficiency', number_format($avgScore) . '%')
                ->description($this->getInsight($avgScore, $bestPost))
                ->icon('heroicon-m-bolt')
                ->color($this->getColor($avgScore)),
        ];
    }

    protected function calculateEfficiencyScore(ContentMetric $metric): float
    {
        return round(
            ($metric->view_to_profile_conversion_rate / 100)
            * ($metric->profile_visit_to_follow_conversion_rate / 100)
            * 100,
            2
        );
    }

    protected function getInsight(float $score, ?ContentMetric $bestPost): string
    {
        $post = $bestPost
            ? ($bestPost->title
                ?? $bestPost->rotationCycleItem?->title
                ?? "Post #{$bestPost->id}")
            : null;

        if ($score >= 3) {
            return "🚀 Funnel fuerte. Tu contenido convierte bien a follow"
                . ($post ? " · Top: {$post}" : "");
        }

        if ($score >= 1) {
            return "⚠️ Conversión media. Hay fricción entre contenido y perfil"
                . ($post ? " · Top: {$post}" : "");
        }

        return "💀 Baja conversión. Muchas views, pocos follows"
            . ($post ? " · Top: {$post}" : "");
    }

    protected function getColor(float $score): string
    {
        if ($score >= 3) {
            return 'success';
        }

        if ($score >= 1) {
            return 'warning';
        }

        return 'danger';
    }
}