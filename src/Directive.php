<?php
namespace Elgg\ContentSecurityPolicy;

use MyCLabs\Enum\Enum;

class Directive extends Enum {
    const CONNECT_SRC = 'connect-src';
    const DEFAULT_SRC = 'default-src';
    const FONT_SRC = 'font-src';
    const FRAME_SRC = 'frame-src';
    const IMAGE_SRC = 'img-src';
    const MEDIA_SRC = 'media-src';
    const OBJECT_SRC = 'object-src';
    const SCRIPT_SRC = 'script-src';
    const STYLE_SRC = 'style-src';
}