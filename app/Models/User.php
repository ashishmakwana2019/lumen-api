<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Model implements CanResetPasswordContract, AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasRoles, HasApiTokens, SoftDeletes;
    use CanResetPassword;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function findForPassport($username)
    {
        return $user = (new self())->where('email', $username)->orWhere('username', $username)->first();
    }

    /**
     * Notify to user
     * @param $resetPassword
     */
    public function notify($resetPassword)
    {
        try {
            $frontendUrl = config('app.frontend_url');
            $reset_url = "{$frontendUrl}/auth/reset-password/{$resetPassword->token}";
            // TODO : Call jobs or dispatch events for send mail in background
            Mail::raw("Dear user, your reset password link is {$reset_url}", function ($message) {
                $message->from(config('mail.from.address'), config('app.name'));
                $message->to($this->email);
            });
        } catch (\Exception $e) {
            // Handle errors
        }
    }

}
