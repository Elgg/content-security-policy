<?php

namespace Elgg\ContentSecurityPolicy;

use PHPUnit_Framework_TestCase as TestCase;

class PolicyTest extends TestCase {
    function testInstancesAreImmutable() {
        $policy = new Policy();
        $this->assertNotSame($policy, $policy->withSource(Directive::SCRIPT_SRC(), Source::ANY));
        $this->assertNotSame($policy, $policy->withoutSource(Directive::DEFAULT_SRC(), Source::NONE));
        $this->assertNotSame($policy, $policy->withSandbox(Sandbox::FORMS()));
        $this->assertNotSame($policy, $policy->withoutSandbox(Sandbox::SCRIPTS()));
        $this->assertNotSame($policy, $policy->withReportUri('/foo'));
        
        $this->assertEquals("default-src 'none'; sandbox", "$policy");
    }

    function testSupportsConfiguringAllStandardSrcDirectives() {
        // These are listed in the Directive enum. An actual test would be pointless
    }
    
    function testCanBeStringifiedIntoStandardCspFormat() {
        $policy = new Policy();
        $this->assertEquals("default-src 'none'; sandbox", "$policy");
        
        $policy = $policy->withReportUri('/foo');
        $this->assertEquals("default-src 'none'; sandbox; report-uri /foo", "$policy");
        
        $policy = $policy->withSandbox(Sandbox::FORMS())->withReportUri(null);
        $this->assertEquals("default-src 'none'; sandbox allow-forms", "$policy");
        
        $policy = $policy->withSource(Directive::SCRIPT_SRC(), Source::ANY);
        $this->assertEquals("default-src 'none'; script-src *; sandbox allow-forms", "$policy");
    }
    
    function testTheDefaultPolicyValueAllowsNothing() {
        $policy = new Policy();
        $this->assertEquals("default-src 'none'; sandbox", "$policy");
    }
}