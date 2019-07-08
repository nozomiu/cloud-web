<?php
    if(!isset($this->session->id)){
        header('Location: /');
        exit();
    }
?>