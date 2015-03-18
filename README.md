# Content Security Policy (CSP) support for PHP

Installation:

```
composer require elgg/content-security-policy
```

Example usage:

```php
use Elgg\ContentSecurityPolicy\Directive;
use Elgg\ContentSecurityPolicy\Header;
use Elgg\ContentSecurityPolicy\Policy;
use Elgg\ContentSecurityPolicy\Source;

$policy = new Policy();
$policy = $policy->withSource(Directive::DEFAULT_SRC(), Source::SELF)
            ->withSource(Directive::IMAGE_SRC(), Source::DATA);
            
header(Header::STANDARD . ": $policy");
// Sends "Content-Security-Policy: default-src 'self'; img-src data:"
```

By default, the policy blocks everything it possibly can.
This is by design to ensure that your site only allows what you want to allow,
not what someone else thinks is a reasonable default.

```php
$policy = new Policy();
echo $policy; // default-src 'none'; sandbox
```

Features:

```
Elgg\ContentSecurityPolicy\Policy
 [x] Instances are immutable
 [x] Supports configuring all standard src directives
 [x] Can be stringified into standard csp format
 [x] The default policy value allows nothing
```
