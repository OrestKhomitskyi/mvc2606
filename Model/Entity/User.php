<?php
namespace Model\Entity;

use Framework\AccessDeniedException;
use Framework\Session;

class User implements IEntity
{
    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    private $id;
    private $email;
    private $password;
    private $name;
    private $role;
    private $active;
    private $activationHash;
    private $api_key;

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->api_key;
    }

    /**
     * @param mixed $api_key
     */
    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param mixed $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param mixed $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * @param mixed $role
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }
    /**
     * @param mixed $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getActivationHash()
    {
        return $this->activationHash;
    }
    /**
     * @param mixed $activationHash
     * @return $this
     */
    public function setActivationHash($activationHash)
    {
        $this->activationHash = $activationHash;
        return $this;
    }
    public static function auth(){
        $user=Session::get('user');
        if($user){
            return $user;
        }
        return null;
    }
    public static function guard(){
        if(!self::auth()){
            throw new AccessDeniedException();
        }
    }
    public static function isAdmin(){
        if(self::auth()->role==self::ROLE_ADMIN)
            return true;
            else return false;
    }
}