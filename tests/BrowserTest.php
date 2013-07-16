<?php

/**
 * Tests for the {@link Browser}.
 * @author Matt Howlett
 * @package browser-information
 */
class BrowserTest extends SapphireTest {

	/**
	 * Should parse Chrome.
	 */
	public function testShouldParseChrome() {
		$agent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36";
		$browser = Browser::parse($agent);
		$this->assertEquals(Browser::CHROME, $browser->getName());
		$this->assertEquals("27.0", $browser->getVersion());
	}

	/**
	 * Should parse Safari.
	 */
	public function testShouldParseSafari() {
		$agent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/536.30.1 (KHTML, like Gecko) Version/6.0.5 Safari/536.30.1";
		$browser = Browser::parse($agent);
		$this->assertEquals(Browser::SAFARI, $browser->getName());
		$this->assertEquals("6.0", $browser->getVersion());
	}

	/**
	 * Should parse Firefox.
	 */
	public function testShouldParseFirefox() {
		$agent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:22.0) Gecko/20100101 Firefox/22.0";
		$browser = Browser::parse($agent);
		$this->assertEquals(Browser::FIREFOX, $browser->getName());
		$this->assertEquals("22.0", $browser->getVersion());
	}

	/**
	 * Should parse Internet Explorer.
	 */
	public function testShouldParseInternetExplorer() {
		// Internet Explorer 8
		$agent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)";
		$browser = Browser::parse($agent);
		$this->assertEquals(Browser::IE, $browser->getName());
		$this->assertEquals("8.0", $browser->getVersion());
	}

	/**
	 * Should parse Opera.
	 */
	public function testShouldParseOpera() {
		$agent = "Opera/9.80 (Windows NT 6.1; U; en) Presto/2.10.229 Version/11.62";
		$browser = Browser::parse($agent);
		$this->assertEquals(Browser::OPERA, $browser->getName());
		$this->assertEquals(Browser::WINDOWS, $browser->getSystem());
		$this->assertEquals("11.62", $browser->getVersion());
	}

	/**
	 * Should parse iPhone.
	 */
	public function testShouldParseIPhone() {
		// iOS 5
		$agent = "Mozilla/5.0 (iPhone; CPU iPhone OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B179 Safari/7534.48.3";
		$browser = Browser::parse($agent);
		$this->assertEquals(Browser::SAFARI, $browser->getName());
		$this->assertEquals(Browser::HANDHELD, $browser->getDevice());
		$this->assertEquals("5.1", $browser->getVersion());


	}
}