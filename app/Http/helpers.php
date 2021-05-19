<?php

function pr($array, $bool=false){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    if($bool){
        exit();
    }
}
