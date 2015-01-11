<?php

    /**
     * @brief    Joins contract and awarded lists
     * @param array $contracts_list
     * @param array $awards_list
     * @return array
     */
    function joinLists(array $contracts_list, array $awards_list)
    {
        unset($awards_list[0][0]);
        $final_list[] = array_merge($contracts_list[0], $awards_list[0]);
        for ($i = 1; $i < count($contracts_list); $i ++) {
            $contract_awarded = false;
            for ($j = 1; $j < count($awards_list); $j ++) {
                if ( in_array($contracts_list[$i][0], $awards_list[$j]) ) {
                    unset($awards_list[$j][0]);
                    $final_list[]     = array_merge($contracts_list[$i], $awards_list[$j]);
                    $contract_awarded = true;
                }
            }
            $contract_awarded == false ? $final_list[] = $contracts_list[$i] : '';
        }

        return $final_list;
    }

    /**
     * @brief Gets the total amount for the awarded contract with status 'Current'
     * @param $lists
     * @param $status
     * @return int
     */
    function getTotalAmount($lists, $status = 'Current')
    {
        $total = 0;
        foreach ($lists as $list) {
            ($list[1] == $status && isset($list[12])) ? $total += $list[12] : '';
        }

        return $total;
    }