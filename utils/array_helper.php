<?php
    function array_sort($result) {

        function cmp($a, $b) {
            if ($a['points'] > $b['points'])
                return -1;
            elseif ($a['points'] < $b['points'])
                return 1;
            else {
                return ($a['solv_time'] < $b['solv_time']) ? -1 : 1;
            }
        }

        uasort($result, 'cmp');
        return $result;
    }