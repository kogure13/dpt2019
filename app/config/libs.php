<?php

function anchor($anchor, $data)
{
    echo '<a ';
    foreach ($anchor as $key => $val) {
        echo $key . $val;
        echo ' ';
    }
    echo '>';
    foreach ($data as $icon => $t) {
        echo '<i class="' . $icon . '"></i> ' . $t;
    };
    echo '</a>';
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

function input($attribut)
{
    echo '<input ';
    foreach ($attribut as $key => $val) {
        echo $val;
        echo ' ';
    }
    echo '>';
}

function select($data = [], $title, $option = [])
{
    echo '<select ';
    foreach ($data as $key => $attrib) {
        echo $attrib;
        echo ' ';
    }
    echo '>';
    echo '<option>' . $title . '</option>';
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
    require_once 'app/views/403.php';
}

function msg($msg)
{
    if ($msg) {
        return "{\"msg\":\"success\"}";
    } else {
        return "{\"msg\":\"failure\"}";
    }
}