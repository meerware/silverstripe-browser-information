<?php

/**
 * Browser information in terms of device, operating system, name and version.
 * @author Matt Howlett
 * @package browser-information
 */
class Browser extends ViewableData {

	/**
	 * Unknown value, used for name or system when we can't get a match.
	 * @var string
	 */
	const UNKNOWN = "unknown";

	/**
	 * Screen device type.
	 * @var string
	 */
	const SCREEN = "screen";

	/**
	 * Handheld device type, mobile or tablet.
	 * @var string
	 */
	const HANDHELD = "handheld";

	/**
	 * Linux operating system.
	 * @var string
	 */
	const LINUX = "linux";

	/**
	 * Macintosh operating system.
	 * @var string
	 */
	const MACINTOSH = "macintosh";

	/**
	 * Windows operating system.
	 * @var string
	 */
	const WINDOWS = "windows";

	/**
	 * Android operating system.
	 * @var string
	 */
	const ANDROID = "android";

	/**
	 * iOS operating system (iPad, iPod and iPhone).
	 * @var string
	 */
	const IOS = "ios";

	/**
	 * Intenet explorer.
	 * @var string
	 */
	const IE = "ie";

	/**
	 * Firefox browser.
	 * @var string
	 */
	const FIREFOX = "firefox";

	/**
	 * Chrome browser.
	 * @var string.
	 */
	const CHROME = "chrome";

	/**
	 * Safari browser.
	 * @var string
	 */
	const SAFARI = "safari";

	/**
	 * Opera browser.
	 * @var string
	 */
	const OPERA = "opera";

	/**
	 * Netscape browser.
	 * @var string
	 */
	const NETSCAPE = "netscape";

	/**
	 * Konqueror browser.
	 * @var string
	 */
	const KONQUEROR = "konqueror";

	/**
	 * Current browser.
	 * @var Browser
	 */
	private static $browser = null;

	/**
	 * Browser name.
	 * @var string
	 */
	private $name = self::UNKNOWN;

	/**
	 * System name.
	 * @var string
	 */
	private $system = self::UNKNOWN;

	/**
	 * Device type.
	 * @var string
	 */
	private $device = self::SCREEN;

	/**
	 * Browser version.
	 * @var string
	 */
	private $version = null;

	/**
	 * @return Browser Returns the current browser as indicated by the user agent.
	 */
	public static function current_browser() {
		if (self::$browser) {
			return self::$browser;
		}
		self::$browser = self::parse();
		return self::$browser;
	}

	/**
	 * @param string $agent is the optional user agent. This will default to the one defined by the server.
	 * @return Browser
	 */
	public static function parse($agent = false) {
		$agent = strtolower($agent ? $agent : $_SERVER['HTTP_USER_AGENT']);

		$browser = new Browser();

		// System
		if (preg_match('/linux/i', $agent)) {
			$browser->system = self::LINUX;
		} elseif (preg_match('/ipod|iphone|ipad/i', $agent)) {
			$browser->system = self::IOS;
			$browser->device = self::HANDHELD;
		} elseif (preg_match('/andriod/i', $agent)) {
			$browser->system = self::ANDROID;
			$browser->device = self::HANDHELD;
		} elseif (preg_match('/macintosh|mac os x/i', $agent)) {
			$browser->system = self::MACINTOSH;
		} elseif (preg_match('/windows|win32/i', $agent)) {
			$browser->system = self::WINDOWS;
		}

		// Name
		$known = array('msie', self::FIREFOX, self::CHROME, self::SAFARI, self::OPERA, self::NETSCAPE, self::KONQUEROR);
		$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9]+(?:\.[0-9]+)?)#';
		if (!preg_match_all($pattern, $agent, $matches)) {
			return $browser;
		}

		$index = 0;
		$count = count($matches['browser']);
		for ($i = 0; $i < $count; $i++) {
			$index = $i;
			if ($matches['browser'][$i] == self::CHROME) {
				break;
			}
		}
		$browser->name = ($matches['browser'][$index] == "msie") ? self::IE : $matches['browser'][$index];


		// Version
		$split = preg_split("/\./", $matches['version'][$index]);

		$version = null;
		if (count($split) > 0) {
			$version = $split[0];
		}
		if (count($split) > 1) {
			$version = $version . "." . $split[1];
		}

		// Version
		if ($version) {
			$browser->version = $version;
		}

		return $browser;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getSystem() {
		return $this->system;
	}

	/**
	 * @return string
	 */
	public function getDevice() {
		return $this->device;
	}

	/**
	 * @return boolean
	 */
	public function isHandheld() {
		return $this->getDevice() != self::SCREEN;
	}

	/**
	 * @return string
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * Returns a string which can be used as a CSS class.
	 * @return string
	 */
	public function forTemplate() {
		$template = array();

		// System
		if ($this->system) {
			$template[] = $this->system;
		}

		// Name and version
		if ($this->name) {
			$template[] = $this->name;
			$version = $this->version;
			if ($version) {
				$split = preg_split("/\./", $this->version);
				if (count($split) > 0) {
					// Name plus major version
					$template[] = $this->name . $split[0];
				}
			}
		}

		if ($this->device) {
			$template[] = $this->device;
		}
		return join(' ', $template);
	}

}