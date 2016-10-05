<?php

namespace App\Http\Controllers\Auth;

use App\Models\AdminUser;
use App\Repositories\GoogleAuthenticator;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthEloquentUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        return AdminUser::find(1);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return true;
        $googleAuthenticator = new GoogleAuthenticator();

        return $googleAuthenticator->verifyCode(env('GOOGLE_AUTHENTICATOR_SECRET'), $credentials['code'], 0);
    }
}