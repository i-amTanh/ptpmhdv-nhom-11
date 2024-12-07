<?php

namespace Web\Controllers;

use Admin\Models\RoomModel;

class Home extends BaseController {

    public function index(): string
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://pmhdv.local/api/resort",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array()
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $resort = json_decode($response);

        $data = [
            'resorts' => $resort,
        ];

        return $this->render('index', $data);
    }

    public function detail($id): string
    {
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "http://pmhdv.local/api/room/getroomsbyresortid/".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array()
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $rooms = json_decode($response);

        $data = [
            'rooms' => $rooms,
        ];
        return $this->render('detail_room', $data);
    }

}
