<?php


class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    public function __construct($first = "", $last = "", $age = "", $gender = "",
                            $phone = "", $email = "", $state = "", $seeking = "", $bio = "")
    {
        $this->setFirst($first);
        $this->setLast($last);
        $this->setAge($age);
        $this->setGender($gender);
        $this->setPhone($phone);
        $this->setEmail($email);
        $this->setState($state);
        $this->setSeeking($seeking);
        $this->setBio($bio);
    }

    public function setFirst($first)
    {
        $this->_fname = $first;
    }

    public function setLast($last)
    {
        $this->_lname = $last;
    }

    public function setAge($age)
    {
        $this->_age = $age;
    }

    public function setGender($gend)
    {
        $this->_gender = $gend;
    }

    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function setState($state)
    {
        $this->_state = $state;
    }

    public function setSeeking($seek)
    {
        $this->_seeking = $seek;
    }

    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}