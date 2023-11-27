<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_store()
{
    $list_store = array(
        [
            'nama_store' => 'Gudang Online',
            'id_store' => 100
        ],
        [
            'nama_store' => 'Gudang Online PIK',
            'id_store' => 200
        ],
    );
    
    return $list_store;
}
