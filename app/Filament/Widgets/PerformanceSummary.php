<?php

namespace App\Filament\Widgets;

use App\Models\ContentMetric;
use Filament\Widgets\Widget;

class PerformanceSummary extends Widget
{
    protected string $view = 'filament.widgets.performance-summary';

    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        $posts = ContentMetric::query()->get();

        $posts = $posts->map(function ($post) {
            $post->total_engagement =
                (int) $post->likes_7d +
                (int) $post->comments_7d +
                (int) $post->shares_7d +
                (int) $post->saves_7d +
                (int) $post->reposts_7d;

            return $post;
        });

        $best = $posts->sortByDesc('total_engagement')->first();
        $worst = $posts->sortBy('total_engagement')->first();

        return [
            'best' => $best,
            'worst' => $worst,
        ];
    }
}