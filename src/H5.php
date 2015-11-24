<?php

namespace ML_Express\HTML5;

class H5
{
	private static $htmlClass = '\ML_Express\HTML5\Html5';

	public static function a($content, $href,
			$target = null, $rel = null, $type = null,
			$hreflang = null, $ping = null, $download = null)
	{
		return self::cS()
				->a($content, $href, $target, $rel, $type, $hreflang, $ping, $download)
				->getMarkup();
	}

	public static function em($content)
	{
		return self::cS()->em($content)->getMarkup();
	}

	public static function strong($content)
	{
		return self::cS()->strong($content)->getMarkup();
	}

	public static function small($content)
	{
		return self::cS()->small($content)->getMarkup();
	}

	public static function s($content)
	{
		return self::cS()->s($content)->getMarkup();
	}

	public static function cite($content)
	{
		return self::cS()->cite($content)->getMarkup();
	}

	public static function q($content, $cite = null)
	{
		return self::cS()->q($content, $cite)->getMarkup();
	}

	public static function dfn($content, $title = null)
	{
		return self::cS()->dfn($content, $title)->getMarkup();
	}

	public static function abbr($content, $title = null)
	{
		return self::cS()->abbr($content, $title)->getMarkup();
	}

	public static function data($content, $value = null)
	{
		return self::cS()->data($content, $value)->getMarkup();
	}

	public static function time($content, $datetime = null)
	{
		return self::cS()->time($content, $datetime)->getMarkup();
	}

	public static function code($content)
	{
		return self::cS()->code($content)->getMarkup();
	}

	public static function v($content)
	{
		return self::cS()->v($content)->getMarkup();
	}

	public static function samp($content)
	{
		return self::cS()->samp($content)->getMarkup();
	}

	public static function kbd($content)
	{
		return self::cS()->kbd($content)->getMarkup();
	}

	public static function sub($content)
	{
		return self::cS()->sub($content)->getMarkup();
	}

	public static function sup($content)
	{
		return self::cS()->sup($content)->getMarkup();
	}

	public static function i($content)
	{
		return self::cS()->i($content)->getMarkup();
	}

	public static function b($content)
	{
		return self::cS()->b($content)->getMarkup();
	}

	public static function u($content)
	{
		return self::cS()->u($content)->getMarkup();
	}

	public static function mark($content)
	{
		return self::cS()->mark($content)->getMarkup();
	}

	public static function ruby($content)
	{
		return self::cS()->ruby($content)->getMarkup();
	}

	public static function rt($content)
	{
		return self::cS()->rt($content)->getMarkup();
	}

	public static function rp($content)
	{
		return self::cS()->rp($content)->getMarkup();
	}

	public static function bdi($content, $dir = null)
	{
		return self::cS()->bdi($content, $dir)->getMarkup();
	}

	public static function bdo($content, $dir = null)
	{
		return self::cS()->bdo($content, $dir)->getMarkup();
	}

	public static function span($content)
	{
		return self::cS()->span($content)->getMarkup();
	}

	public static function br()
	{
		return self::cS()->br()->getMarkup();
	}

	public static function wbr()
	{
		return self::cS()->wbr()->getMarkup();
	}

	public static function ins($content, $datetime = null, $cite = null)
	{
		return self::cS()->ins($content, $datetime, $cite)->getMarkup();
	}

	public static function del($content, $datetime = null, $cite = null)
	{
		return self::cS()->del($content, $datetime, $cite)->getMarkup();
	}

	private static function cS()
	{
		$cl = self::$htmlClass;
		return $cl::createSub();
	}
}