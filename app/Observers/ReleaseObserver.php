<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

use App\Transaction\Release;

class ReleaseObserver
{
    public function created(Release $release)
    {
        $release->transaction_code = 'R' . now()->format('Y') . now()->format('m') . '-' . str_pad($release->id, 7, '0', STR_PAD_LEFT);
        $release->prepared_by_id = Auth::id();
        $release->update();
    }
}
