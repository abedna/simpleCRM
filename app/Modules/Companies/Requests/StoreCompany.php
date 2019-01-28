<?php

namespace App\Modules\Companies\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Zizaco\Entrust\EntrustFacade as Entrust;

class StoreCompany extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Entrust::hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Name' => 'required',
            'email' => 'required|email',
            'website' => 'required|url',
            'logo' => 'required|image',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'url' => 'The website address must have such form: https://domainname.extension '
        ];
    }

}
