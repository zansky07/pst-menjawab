<?php

namespace App\Helpers;

class WAHelper{

    private static $apiKey;

    private static function initApiKey()
    {
        if (!self::$apiKey) {
            self::$apiKey = getenv('API_KEY') ?: $_ENV['API_KEY'];

        }
        return self::$apiKey;
    }


    public static function send_wa_notification($phoneNumber, $message)
    {
        
        $url = 'https://baileyswa.pstmenjawab.my.id/send-message';
        // Memformat nomor telepon
        if ($phoneNumber[0] == '0') {
            $phoneNumber = "62" . ltrim($phoneNumber, $phoneNumber[0]);
        } else if ($phoneNumber[0] == '8') {
            $phoneNumber = "62" . $phoneNumber;
        }

        $message .= "\n\n";
        $message .= "> © PST Menjawab BPS DKI Jakarta, All rights reserved";

        $data = [
            'phoneNumber' => $phoneNumber,
            'message' => $message,
        ];
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'x-api-key: ' .self::initApiKey()
        ]);
    
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
    
        if ($error) {
            log_message('error', "Failed to send WhatsApp message: $error");
            return false;
        }
    
        return json_decode($response, true);
    }
}


