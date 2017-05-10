<?php
declare(strict_types=1);
namespace SONFin\Models;


use Illuminate\Database\Eloquent\Model;
use Jasny\Auth\User as JasnyUser;

class User extends Model implements JasnyUser
{
    //Mass Assigment
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];

    /**
     * Get user id
     *
     * @return int|string
     */
    public function getId()
    {
        // TODO: Implement getId() method.
    }

    /**
     * Get user's username
     *
     * @return string
     */
    public function getUsername() : string
    {
        // TODO: Implement getUsername() method.
    }

    /**
     * Get user's hashed password
     *
     * @return string
     */
    public function getHashedPassword() : string
    {
        return $this->password;
    }

    /**
     * Event called on login.
     *
     * @return boolean  false cancels the login
     */
    public function onLogin()
    {
        // TODO: Implement onLogin() method.
    }

    /**
     * Event called on logout.
     *
     * @return void
     */
    public function onLogout()
    {
        // TODO: Implement onLogout() method.
    }
}