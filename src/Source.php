<?php

namespace Elgg\ContentSecurityPolicy;

class Source {
    const ANY = "*";
    const DATA = "data:";
    const HTTPS = "https:";
    const NONE = "'none'";
    const SELF = "'self'";
    const UNSAFE_INLINE = "'unsafe-inline'";
    const UNSAFE_EVAL = "'unsafe-eval'";
}