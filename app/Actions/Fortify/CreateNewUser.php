<?php

namespace App\Actions\Fortify;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            // 'role' => ['required'],
        ])->validate();

        $user = User::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'country' => $input['country'],
            'state' => $input['state'],
            'city' => $input['city'],
            'gender' => $input['gender'],
            'date_of_birth' => $input['date_of_birth'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            // 'role' => $input['role'],
        ]);

        $user->createAsStripeCustomer();

        return $user;
    }
}
