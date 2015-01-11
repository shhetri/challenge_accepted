<?php

    //include this file to autoload the class and files specified in composer.json
    include 'vendor/autoload.php';

    use App\File;

    $awards_file = new File('awards.csv');
    $awards_list = $awards_file->read();

    $contracts_file = new File('contracts.csv');
    $contracts_list = $contracts_file->read();

    $joined_lists = joinLists($contracts_list, $awards_list);

    $final_file = new File('final.csv');
    $final_file->write($joined_lists);

    echo "Total Amount of current contracts: ", getTotalAmount($joined_lists);