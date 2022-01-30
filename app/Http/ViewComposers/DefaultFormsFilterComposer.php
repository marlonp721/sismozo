<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\RopsDAO;
use Carbon\Carbon;

use App\Repositories\RegionsDAO;
use App\Repositories\ProvincesDAO;
use App\Repositories\DistrictsDAO;
use App\Repositories\LocalitiesDAO;
use App\Repositories\ElementsDAO;

class DefaultFormsFilterComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with();
    }
}

