<?php

if (!function_exists('mb_trim')) {
    /* Source https://github.com/PHP-Polyfills/mb_trim/blob/main/src/mb_trim.php */
    /**
     * Multi-byte safely strip white-spaces (or other characters) from the beginning and end of a string.
     *
     * @param string $string The string that will be trimmed.
     * @param string $characters Optionally, the stripped characters can also be specified using the $characters parameter. Simply list all characters that you want to be stripped.
     * @param string|null $encoding The encoding parameter is the character encoding.
     *
     * @return string The trimmed string.
     */
    function mb_trim(string $string, string $characters = " \f\n\r\t\v\x00\u{00A0}\u{1680}\u{2000}\u{2001}\u{2002}\u{2003}\u{2004}\u{2005}\u{2006}\u{2007}\u{2008}\u{2009}\u{200A}\u{2028}\u{2029}\u{202F}\u{205F}\u{3000}\u{0085}\u{180E}", ?string $encoding = null): string
    {
        // On supported versions, use a pre-calculated regex for performance.
        if (PHP_VERSION_ID >= 80200 && ($encoding === null || $encoding === "UTF-8") && $characters === " \f\n\r\t\v\x00\u{00A0}\u{1680}\u{2000}\u{2001}\u{2002}\u{2003}\u{2004}\u{2005}\u{2006}\u{2007}\u{2008}\u{2009}\u{200A}\u{2028}\u{2029}\u{202F}\u{205F}\u{3000}\u{0085}\u{180E}") {
            return (string)preg_replace("/^[\s\0]+|[\s\0]+$/uD", '', $string);
        }

        try {
            @mb_check_encoding('', $encoding);
        } catch (ValueError $e) {
            throw new ValueError(sprintf('%s(): Argument #3 ($encoding) must be a valid encoding, "%s" given', __FUNCTION__, $encoding));
        }

        if ($characters === "") {
            return $string;
        }

        if ($encoding !== null && $encoding !== 'UTF-8') {
            $string = mb_convert_encoding($string, "UTF-8", $encoding);
            $characters = mb_convert_encoding($characters, "UTF-8", $encoding);
        }

        /*
        $charMap = array_map(static fn(string $char): string => preg_quote($char, '/'), mb_str_split($characters));
        $regexClass = implode('', $charMap);
        $regex = "/^[" . $regexClass . "]+|[" . $regexClass . "]+$/uD";
        */
        $characters = preg_quote($characters, '/');
        $regex = '/^[' . $characters . ']+|[' . $characters . ']+$/uD';

        $return = preg_replace($regex, '', $string);

        if ($encoding !== null && $encoding !== 'UTF-8') {
            $return = mb_convert_encoding($return, $encoding, "UTF-8");
        }

        return $return;
    }
}

if (!function_exists('mb_ltrim')) {
    /* Source https://github.com/PHP-Polyfills/mb_trim/blob/main/src/mb_trim.php */
    /**
     * Multi-byte safely strip white-spaces (or other characters) from the beginning of a string.
     *
     * @param string $string The string that will be trimmed.
     * @param string $characters Optionally, the stripped characters can also be specified using the $characters parameter. Simply list all characters that you want to be stripped.
     * @param string|null $encoding The encoding parameter is the character encoding.
     *
     * @return string The trimmed string.
     */
    function mb_ltrim(string $string, string $characters = " \f\n\r\t\v\x00\u{00A0}\u{1680}\u{2000}\u{2001}\u{2002}\u{2003}\u{2004}\u{2005}\u{2006}\u{2007}\u{2008}\u{2009}\u{200A}\u{2028}\u{2029}\u{202F}\u{205F}\u{3000}\u{0085}\u{180E}", ?string $encoding = null): string
    {
        // On supported versions, use a pre-calculated regex for performance.
        if (PHP_VERSION_ID >= 80200 && ($encoding === null || $encoding === "UTF-8") && $characters === " \f\n\r\t\v\x00\u{00A0}\u{1680}\u{2000}\u{2001}\u{2002}\u{2003}\u{2004}\u{2005}\u{2006}\u{2007}\u{2008}\u{2009}\u{200A}\u{2028}\u{2029}\u{202F}\u{205F}\u{3000}\u{0085}\u{180E}") {
            return preg_replace("/^[\s\0]+/u", '', $string);
        }

        try {
            @mb_check_encoding('', $encoding);
        } catch (ValueError $e) {
            throw new ValueError(sprintf('%s(): Argument #3 ($encoding) must be a valid encoding, "%s" given', __FUNCTION__, $encoding));
        }

        if ($characters === "") {
            return $string;
        }

        if ($encoding !== null && $encoding !== 'UTF-8') {
            $string = mb_convert_encoding($string, "UTF-8", $encoding);
            $characters = mb_convert_encoding($characters, "UTF-8", $encoding);
        }

        $charMap = array_map(static fn(string $char): string => preg_quote($char, '/'), mb_str_split($characters));
        $regexClass = implode('', $charMap);
        $regex = "/^[" . $regexClass . "]+/u";

        $return = preg_replace($regex, '', $string);

        if ($encoding !== null && $encoding !== 'UTF-8') {
            $return = mb_convert_encoding($return, $encoding, "UTF-8");
        }

        return $return;
    }
}

