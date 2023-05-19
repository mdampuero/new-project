<?php

//
//  Created by Mauricio Ampuero <mdampuero@gmail.com> on 2021.
//

namespace App\BackEndBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * Class ServiceCurl
 *
 * @package App\BackEndBundle\Service
 */
class ServiceCurl
{

    protected $options = array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 10,     // stop after 10 redirects
        CURLOPT_ENCODING => "",     // handle compressed
        CURLOPT_USERAGENT => "test", // name of client
        CURLOPT_AUTOREFERER => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT => 120,    // time-out on response
    );

    /**
     * @return array
     */
    public function get($endpoint){
        $ch = curl_init($endpoint);
        curl_setopt_array($ch, $this->options);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }
    
}