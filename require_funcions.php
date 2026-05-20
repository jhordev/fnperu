<?php

    function redirect(string $direction = '') {
        \header('Location: ' . $direction);
        die;
    }

    function json($var = \false) {
        echo \json_encode($var);
        die;
    }

    function purify(string $string)
    {
        return htmlspecialchars(strip_tags($string));
    }

    function isAlphabetic(string $string)
    {
        if (ctype_alpha($string) === true) {
            return true;
        }

        $string = str_replace('ñ', '', $string);
        $string = str_replace('Ñ', '', $string);

        if (ctype_alpha($string) === true) {
            return true;
        }

        return false;
    }

    function isAlphaNumeric(string $string)
    {
        if (ctype_alnum($string) === true) {
            return true;
        }

        $string = str_replace('ñ', '', $string);
        $string = str_replace('Ñ', '', $string);
        $string = str_replace('á', '', $string);
        $string = str_replace('é', '', $string);
        $string = str_replace('í', '', $string);
        $string = str_replace('ó', '', $string);
        $string = str_replace('ú', '', $string);
        $string = str_replace('Á', '', $string);
        $string = str_replace('É', '', $string);
        $string = str_replace('Í', '', $string);
        $string = str_replace('Ó', '', $string);
        $string = str_replace('Ú', '', $string);

        if (ctype_alnum($string) === true) {
            return true;
        }

        return false;
    }

    function specialCharacters() {
        return '.-_+*#:@';
    }

    function isAlphaDB_select(string $string)
    {
        if (ctype_alnum($string) === true) {
            return true;
        }

        $string = preg_replace("/\w+/", '', $string);
        $string = str_replace('_', '', $string);
        $string = str_replace('*', '', $string);
        $string = str_replace('.', '', $string);

        if ($string === '') {
            return true;
        }
        return false;
    }

    function isAlphaDash(string $string, string $extras = '')
    {
        if (isAlphaNumeric($string) === true) {
            return true;
        }

        $string = preg_replace("/\w+/", '', $string);
        $string = str_replace('ñ', '', $string);
        $string = str_replace('Ñ', '', $string);
        $string = str_replace('á', '', $string);
        $string = str_replace('é', '', $string);
        $string = str_replace('í', '', $string);
        $string = str_replace('ó', '', $string);
        $string = str_replace('ú', '', $string);
        $string = str_replace('Á', '', $string);
        $string = str_replace('É', '', $string);
        $string = str_replace('Í', '', $string);
        $string = str_replace('Ó', '', $string);
        $string = str_replace('Ú', '', $string);

        $allowedCharacters = specialCharacters();
        $allowedCharacters .= $extras;
        $lengthChart = strlen($allowedCharacters);
        $lengthString = strlen($string);

        for ($i = 0; $i < $lengthString; $i++)
        {
            $found = false;
            for ($indice = 0; $indice < $lengthChart; $indice++)
            {
                if ($allowedCharacters[$indice] == $string[$i]) {
                    $found = true;
                    break;
                }
            }

            if ($found !== true) {
                return false;
            }
        }
        return true;
    }

    function nameForFiles(string $string = '', string $extension = ''): string
    {
        if (trim($extension) != '')
        {
            $string = explode($extension, $string);
            $string = $string[0];
        }

        $countString = strlen($string);
        $abc = 'qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM';
        $countABC =strlen($abc);
        $newString = '';

        for ($index = 0; $index < $countString; $index++)
        {
            for ($indice = 0; $indice < $countABC; $indice++)
            {
                if ($abc[$indice] === $string[$index]) {
                    $newString .= $abc[$indice];
                    break;
                }
            }
        }

        return $newString;
    }

    function getExtension(string $string = '')
    {
        $string = explode('.', $string);
        $count = count($string);

        $string = $string[$count - 1];
        $string = nameForFiles($string);
        return $string;
    }

    function mb_ucfirst(string $str) {
        $fc = mb_strtoupper(mb_substr($str, 0, 1));
        return $fc.mb_substr($str, 1);
    }
