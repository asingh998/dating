<?php

/**
 * Class Validate
 * Contains the validation methods for my app
 * @author Arshdeep Singh
 * @version 1.0
 */
class Validation
{
    function validEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else{
            return false;
        }
    }

    function validName($first)
    {
        if(!empty($first) && ctype_alpha($first)) {
            return true;
        }
        else {
            return false;
        }
    }

    function validLname($last)
    {
        if(!empty($last) && ctype_alpha($last)) {
            return true;
        }
        else {
            return false;
        }
    }

    function validPhone($phone)
    {
        if(preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $phone)) {
            return true;
        }
        else {
            return false;
        }
    }

    function validAge($age)
    {
        if ($age > 18 && $age < 118) {
            return true;
        } else {
            return false;
        }
    }

    function validIndoor($selectedInterests)
    {
        //If no interests are selected, return true
        if(empty($selectedInterests))
            return true;

        $interests = getInterests();

        foreach($selectedInterests as $selected) {
            if(!in_array($selected, $interests)){
                return false;
            }
        }
        return true;
    }

    function validOutdoor($selectedInterests)
    {
        //If no interests are selected, return true
        if(empty($selectedInterests))
            return true;

        $outinterests = getOutInterests();

        foreach($selectedInterests as $selected) {
            if(!in_array($selected, $outinterests)){
                return false;
            }
        }
        return true;
    }
}