if (!function_exists('mb_rtrim')) {
    /* Source https://github.com/PHP-Polyfills/mb_trim/blob/main/src/mb_trim.php */
    /**
     * Multi-byte safely strip white-spaces (or other characters) from the end of a string.
     *
     * @param string $string The string that will be trimmed.
     * @param string $characters Optionally, the stripped characters can also be specified using the $characters parameter. Simply list all characters that you want to be stripped.
     * @param string|null $encoding The encoding parameter is the character encoding.
     *
     * @return string The trimmed string.
     */
    function mb_rtrim(string $string, string $characters = " \f\n\r\t\v\x00\u{00A0}\u{1680}\u{2000}\u{2001}\u{2002}\u{2003}\u{2004}\u{2005}\u{2006}\u{2007}\u{2008}\u{2009}\u{200A}\u{2028}\u{2029}\u{202F}\u{205F}\u{3000}\u{0085}\u{180E}", ?string $encoding = null): string
    {
        // On supported versions, use a pre-calculated regex for performance.
        if (PHP_VERSION_ID >= 80200 && ($encoding === null || $encoding === "UTF-8") && $characters === " \f\n\r\t\v\x00\u{00A0}\u{1680}\u{2000}\u{2001}\u{2002}\u{2003}\u{2004}\u{2005}\u{2006}\u{2007}\u{2008}\u{2009}\u{200A}\u{2028}\u{2029}\u{202F}\u{205F}\u{3000}\u{0085}\u{180E}") {
            return preg_replace("/[\s\0]+$/uD", '', $string);
        }

        try {
            @mb_check_encoding('', $encoding);
        } catch (ValueError $e) {
            throw new ValueError(sprintf('%s(): Argument #3 ($encoding) must be a valid encoding, "%s" given', __FUNCTION__, $encoding));
        }

        if ($characters === "") {
            return $string;
        }

        if ($encoding !== null && $encoding !== 'UTF-8') {
            $string = mb_convert_encoding($string, "UTF-8", $encoding);
            $characters = mb_convert_encoding($characters, "UTF-8", $encoding);
        }

        $charMap = array_map(static fn(string $char): string => preg_quote($char, '/'), mb_str_split($characters));
        $regexClass = implode('', $charMap);
        $regex = "/[" . $regexClass . "]+$/uD";

        $return = preg_replace($regex, '', $string);

        if ($encoding !== null && $encoding !== 'UTF-8') {
            $return = mb_convert_encoding($return, $encoding, "UTF-8");
        }

        return $return;
    }
}
if (!function_exists('mb_str_replace')) {
    function mb_str_replace($search, $replace, $subject, &$count = 0)
    {
        if (!is_array($subject)) {
            $searches = is_array($search) ? array_values($search) : array($search);
            $replacements = is_array($replace) ? array_values($replace) : array($replace);
            $replacements = array_pad($replacements, count($searches), '');
            foreach ($searches as $key => $search) {
                $parts = mb_split(preg_quote($search), $subject);
                $count += count($parts) - 1;
                $subject = implode($replacements[$key], $parts);
            }
        } else {
            foreach ($subject as $key => $value) {
                $subject[$key] = mb_str_replace($search, $replace, $value, $count);
            }
        }
        return $subject;
    }
}

if (!function_exists('mb_str_contains')) {
    function mb_str_contains(string $haystack, string $needle): bool
    {
        return mb_strpos($haystack, $needle) !== false;
    }
}


if (!function_exists('mb_str_ends_with')) {
    function mb_str_ends_with(string $haystack, string $needle): bool
    {
        return mb_substr($haystack, -mb_strlen($needle)) === $needle;
    }
}

if (!function_exists('mb_str_replace')) {
    function mb_str_starts_with(string $haystack, string $needle): bool
    {
        return mb_substr($haystack, mb_strlen($needle)) === $needle;
    }
}


if (!function_exists('mb_ucfirst')) {
    /* Source https://github.com/PHP-Polyfills/mb_ucfirst-lcfirst/blob/main/src/mb_ucfirst_lcfirst.php */
    /**
     * Make a string's first character uppercase multi-byte safely.
     */
    function mb_ucfirst(string $string, ?string $encoding = null): string
    {
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $firstChar = mb_convert_case($firstChar, MB_CASE_TITLE, $encoding);

        return $firstChar . mb_substr($string, 1, null, $encoding);
    }
}

if (!function_exists('mb_lcfirst')) {
    /* Source https://github.com/PHP-Polyfills/mb_ucfirst-lcfirst/blob/main/src/mb_ucfirst_lcfirst.php */
    /**
     * Make a string's first character lowercase multi-byte safely.
     */
    function mb_lcfirst(string $string, ?string $encoding = null): string
    {
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $firstChar = mb_convert_case($firstChar, MB_CASE_LOWER, $encoding);

        return $firstChar . mb_substr($string, 1, null, $encoding);
    }
}
