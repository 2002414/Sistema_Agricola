<?php

function Mensaje(

    $tipo,
    $texto

){

    echo "

    <div
        class='alert alert-$tipo alert-dismissible fade show'
        role='alert'
    >

        $texto

        <button
            type='button'
            class='btn-close'
            data-bs-dismiss='alert'
        >

        </button>

    </div>

    ";

}

?>