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

    $colors = [
        'FORENSICS' => 'bg-success',
        'REVERSE' => 'bg-danger',
        'CRYPTO' => 'bg-dark',
        'PPC' => 'bg-primary',
        'STEGO' => 'bg-teal',
        'WEB' => 'bg-info',
        'RECON' => 'bg-warning',
        'MISC' => 'bg-secondary',
        'JOY' => 'bg-purple',
        'PWN' => 'bg-pink',
    ];