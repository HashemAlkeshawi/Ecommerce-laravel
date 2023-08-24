<?php

use App\Jobs\sendCustomizableEmailJob;
use App\Jobs\sendEmailJob;

function sendEmailtoUser($user)
{
    sendEmailJob::dispatch($user);//->onQueue('emails');
}
function sendCustomEmailtoUser($user, $subject, $content)
{
    sendCustomizableEmailJob::dispatch($user, $subject, $content);
}
