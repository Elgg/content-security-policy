<?php
namespace Elgg\ContentSecurityPolicy;

use MyCLabs\Enum\Enum;

class Sandbox extends Enum {
    const FORMS = 'allow-forms';
    const SAME_ORIGIN = 'allow-same-origin';
    const SCRIPTS = 'allow-scripts';
    const TOP_NAVIGATION = 'allow-top-navigation';
}