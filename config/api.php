<?php

return [
    /*
    Ссылка на API сайта
    */
    'url' => env('API_URL', 'https://quarta-hunt.ru/bitrix/catalog_export/export_Ngq.xml'),

    'mapped_config' => env('MAPPED_CONFIG', 'mapped-offers-categories.yml'),

    //Для парсинга
    'xml_temporary_file' => 'xml_temporary_file.xml'
];
