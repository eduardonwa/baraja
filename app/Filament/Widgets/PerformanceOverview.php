<?php

namespace App\Filament\Widgets;

use App\Models\ContentMetric;
use Filament\Widgets\ChartWidget;

class PerformanceOverview extends ChartWidget
{
    protected ?string $heading = null;

    protected int | string | array $columnSpan = 'full';

    protected ?string $maxHeight = '377px';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $posts = ContentMetric::query()
            ->latest()
            ->take(14)
            ->get()
            ->reverse()
            ->values();

        $labels = $posts->map(fn ($post, $i) => 'Post ' . ($i + 1))->toArray();

        $totalEngagement = $posts->map(function ($post) {
            return
                (int) $post->likes_7d +
                (int) $post->comments_7d +
                (int) $post->shares_7d +
                (int) $post->saves_7d +
                (int) $post->reposts_7d;
        })->toArray();

        $comments = $posts->pluck('comments_7d')->map(fn ($v) => (int) $v)->toArray();
        $saves = $posts->pluck('saves_7d')->map(fn ($v) => (int) $v)->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Total Engagement',
                    'data' => $totalEngagement,
                ],
                [
                    'label' => 'Comments',
                    'data' => $comments,
                ],
                [
                    'label' => 'Saves',
                    'data' => $saves,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
