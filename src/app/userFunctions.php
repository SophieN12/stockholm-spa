<?php
    function redirect($path) {
        header("Location: {$path}");
        exit;
    }

    function destroySession () {
        $_SESSION = [];
        session_destroy();
    }
