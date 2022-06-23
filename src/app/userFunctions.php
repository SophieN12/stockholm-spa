<?php
    function destroySession () {
        $_SESSION = [];
        session_destroy();
    }
