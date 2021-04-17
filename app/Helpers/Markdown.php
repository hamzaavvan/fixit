<?php

namespace Fixit\Helpers;

class Markdown {
	public static function bold($string, $pattern = null)
	{
		if (!$pattern)
			$pattern = '/\*\*([A-z0-9\s\w#]+)?\*\*/';

        $markdown = preg_replace($pattern, '<b>$1</b>', $string);

        return $markdown;
	}

	public static function highlight($string, $pattern = null)
	{
		if (!$pattern)
			$pattern = '/\`([A-z0-9\w#\$\(\)]+)?\`/';

        $markdown = preg_replace($pattern, '<span class="highlight">$1</span>', $string);

        return $markdown;
	}

	public static function link($string, $pattern = null)
	{
		if (!$pattern)
            $pattern = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';

        $markdown = preg_replace($pattern, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $string);

        return $markdown;
	}

	
	public static function make($string)
	{
		$string = self::link($string);

        return $string;
	}

	
}