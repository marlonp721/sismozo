<?php

namespace App\Modules\Security\Entities;

use App\Modules\Security\Entities\Event_Logs;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\JsonResponse;
use Zizaco\Entrust\EntrustRole;
//use OwenIt\Auditing\Auditable;
use DB;

class Role extends EntrustRole
{
    //use Auditable;
    use SoftDeletes;
//    protected $dateFormat = 'd/m/Y H:m:s';
    //protected $dateFormat = 'DD/MM/YYYY HH24:mm:SS';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name','description'
    ];
    protected $casts = [
      'created_at' => 'datetime:d/m/Y H:i:s',
    ];
    /**
     * Assigned value field name
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower( str_replace(' ', '_', trim($this->attributes['display_name'])) );
    }

    public function isSuperUser()
    {
        return $this->name == 'superuser' ? true : false;
    }

    public function perms()
    {
        return $this->belongsToMany( Config::get('entrust.permission'),
                                     Config::get('entrust.permission_role_table'),
                                     Config::get('entrust.role_foreign_key'),
                                     Config::get('entrust.permission_foreign_key') )
                    ->withTimestamps();
    }

    /**
     * Protected Functions
     *
     */
    
    protected function storeRequest($request)
    {

        DB::beginTransaction();

        try {

            $role = $this->create($request->all());
            $role->perms()->attach($request->permissions);

            DB::commit();

        }catch (\Exception $e){

            DB::rollBack();

            abort(500);
        }

        return json_encode(true);
    }

    protected function updateRequest($role, $request)
    {
        DB::beginTransaction();

        try {

            $role->update( $request->all() );
            $role->perms()->sync($request->permissions);

            DB::commit();

            $event_logs =new Event_Logs();

            $event_logs->user_id        = auth()->user()->id;
            $event_logs->type_log       = Event_Logs::TYPE_LOG;
            $event_logs->element        = Event_Logs::ELEMENT_ROLE;
            $event_logs->action         = Event_Logs::ACTION_EDIT;
            $event_logs->description    = 'Editar Perfil: "'.$request->get('display_name').'"';

            $event_logs->save();

        }catch (\Exception $e){

            DB::rollBack();
  //          dd($e->getMessage(), $e->getLine(), $e->getFile());

            abort(500);
        }

        return json_encode(true);
    }

    protected function destroyRequest($role)
    {
        DB::beginTransaction();

        try {

            $role->delete();
            //$role->perms()->sync([]);

            DB::commit();
        }
        catch (\Exception $e){

            DB::rollBack();
            abort(500);
        }

        return json_encode(true);
    }

    public function getCreatedAtAttribute($value) {

        $newDateFormatCreatedAt = date('d/m/Y H:i:s', strtotime($value));

        return $newDateFormatCreatedAt;
    }

}