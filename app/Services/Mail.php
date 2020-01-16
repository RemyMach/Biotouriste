<?php


namespace App\Services;


use App\Mail\UserForgotPassword;
use Illuminate\Support\Facades\Mail as SendMail;

class Mail
{

    public function send(string $destination,string $template,array $data)
    {
        $baseTemplate = '\App\Mail\\';
        $template = $baseTemplate . $template;
        SendMail::to($destination)->send(new $template($data));
    }
}