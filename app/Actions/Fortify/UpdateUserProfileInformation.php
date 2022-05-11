<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param mixed $user
     * @param array $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'country' => ['sometimes'],
            'state' => ['sometimes'],
            'city' => ['sometimes'],
            'gender' => ['required'],
            'date_of_birth' => ['required'],
            'avatar' => ['sometimes'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ])->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $data = [
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'gender' => $input['gender'],
                'date_of_birth' => $input['date_of_birth'],
                'email' => $input['email'],
            ];

            if (isset($input['country'])) {
                $data['country'] = $input['country'];
            }

            if (isset($input['state'])) {
                $data['state'] = $input['state'];
            }

            if (isset($input['city'])) {
                $data['city'] = $input['city'];
            }

            if (isset($input['avatar'])) {
                if ($user->avatar !== 'default/avatar.jpg') {
                    Storage::disk('public')->delete($user->avatar);
                }

                $data['avatar'] = Storage::disk('public')->putFile('avatars', $input['avatar']);
            }

            $user->forceFill($data)->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param mixed $user
     * @param array $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $data = [
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'gender' => $input['gender'],
            'date_of_birth' => $input['date_of_birth'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ];

        if (isset($input['country'])) {
            $data['country'] = $input['country'];
        }

        if (isset($input['state'])) {
            $data['state'] = $input['state'];
        }

        if (isset($input['city'])) {
            $data['city'] = $input['city'];
        }

        $user->forceFill($data)->save();
        $user->sendEmailVerificationNotification();
    }
}
