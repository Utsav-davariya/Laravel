<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use App\Rules\Uppercase;

use Illuminate\Support\Facades\Validator;
use Closure;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array      //validate field
    {
        return [
            // 'name' => ['required', new Uppercase()], //custome validation rule using rule object use many time
            'name' => [                                 // custome validation using method use only one time
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (strtoupper($value) !== $value) {
                        $fail('The :attribute must be uppercase.');
                    }

                }
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()  // over write messages
    {
        return [
            // 'name' => 'Name Is Empty Please Fill It !',
            'email' => 'Email Is Empty Please Fill It !',
            'password' => 'Password Must Required !'
        ];
    }

    // public function attributes(){       // only change attribute name
    //     return [
    //         'name'=> 'user name',
    //         'email'=> 'user email',
    //         'password'=> 'user password'
    //      ];
    // }

    protected function prepareForValidation(): void
    {
        $this->merge([
            // 'name'=> strtoupper($this->name),
            // 'name'=> strtolower($this->name),
            // 'name'=> ucfirst($this->name),
            // 'name'=> Str::slug($this->name),  //virat-kohli

        ]);
    }

    protected $stopOnFirstFailure = true;
}
