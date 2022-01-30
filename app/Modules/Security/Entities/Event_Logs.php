<?php

namespace App\Modules\Security\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Extensions\Kendo2QueryBuilder;
use App\Modules\BaseModel;
use App\Modules\Roaming\Entities\RoamingAgreement;
use DB;

class Event_Logs extends BaseModel
{

    const TYPE_LOG = 'AUD';
    const ELEMENT_LOGIN = 'Login';
    const ELEMENT_ROLE = 'Perfil';
    const ELEMENT_USER = 'Usuario';
    const ELEMENT_IR21 = 'Ir21';
    const ELEMENT_ROAMING = 'Roaming';
    const ACTION_LOGIN = 'Acceso';
    const ACTION_NEW = 'Nuevo';
    const ACTION_UPLOAD = 'Subir Archivo';
    const ACTION_DELETED_FILE = 'Borrar Archivo';
    const ACTION_EDIT = 'Editar';
    const ACTION_DELETE = 'Borrar';
    const ACTION_ROAMING = 'Subir archivo';
    const ACTION_CONFIGURATION = 'Configurar';
    const ACTION_TASK   = 'Programar Tarea';
    public $table = 'events_logs';

    protected $fillable = [
        'TASK_ID',
        'USER_ID',
        'IR21_ID',
        'TYPE_LOG',
        'ELEMENT',
        'ACTION',
        'CMD_IR21',
        'DESCRIPTION',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s'
    ];
    public static function getAll($filters, $skip, $pageSize, $sort)
    {
        $query         = static::select(
            'events_logs.id as id',
            'ir21.name as documento_ir21',
            'us.fullname as usuario',
            'events_logs.task_id',
            'events_logs.created_at',
            'events_logs.element',
            'events_logs.cmd_ir21',
            'p.valor'
        )
            ->Join('ir21_documents ir21', 'ir21.id', '=', 'events_logs.ir21_id')
            ->Join('users us', 'us.id', '=', 'events_logs.user_id')
            ->Join('params p', 'p.name', '=', 'events_logs.description')
            ->where('events_logs.type_log', '=', 'IR21')
            ->where('events_logs.deleted_at', '=', NULL)
            ->orderBy('events_logs.id', 'desc');

        if (empty($filters)) {
            $filters = [];
        }
        $kQuery = new Kendo2QueryBuilder($query);
        $kQuery->setNamespace('events_logs', ['created_at', 'id', 'task_id', 'element', 'cmd_ir21', 'description']);
        $kQuery->setAliases(['ir21.name' => 'documento_ir21', 'us.fullname' => 'usuario']);
        $query = $kQuery->buildQueryFromKendoFilter($filters);
        $count = $query->count();
        if ($sort) {
            $query = $query->orderBy($sort['field'], $sort['dir']);
        }
        //        dd($query->toSql(),$query->getBindings());
        $query = $query->skip($skip)->take($pageSize)->get();
        $data['data']  = $query;
        $data['total'] = $count;
        return $data;
    }

    public static function getERRORMML($filters, $skip, $pageSize, $sort)
    {
        $query         = static::select(
            'events_logs.id as id',
            'events_logs.created_at',
            'us.fullname as usuario',
            'events_logs.task_id',
            'ir21.name as documento_ir21',
            'events_logs.element',
            'events_logs.cmd_ir21',
            'events_logs.description'
        )
            ->Join('ir21_documents ir21', 'ir21.id', '=', 'events_logs.ir21_id')
            ->Join('users us', 'us.id', '=', 'events_logs.user_id')
            ->where('events_logs.type_log', '=', 'MML')
            ->where('events_logs.deleted_at', '=', NULL)
            ->orderBy('events_logs.id', 'desc');
        if (empty($filters)) {
            $filters = [];
        }
        $kQuery = new Kendo2QueryBuilder($query);
        $kQuery->setNamespace('events_logs', ['created_at', 'id', 'task_id', 'element', 'cmd_ir21', 'description']);
        $kQuery->setAliases(['us.fullname' => 'usuario', 'ir21.name' => 'documento_ir21']);
        $query = $kQuery->buildQueryFromKendoFilter($filters);
        $count = $query->count();
        if ($sort) {
            $query = $query->orderBy($sort['field'], $sort['dir']);
        }
        //        dd($query->toSql(),$query->getBindings());
        $query = $query->skip($skip)->take($pageSize)->get();
        $data['data']  = $query;
        $data['total'] = $count;
        return $data;
    }

    public static function getAuditIr21($filters, $skip, $pageSize, $sort)
    {
        $query         = static::select(
            'events_logs.id as id',
            'events_logs.created_at',
            'events_logs.task_id',
            'us.fullname as usuario',
            'ir21.name as documento_ir21',
            'events_logs.element',
            'events_logs.action',
            'events_logs.description'
        )
            ->leftJoin('ir21_documents ir21', 'ir21.id', '=', 'events_logs.ir21_id')
            ->Join('users us', 'us.id', '=', 'events_logs.user_id')
            ->where('events_logs.type_log', '=', "AUD")
            ->where('events_logs.deleted_at', '=', NULL)
            ->orderBy('events_logs.id', 'desc');
        if (empty($filters)) {
            $filters = [];
        }
        $kQuery = new Kendo2QueryBuilder($query);
        $kQuery->setNamespace('events_logs', ['created_at', 'id', 'task_id', 'element', 'description', 'action']);
        $kQuery->setAliases(['ir21.name' => 'documento_ir21', 'us.fullname' => 'usuario']);
        $query = $kQuery->buildQueryFromKendoFilter($filters);
        $count = $query->count();
        if ($sort) {
            $query = $query->orderBy($sort['field'], $sort['dir']);
        }
        //        dd($query->toSql(),$query->getBindings());
        $query = $query->skip($skip)->take($pageSize)->get();
        $data['data']  = $query;
        $data['total'] = $count;
        return $data;
    }

    public function getCreatedAtAttribute($value)
    {

        $newDateFormatCreatedAt = date('d/m/Y H:i:s', strtotime($value));

        return $newDateFormatCreatedAt;
    }
}
