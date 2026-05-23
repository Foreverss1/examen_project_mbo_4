<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'postal_code' => ['required', 'string', 'max:10'],
            'streetname' => ['required', 'string', 'max:255'],
            'housenumber' => ['required', 'string', 'max:10'],
            'city' => ['required', 'string', 'max:100'],
            'role_id' => ['', 'integer'],

            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role_id' => 3,
            'postal_code' => $input['postal_code'],
            'streetname' => $input['streetname'],
            'housenumber' => $input['housenumber'],
            'city' => $input['city'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
