<?php

namespace App\Http\View\Composers;

use App\Helpers\PlatformSeasonsHelper;
use Illuminate\View\View;

class DefaultLayoutComposer {

    /**
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('player_platforms', PlatformSeasonsHelper::getActive());
    }
}
