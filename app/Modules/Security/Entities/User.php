<?php

namespace App\Modules\Security\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\JsonResponse;

use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\Config;
//use OwenIt\Auditing\Auditable;
use Illuminate\Support\Str;
use App\Scopes\ListScope;
use Carbon\Carbon;
use DB;

class User extends Authenticatable
{
    use Notifiable;
    //use Auditable;
    use SoftDeletes;
    use EntrustUserTrait {
        EntrustUserTrait::restore insteadof SoftDeletes;
    }
    
//    protected $dateFormat = 'd/m/Y H:m:s';

    // public static $auditCustomMessage = '{user.name|Anonymous} {type} a record {elapsed_time}'; 

    // public static $auditCustomFields = [
    //     'username'  => 'The username was defined as "{new.username||getNewUsername}"', 
    //     'name'  => 'The name was defined as "{new.name||getNewName}"', 
    //     'ip_address' => 'Registered from the address {ip_address}',
    //     'publish_date' => [
    //         'created' => 'Publication date: {new.publish_date}',
    //         'deleted' => 'Post removed from {new.publish_date}'
    //     ]
    // ];

    // public function getNewUsername($post)
    // {
    //     return $post->old['username'];
    // }

    // public function getNewName($post)
    // {
    //     return $post->old['name'];
    // }

    // protected  $keepAuditOf = ['deleted_at', 'name', 'lastname', 'password', 'email'];

    /**
     * The attributes that should be handled as dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at','deleted_at'];

    protected $casts = [

      'created_at' => 'datetime:d/m/Y H:i:s',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
        'username','fullname',
        'cellphone',
        'comment_user',
        'deleted_at',
        'status',
        'area',
        'company'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
  /**
   * Functions to disable Remember Token
   */

  public function getRememberToken()
  {
    return null; // not supported
  }

  public function setRememberToken($value)
  {
    // not supported
  }

  public function getRememberTokenName()
  {
    return null; // not supported
  }

  /**
   * Overrides the method to ignore the remember token.
   */
  public function setAttribute($key, $value)
  {
    $isRememberTokenAttribute = $key == $this->getRememberTokenName();

    if (!$isRememberTokenAttribute)
    {
      parent::setAttribute($key, $value);
    }
  }
    /**
     * Relationships between tables.
     * Re-write entrust relationship adding timestamps
     * 
     */

    public function roles()
    {
        return $this->belongsToMany( Config::get('entrust.role'),
                                     Config::get('entrust.role_user_table'),
                                     Config::get('entrust.user_foreign_key'),
                                     Config::get('entrust.role_foreign_key') )
                    ->withTimestamps();
    }

    /**
     * Get the company that user belongs to.
     */
//    public function company()
//    {
//         return $this->belongsTo('App\Modules\Configuration\Entities\Company');
//    }
    
    /**
     * Get the management that user belongs to.
     */
//    public function management()
//    {
//         return $this->belongsTo('App\Modules\Configuration\Entities\Management');
//    }

    /**
     * Get inspections related to user.
     */
//    public function inspections()
//    {
//         return $this->hasMany('App\Modules\Forms\Entities\Inspection');
//    }

    /**
     * Get rops related to user.
     */
//    public function rops()
//    {
//         return $this->hasMany('App\Modules\Forms\Entities\Rop');
//    }

    /**
     * Mutators
     *
     */
    
    public function setPasswordAttribute($value)
    {
        if ( ! empty ($value) )
        {
            $this->attributes['password'] = \Hash::make($value);
        }
    }
    
    public function getFullnameAttribute()
    {
        //return $this->attributes['name'] . ' ' . $this->attributes['lastname'];
        return $this->attributes['fullname'] ;
    }

    public function getPhotoAttribute()
    {
        $path = asset('images/users') . '/';

        return $path . $this->attributes['photo'];
    }

    /**
     * Protected Functions
     *
     */
    
    protected function storeRequest($request)
    {
        DB::beginTransaction();

        try {
            $user = $this->create($request->all());

            $user->roles()->attach($request->roles);
             
            DB::commit();
            
        } catch (\Exception $e) {

            DB::rollBack();

            abort(500);
        }
		
        return json_encode(true);
    }

    protected function updateRequest($user, $request)
    {
        DB::beginTransaction();

        try {
            
            $user->update($request->all());

            if ( ! $user->isSuperUser() )
            {
                $user->roles()->sync($request->roles);
            }

            DB::commit();

        } catch (\Exception $e) {


            DB::rollBack();

            abort(500);
        }

        return json_encode(true);
    }

    protected function destroyRequest($user)
    {
        if ( $user->isSuperUser() )
        {
            return new JsonResponse('No puede eliminar a un Super Usuario.', 422);
        }
        
        // if (auth()->user()->id == $user->id)
        // {
        //     return new JsonResponse('No puede eliminar su propia cuenta.', 422);
        // }

        DB::beginTransaction();

        try {
            
            $user->delete();
            $user->roles()->sync([]);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            abort(500);
        }

        return json_encode(true);
    }

    public function isSuperUser()
    {        
        return $this->hasRole('superuser') ? true : false;
    }
    
    public function area_() {
        return $this->belongsTo('App\Modules\Apn\Models\Params', 'area', 'name');
    }

//    public function getCreatedAtAttribute($value)
//    {
//
//      $newDateFormatCreatedAt = date('d/m/Y H:m:s', strtotime($value));
//      $test = Carbon::parse($value)->format('d/m/Y H:i:s');
//      dd($value,$newDateFormatCreatedAt,$test);
//      return $newDateFormatCreatedAt;
//    }

  public function getCommentUserAttribute($value)
  {

    if(empty($value)){

      $value = "Ninguno";

    }
    return $value;
  }

  public function getCreatedAtAttribute($value) {

    $newDateFormatCreatedAt = date('d/m/Y H:i:s', strtotime($value));

    return $newDateFormatCreatedAt;
  }
}
