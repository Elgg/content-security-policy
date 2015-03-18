<?php
namespace Elgg\ContentSecurityPolicy;

class Policy {
    
    /** @var Map<Directive,Set<string>> */
    private $directives;
    
    /** @var ?string */
    private $reportUri;
    
    /** @var Set<SandboxOption> */
    private $sandbox;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->directives = [
            Directive::CONNECT_SRC => [],
            Directive::DEFAULT_SRC => [Source::NONE => true],
            Directive::FONT_SRC => [],
            Directive::FRAME_SRC => [],
            Directive::IMAGE_SRC => [],
            Directive::MEDIA_SRC => [],
            Directive::OBJECT_SRC => [],
            Directive::SCRIPT_SRC => [],
            Directive::STYLE_SRC => [],
        ];

        $this->reportUri = null;

        $this->sandbox = [];
    }
    
    /**
     * Returns a new policy with the given value added to the specified src directive.
     * 
     * This also transparently handles the 'none' value. If you specify it,
     * all other values will be removed. If you don't, any existing "'none'" value
     * will be removed.
     * 
     * @param Directive $directive
     * @param string    $value
     * 
     * @return self
     */
    public function withSource(Directive $directive, $value) {
        $newCsp = clone $this;

        if ("$value" == Source::NONE) {
            $newCsp->directives["$directive"] = [Source::NONE => true];
        } else {
            $newCsp->directives["$directive"]["$value"] = true;
            unset($newCsp->directives["$directive"][Source::NONE]);
        }
        
        return $newCsp;
    }
    
    /**
     * Returns a new policy with the given value removed the specified *-src directive.
     * 
     * @param Directive $directive
     * @param string    $value
     * 
     * @return self
     */
    public function withoutSource(Directive $directive, $value) {
        $newCsp = clone $this;

        unset($newCsp->directives["$directive"]["$value"]);
        
        return $newCsp;
    }
    
    /**
     * Returns a new policy with the sandbox 
     * 
     * @param Sandbox $value
     * 
     * @return self
     */
    public function withSandbox(Sandbox $value) {
        $newCsp = clone $this;

        $newCsp->sandbox["$value"] = true;
        
        return $newCsp;
    }
    
    /**
     * Removes a value from the sandbox directive.
     * 
     * @param Sandbox $value
     * 
     * @return self
     */
    public function withoutSandbox(Sandbox $value) {
        $newCsp = clone $this;

        unset($newCsp->sandbox["$value"]);
        
        return $newCsp;
    }

    /**
     * Returns a new policy with the report uri set the given value.
     * 
     * @param string $uri
     * 
     * @return self
     */
    public function withReportUri($uri) {
        $newCsp = clone $this;
        
        $newCsp->reportUri = $uri;
        
        return $newCsp;
    }
    
    /**
     * @return string String form appropriate for sending in the HTTP header
     */
    public function __toString() {
        $directives = [];
        
        foreach ($this->directives as $directive => $values) {
            if (!empty($values)) {
                $directives[] = "$directive " . implode(" ", array_keys($values));
            }
        }
        
        $directives[] = trim("sandbox " . implode(' ', array_keys($this->sandbox)));
        
        if (!empty($this->reportUri)) {
            $directives[] = "report-uri {$this->reportUri}";
        }
        
        return implode("; ", $directives);
    }
}