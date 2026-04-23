<?php

namespace App\Services;

use App\Models\Hypothesis;

class HypothesisStatusService
{
    public function determineStatus(int $positive, int $failed, bool $hasTests): string
    {
        if ($failed >= 2) {
            return 'discarded';
        }

        if ($positive >= 3) {
            return 'reliable';
        }

        if ($positive >= 2) {
            return 'promising';
        }

        if ($hasTests) {
            return 'testing';
        }

        return 'observing';
    }

    public function update(Hypothesis $hypothesis): void
    {
        $positive = $hypothesis->tests()
            ->where('result', 'confirmed')
            ->count();

        $failed = $hypothesis->tests()
            ->where('result', 'rejected')
            ->count();

        $status = $this->determineStatus(
            $positive,
            $failed,
            $hypothesis->tests()->exists()
        );

        $hypothesis->updateQuietly([
            'positive_signals_count' => $positive,
            'failed_tests_count' => $failed,
            'status' => $status,
        ]);
    }
}
