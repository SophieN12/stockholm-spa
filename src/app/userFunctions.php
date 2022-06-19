<?php
    function redirect($path) {
        header("Location: {$path}");
        exit;
    }

    function declareErrorMessages () {
        $errorMessages = array(
            'first_name'=>"", 
            'last_name'=>"", 
            'street'=>"", 
            'postal_code'=>"", 
            'city'=>"", 
            'country'=>"",
            'phone'=>"", 
            'email'=>"", 
            'password'=>"",
            'confirmPassword'=>"",
            'emailError'=>""
        );

        return $errorMessages;
    }
