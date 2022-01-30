<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
// use App\Repositories\InspectorDAO;
use App\Modules\Configuration\Entities\Management;
use Carbon\Carbon;

class DefaultFormsFilterComposerA
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $managements  =  ['' => ''] + Management::listable();

        $view->with(['managements'=> $managements]);
    }
}

