<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class changeWorkDayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        if ($user->role == 'user'){
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Saturday'=> '',
            'Sunday'=> '',
            'Monday'=> '',
            'Tuesday'=> '',
            'Wednesday'=> '',
            'Thursday'=> '',
            'Friday'=> '',
        ];
    }
}
