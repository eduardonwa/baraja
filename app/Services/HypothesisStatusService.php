<?php

namespace App\Services;

use App\Models\Hypothesis;

class HypothesisStatusService
{
    public function determineStatus(float $confidence, int $positive, int $failed, bool $hasTests): string
    {
        return match (true) {
            ! $hasTests => 'observing',

            $confidence < 30 => 'discarded',
            $confidence < 55 => 'testing',
            $confidence < 70 => 'promising',
            $confidence < 85 => 'reliable',

            default => 'reliable'
        };
    }

    public function update(Hypothesis $hypothesis): void
    {
        $tests = $hypothesis->tests()->get();

        $positive = $tests
            ->where('result', 'confirmed')
            ->count();

        $failed = $tests
            ->where('result', 'rejected')
            ->count();

        $positiveAvg = $tests
            ->where('result', 'confirmed')
            ->avg('signal_strength') ?? 0;

        $failedAvg = $tests
            ->where('result', 'rejected')
            ->avg('signal_strength') ?? 0;

        $totalTests = $tests->count();

        /*
         * Radio tuning model:
         * 50 = neutral / no clear signal
         * confirmed tests push confidence up
         * rejected tests push confidence down
         * volume factor prevents overconfidence with too few tests
        */
        $rawConfidence = 50 + (($positiveAvg - $failedAvg) / 2);

        $volumeFactor = min($totalTests / 5, 1);

        $confidence = 50 + (($rawConfidence - 50) * $volumeFactor);

        $confidence = round(max(0, min(100, $confidence)));

        $status = $this->determineStatus(
            $confidence,
            $positive,
            $failed,
            $totalTests > 0
        );

        $hypothesis->updateQuietly([
            'positive_signals_count' => $positive,
            'failed_tests_count' => $failed,
            'confidence_score' => $confidence,
            'status' => $status,
        ]);
    }
}
