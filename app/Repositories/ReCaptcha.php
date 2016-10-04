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

        return $body;
    }

}