<?php

namespace App\Observers;

use App\Models\HypothesisTest;
use App\Services\HypothesisStatusService;

class HypothesisTestObserver
{
    public function saved(HypothesisTest $test): void
    {
        app(HypothesisStatusService::class)
            ->update($test->hypothesis);
    }

    public function deleted(HypothesisTest $test): void
    {
        app(HypothesisStatusService::class)
            ->update($test->hypothesis);
    }
}
