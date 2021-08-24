<?php

namespace App\Http\Requests;

use App\Models\Follow;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FollowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Follow::where('follower_id', Auth::id())->where('followed_id', $this->id)->exists())
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' =>  'required|exists:users,id'
        ];
    }
}
