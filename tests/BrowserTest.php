<?php

/**
 * Tests for the {@link Browser}.
 * @author Matt Howlett
 * @package browser-information
 */
class BrowserTest extends SapphireTest {

	/**
	 * Internet explorer user agent fixtures mapped to their expected information.
	 */
	private static $ie = array(
		"Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)" => array(
			"version"  => "9.0",
			"name"     => "ie",
			"system"   => "windows",
			"engine"   => "trident",
			"device"   => "screen",
			"template" => "windows ie ie9 screen trident"
		),
		"Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)" => array(
			"version"  => "8.0",
			"name"     => "ie",
			"system"   => "windows",
			"engine"   => "trident",
			"device"   => "screen",
			"template" => "windows ie ie8 screen trident"
		),
		"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)" => array(
			"version"  => "7.0",
			"name"     => "ie",
			"system"   => "windows",
			"engine"   => "trident",
			"device"   => "screen",
			"template" => "windows ie ie7 screen trident"
		)
	);

	/**
	 * Firefox user agent fixtures mapped to their expected information.
	 */
	private static $firefox = array(
		"Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0" => array(
			"version"  => "11.0",
			"name"     => "firefox",
			"system"   => "windows",
			"engine"   => "gecko",
			"device"   => "screen",
			"template" => "windows firefox firefox11 screen gecko"
		),
		"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:22.0) Gecko/20100101 Firefox/22.0" => array(
			"version"  => "22.0",
			"name"     => "firefox",
			"system"   => "macintosh",
			"engine"   => "gecko",
			"device"   => "screen",
			"template" => "macintosh firefox firefox22 screen gecko"
		)
	);

	/**
	 * Chrome user agent fixtures mapped to their expected information.
	 */
	private static $chrome = array(
		"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_4) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.46 Safari/536.5" => array(
			"version"  => "19.0",
			"name"     => "chrome",
			"system"   => "macintosh",
			"engine"   => "webkit",
			"device"   => "screen",
			"template" => "macintosh chrome chrome19 screen webkit"
		),
		"Mozilla/5.0 (Windows; Windows NT 6.1) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.46 Safari/536.5" => array(
			"version"  => "19.0",
			"name"     => "chrome",
			"system"   => "windows",
			"engine"   => "webkit",
			"device"   => "screen",
			"template" => "windows chrome chrome19 screen webkit"
		)
	);

	/**
	 * Safari user agent fixtures mapped to their expected information.
	 * @var array
	 */
	private static $safari = array(
		"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_4) AppleWebKit/536.30.1 (KHTML, like Gecko) Version/6.0.5 Safari/536.30.1" => array(
			"version"  => "6.0",
			"name"     => "safari",
			"system"   => "macintosh",
			"engine"   => "webkit",
			"device"   => "screen",
			"template" => "macintosh safari safari6 screen webkit"
		),
		"Mozilla/5.0 (Windows; Windows NT 6.1) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2" => array(
			"version"  => "5.1",
			"name"     => "safari",
			"system"   => "windows",
			"engine"   => "webkit",
			"device"   => "screen",
			"template" => "windows safari safari5 screen webkit"
		),
		"Mozilla/5.0 (iPhone; CPU iPhone OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B179 Safari/7534.48.3" => array(
			"version"  => "5.1",
			"name"     => "safari",
			"system"   => "ios",
			"engine"   => "webkit",
			"device"   => "handheld",
			"template" => "ios safari safari5 handheld webkit"
		),
		"Mozilla/5.0 (iPod; CPU iPhone OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B176 Safari/7534.48.3" => array(
			"version"  => "5.1",
			"name"     => "safari",
			"system"   => "ios",
			"engine"   => "webkit",
			"device"   => "handheld",
			"template" => "ios safari safari5 handheld webkit"
		),
		"Mozilla/5.0 (iPad; CPU OS 5_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B176 Safari/7534.48.3" => array(
			"version"  => "5.1",
			"name"     => "safari",
			"system"   => "ios",
			"engine"   => "webkit",
			"device"   => "handheld",
			"template" => "ios safari safari5 handheld webkit"
		)
	);

	/**
	 * Opera user agent fixtures mapped to their expected information.
	 */
	private static $opera = array(
		"Opera/9.80 (Windows NT 6.1; U; en) Presto/2.10.229 Version/11.62" => array(
			"version"  => "11.62",
			"name"     => "opera",
			"system"   => "windows",
			"engine"   => "presto",
			"device"   => "screen",
			"template" => "windows opera opera11 screen presto"
		)
	);

	/**
	 * Android user agent fixtures mapped to their expected information.
	 * @var array
	 */
	private static $android = array(
		"Mozilla/5.0 (Linux; U; Android 2.2.1; en-us; Nexus One Build/FRG83) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1" => array(
			"version"  => "4.0",
			"name"     => "safari",
			"system"   => "android",
			"engine"   => "webkit",
			"device"   => "handheld",
			"template" => "android safari safari4 handheld webkit"
		),
		"Mozilla/5.0 (Linux; Android 4.0.4; Galaxy Nexus Build/IMM76B) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.133 Mobile Safari/535.19" => array(
			"version"  => "18.0",
			"name"     => "chrome",
			"system"   => "android",
			"engine"   => "webkit",
			"device"   => "handheld",
			"template" => "android chrome chrome18 handheld webkit"
		)
	);

	/**
	 * Google bot user agent fixtures.
	 * @var array
	 */
	private static $googlebot = array(
		"Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)",
		"Googlebot/2.1 (+http://www.googlebot.com/bot.html)",
		"Googlebot/2.1 (+http://www.google.com/bot.html)"
	);

	/**
	 * Should parse Chrome.
	 */
	public function testShouldParseChrome() {
		$this->assertParse(self::$chrome);
	}

	/**
	 * Should parse Safari.
	 */
	public function testShouldParseSafari() {
		$this->assertParse(self::$safari);
	}

	/**
	 * Should parse Firefox.
	 */
	public function testShouldParseFirefox() {
		$this->assertParse(self::$firefox);
	}

	/**
	 * Should parse Internet Explorer.
	 */
	public function testShouldParseInternetExplorer() {
		$this->assertParse(self::$ie);
	}

	/**
	 * Should parse Android.
	 */
	public function testShouldParseAndroid() {
		$this->assertParse(self::$android);
	}

	/**
	 * Should parse Opera.
	 */
	public function testShouldParseOpera() {
		$this->assertParse(self::$opera);
	}

	/**
	 * Should parse Google Bot.
	 */
	public function testShouldParseGoogleBot() {
		foreach (self::$googlebot as $agent) {
			$browser = Browser::parse($agent);
			$this->assertNotNull($browser);
		}
	}

	/**
	 * Asserts all agents in the given array match the expected name, version, system, device, engine
	 * and templated string.
	 * @param array $agents is a map of user agents to their expected values.
	 */
	private function assertParse($agents) {
		foreach ($agents as $agent => $values) {
			$browser = Browser::parse($agent);
			$this->assertEquals($values["name"], $browser->getName());
			$this->assertEquals($values["system"], $browser->getSystem());
			$this->assertEquals($values["device"], $browser->getDevice());
			$this->assertEquals($values["version"], $browser->getVersion());
			$this->assertEquals($values["engine"], $browser->getEngine());
			$this->assertEquals($values["template"], $browser->forTemplate());
		}
	}
}