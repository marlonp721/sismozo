<?php

namespace App\Modules;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use DB;

use Illuminate\Http\JsonResponse;

class BaseModel extends Model
{
    //use Auditable;
    use SoftDeletes;

    protected $message_settings = [
        'testing'         => true,
        'exception'       => false,
        'error_message'   => 'Database error',
        'success_message' => 'Success!',
        'data'            => false,
    ];



    protected function storeRequest($request)
    {
        DB::beginTransaction();

        try {

            $this->create($request->all());

            DB::commit();

        }catch (\Exception $e){

            DB::rollBack();

            return $this->errorMessage();
        }

        return $this->successMessage();
    }
    
    protected function storeMultipleRequest($name, $entityRequest, $multipleRequest, $method = 'storeRequest')
    {
        $messages = [];

        $formRequest = 'App\Http\Requests\\' . $entityRequest;

        $entity = new $formRequest();

        foreach ($multipleRequest as $key => $request) :

            $form_key = $name . '_' . $key;
        
            $validation = Validator::make( $request->all(), $entity->rules() );

            if ( $validation->passes() ) :
                
                $new = $this->$method($request);

                $messages[$form_key]['status']   = $new['status'];
                $messages[$form_key]['type']     = 'database';
                $messages[$form_key]['messages'] = $new['message'];

            else:

                $messages[$form_key]['status']   = 'error';
                $messages[$form_key]['type']     = 'validation';
                $messages[$form_key]['messages'] = $validation->errors();

            endif;
        
        endforeach;

        $statuses = array_group_by($messages, 'status');

        $count['error'] = isset($statuses['error']) ? count($statuses['error']) : 0;

        $code = 200;

        if ( $count['error'] > 0 ) :
        
            $code = 422;
        
        endif;

        return $this->response($messages, $code);
    }

    protected function updateRequest($model, $request)
    {
        DB::beginTransaction();
       // dd($request->all());
        try {

            $model->update( $request->all() );

            DB::commit();

        }catch (\Exception $e){

            DB::rollBack();

            return $this->errorMessage();
        }

        return $this->successMessage();
    }

    protected function destroyRequest($model)
    {
        DB::beginTransaction();

        try {

            $model->delete();

            DB::commit();
        }
        catch (\Exception $e){

            DB::rollBack();
            dd($e->getMessage());
            return $this->errorMessage();
        }

        return $this->successMessage();
    }

    // Message Functions

    protected function errorMessage($settings = [])
    {
        $settings = array_replace($this->message_settings, $settings);

        $message = $settings['error_message'];

        if ( $settings['testing'] == true ) :

            // dd($settings['exception']);

            if ( $settings['exception'] ) :

                $message = $settings['exception']->getMessage();

            endif;

        endif;

        return $this->sendMessage('error', $message);
    }

    protected function successMessage($settings = [])
    {
        $settings = array_replace($this->message_settings, $settings);

        $message = $settings['success_message'];

        if ( $settings['data'] ) :

            $message = $settings['data'];

        endif;

        return $this->sendMessage('success', $message);
    }

    protected function sendMessage($status, $message)
    {
        return ['status' => $status, 'message' => $message];
    }

    protected function response($data, $code)
    {
        return new JsonResponse($data, $code);
    }

    protected function storeArray( $data ){

        DB::beginTransaction();

        try {

            $data = $this->create( $data );

            DB::commit();
            return $data;

        }catch (\Exception $e){

            DB::rollBack();
//            dd($this->errorMessage());
//            dd($e->getMessage());
          abort(500);
            return $this->errorMessage();
        }

        return $this->successMessage();
    
    }
}
