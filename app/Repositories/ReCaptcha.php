<?php

namespace App\Repositories;

class ReCaptcha
{
    use HttpClientTrait;

    public function verify($secret, $response, $remoteIp = null)
    {
        $this->initHttpClient('https://www.google.com');
        $body = $this->requestForm('POST', '/recaptcha/api/siteverify', [
            'secret' => $secret,
            'response' => $response,
            'remoteip' => $remoteIp,
        ]);

        $body = json_decode($body, true);

        if(is_array($body) && isset($body['success']) && $body['success'] == true) {
            return true;
        }

        return false;
    }

}