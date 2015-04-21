<?php namespace App\Http\Requests;

use App\Support\Collection;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Get the response for a forbidden operation.
     *
     * @return \Illuminate\Http\Response
     */
    public function forbiddenResponse()
    {
        return response( view( 'error.403' ), 403 );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get all of the input and files for the request.
     *
     * @return array
     */
    public function data( $keys = null )
    {
        $keys = is_array( $keys ) ? $keys : func_get_args();

        return Collection::make( ( $keys ) ? parent::only( $keys ) : parent::all() );
    }

}
