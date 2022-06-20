<?php
    require('../../src/config.php');
    destroySession();
    redirect('login.php?logout');