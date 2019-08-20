<?php

function anchor($anchor = [])
{
    echo '<a href="' . $anchor['link'] . '" id="' . $anchor[1] . '"
        class="' . $anchor[2] . '">
        <i class="' . $anchor['icon'] . '"></i> ' . $anchor[0] . '</a>';
}

function button($attribut, $data)
{
    echo '<button ';
    foreach ($attribut as $key => $val) {
        echo $val;
        echo ' ';
    }
    echo '>';
    foreach ($data as $t) {
        echo $t;
    };
    echo '</button>';
}

// function input($data = [])
// {
//     echo '
//         <input type="' . $data['type'] . '" name="' . $data['name'] . '"
//         id="' . $data['id'] . '" class="' . $data['class'] . '"
//         placeholder = "' . $data['placeholder'] . '">
//         ';
// }
function input($attribut = [])
{
    echo '<input ';
    foreach ($attribut as $key => $val) {
        echo $val;
        echo ' ';
    }
    echo '>';
}

function select($data = [], $option = [])
{
    echo '
        <select name="' . $data['name'] . '" id="' . $data['id'] . '"
        class="' . $data['class'] . '">
        ';
    echo '<option>-Choose One-</option>';
    if (count($option) > 0) {
        foreach ($option as $key => $val) {
            echo '<option value="' . $key . '">' . $val . '</option>';
        }
    }
    echo '
        </select>
        ';
}

function textArea($attribut, $text)
{
    echo '<textarea ';
    foreach ($attribut as $key => $val) {
        echo $val;
        echo ' ';
    }
    echo '>';
    foreach ($text as $t) {
        echo $t;
    };
    echo '</textarea>';
}

function batasTanggal($nowDay, $exp)
{

    if (!(strtotime($nowDay) <= time() and time() >= strtotime($exp))) {
        echo 'Batas Waktu Sudah Berakhir';
    } else {
        echo '';
    }
}

function check_login()
{
    require_once '../app/views/403.php';
}

function msg($msg)
{
    if ($msg) {
        return "{\"msg\":\"success\"}";
    } else {
        return "{\"msg\":\"failure\"}";
    }
}