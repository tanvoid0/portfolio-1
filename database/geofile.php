<?php
/**
 * Created by PhpStorm.
 * User: Rex
 * Date: 11/26/2017
 * Time: 12:50 AM
 */

    $ip = get_client_ip();

//    $ip = '103.218.189.2';

    $geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));

    $request = $geo['geoplugin_request'];
    $status = $geo['geoplugin_status'];
    $city = $geo['geoplugin_city'];
    $area_code = $geo['geoplugin_areaCode'];
    $dma_code = $geo['geoplugin_dmaCode'];
    $country_code = $geo['geoplugin_countryCode'];
    $country = $geo['geoplugin_countryName'];
    $continent_code = $geo['geoplugin_continentCode'];
    $latitude = $geo['geoplugin_latitude'];
    $longitude = $geo['geoplugin_longitude'];
    $region_code = $geo['geoplugin_regionCode'];
    $region = $geo['geoplugin_region'];
    $currency_code = $geo['geoplugin_currencyCode'];
    $currency_symbol = $geo['geoplugin_currencySymbol'];
    $currency_symbol_utf = $geo['geoplugin_currencySymbol_UTF8'];
    $cur_convert = $geo['geoplugin_currencyConverter'];

//    print_r ($geo);

    $continent = array('AF'=>'Africa', 'AN'=>'Antarctica', 'AS'=>'Asia', 'EU'=>'Europe', 'NA'=>'North America', 'OC'=>'Oceania','SA'=>'South and Central America');

    // request, city, region, countryname, continent, latitude, longitude

    try {
        $now = Date('d-m-Y');

        $query = "SELECT * FROM log ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($db, $query);
        while( ($row = mysqli_fetch_array($result)) or (mysqli_num_rows($result) == 0)) {
            $log_time = Date('d-m-Y', strtotime($row['log_time']));
            $log_time = strtotime($log_time);
            $now = strtotime($now);
//            $now = strtotime(Date('d-m-Y', strtotime('27-11-2017')));

            $diff = floor(($now - $log_time) / 86400);
            if (($ip == '127.0.0.1') or ($diff > 0)) {
                $query = "INSERT INTO log (admin_ip, city, country, latitude, longitude, region, log_time) VALUES ('$ip', '$city', '$country', '$latitude', '$longitude', '$region', Date('d-m-Y h-m-s a'))";
                mysqli_query($db, $query);
            }
        }
    }catch (Exception $exception){
        echo 'Something went wrong!';
        echo "<script>alert('Something went wrong!')</script>";
    }




    //            print_r($geo);
?>