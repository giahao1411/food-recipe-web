<?php

function isDisposableEmail($email)
{
    $blocklist_path = __DIR__ . '../data/spamEmails/disposable_email_blocklist.conf';
    $disposable_domains = file($blocklist_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $domain = mb_strtolower(explode('@', trim($email))[1]);
    return in_array($domain, $disposable_domains);
    // Source: https://github.com/disposable-email-domains/disposable-email-domains/
}

if ()