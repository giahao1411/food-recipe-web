<?php

function isDisposableEmail($email, $blocklist_path = null)
{
    if (!$blocklist_path) $blocklist_path = __DIR__ . '/disposable_email_blocklist.conf';
    $disposable_domains = file($blocklist_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $domain = mb_strtolower(explode('@', trim($email))[1]);
    return in_array($domain, $disposable_domains);
}

if ()