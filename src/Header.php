<?php
namespace Elgg\ContentSecurityPolicy;

use MyCLabs\Enum\Enum;

class Header extends Enum {
    const EXPERIMENTAL = "X-Content-Security-Policy";
    const EXPERIMENTAL_REPORT_ONLY = "X-Content-Security-Policy-Report-Only";
    const STANDARD = "Content-Security-Policy";
    const STANDARD_REPORT_ONLY = "Content-Security-Policy-Report-Only";
    const WEBKIT = "X-WebKit-CSP";
    const WEBKIT_REPORT_ONLY = "X-WebKit-CSP-Report-Only";
}