<?php

namespace App\Providers;

use App\Modules\Ir21\Entities\CronTask;
use App\Modules\Security\Entities\Event_Logs;
use App\Modules\Ir21\Entities\Ir21_Documents;
use App\Modules\Roaming\Entities\RoamingAgreement;
use App\Modules\Security\Entities\Params;
use App\Modules\Security\Entities\User;
use Illuminate\Support\ServiceProvider;
use App\Modules\Security\Entities\Role;
use Validator;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Validator::extend('exclude_superuser', function($attribute, $value, $parameters, $validator) {


        if ( ! $value )
        {
          return true;
        }

        $role = Role::findOrFail($value);

        if ( $role->isSuperuser() )
        {
          return false;
        }
        return true;
      });

      Validator::extend('exists_value', function($attribute, $value, $parameters, $validator) {
        if(is_null($value)){
          return true;
        }
        $query = RoamingAgreement::where([[$parameters[0],$value]])->get()->count();

        if($query>0){
          return true;
        }
        return false;
      });
      Role::created(function($model){

        $event_logs =new Event_Logs();

        $event_logs->user_id        = auth()->user()->id;
        $event_logs->type_log       = Event_Logs::TYPE_LOG;
        $event_logs->element        = Event_Logs::ELEMENT_ROLE;
        $event_logs->action         = Event_Logs::ACTION_NEW;
        $event_logs->description    = 'Nuevo Perfil : "'.$model->display_name.'"';

        try{
          $event_logs->save();
        }catch (\Exception $e) {
          abort(500);
        }


      });

      Role::deleted(function($model){
        $event_logs =new Event_Logs();

        $event_logs->user_id        = auth()->user()->id;
        $event_logs->type_log       = Event_Logs::TYPE_LOG;
        $event_logs->element        = Event_Logs::ELEMENT_ROLE;
        $event_logs->action         = Event_Logs::ACTION_DELETE;
        $event_logs->description    = 'Borrar Perfil : "'.$model->display_name.'"';

        try{
          $event_logs->save();
        }catch (\Exception $e) {
          abort(500);
        }


      });

      User::created(function($model){

        $event_logs =new Event_Logs();

        $event_logs->user_id        = auth()->user()->id;
        $event_logs->type_log       = Event_Logs::TYPE_LOG;
        $event_logs->element        = Event_Logs::ELEMENT_USER;
        $event_logs->action         = Event_Logs::ACTION_NEW;
        $event_logs->description    = 'Nuevo Usuario : "'.$model->username.'"';

        try{
          $event_logs->save();
        }catch (\Exception $e) {
          abort(500);
        }


      });

      User::updated(function($model){
        $event_logs =new Event_Logs();

        $event_logs->user_id        = auth()->user()->id;
        $event_logs->type_log       = Event_Logs::TYPE_LOG;
        $event_logs->element        = Event_Logs::ELEMENT_USER;
        $event_logs->action         = Event_Logs::ACTION_EDIT;
        $event_logs->description    = 'Editar Usuario : "'.$model->username.'"';

        try{
          $event_logs->save();
        }catch (\Exception $e) {
          abort(500);
        }


      });
      User::deleted(function($model){
        $event_logs =new Event_Logs();

        $event_logs->user_id        = auth()->user()->id;
        $event_logs->type_log       = Event_Logs::TYPE_LOG;
        $event_logs->element        = Event_Logs::ELEMENT_USER;
        $event_logs->action         = Event_Logs::ACTION_DELETE;
        $event_logs->description    = 'Borrar Usuario : "'.$model->username.'"';

        try{
          $event_logs->save();
        }catch (\Exception $e) {
          abort(500);
        }


      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Do nothing because of X and Y.
    }
}
