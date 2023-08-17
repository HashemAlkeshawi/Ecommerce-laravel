<?php

use App\Jobs\sendCustomizableEmailJob;
use App\Jobs\sendEmailJob;

function sendEmailtoUser($user)
{
    sendEmailJob::dispatch($user);
}
function sendCustomEmailtoUser($user, $subject, $content)
{
    sendCustomizableEmailJob::dispatch($user, $subject, $content);
}
