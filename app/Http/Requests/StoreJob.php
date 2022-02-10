<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJob extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required',
            'completed_note' => '',
            'boat_id' => '',
            'assigned_user_id' => '',
            'priority' => ''
        ];
    }
}
