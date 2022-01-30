<?php

namespace App\Modules\Security\Entities;

use App\Modules\BaseModel;
use App\Extensions\Kendo2QueryBuilder;
use DB;

class EventLogs extends BaseModel {

    public $table = 'events_logs';

    public function getCreatedAtAttribute($value) {

        $newDateFormatCreatedAt = date('d/m/Y H:i:s', strtotime($value));

        return $newDateFormatCreatedAt;
    }

}
