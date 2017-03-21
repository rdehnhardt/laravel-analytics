<?php

namespace Rdehnhardt\Analytics\Services;

class GetParams
{

    /**
     * @param string $q
     *
     * @return array
     */
    public function build($q)
    {
        $q = json_decode($q);
        $params = array();

        if (is_array($q)) {
            foreach ($q as $var) {
                if (array_key_exists(0, $var) && array_key_exists(1, $var)) {
                    $params[$var[0]] = $var[1];
                }
            }
        }

        return $params;
    }

}