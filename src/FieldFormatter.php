<?php

namespace Penobit\Revisionable;

/**
 * FieldFormatter.
 *
 * Allows formatting of fields
 *
 * (c) Penobit <http://www.penobit.com>
 */

/**
 * Class FieldFormatter.
 */
class FieldFormatter {
    /**
     * Format the value according to the provided formats.
     *
     * @return string formatted value
     */
    public static function format($key, $value, $formats) {
        foreach ($formats as $pkey => $format) {
            $parts = explode(':', $format);
            if (sizeof($parts) === 1) {
                continue;
            }

            if ($pkey == $key) {
                $method = array_shift($parts);

                if (method_exists(get_class(), $method)) {
                    return self::$method($value, implode(':', $parts));
                }

                break;
            }
        }

        return $value;
    }

    /**
     * Check if a field is empty.
     *
     * @param array $options
     *
     * @return string
     */
    public static function isEmpty($value, $options = []) {
        $value_set = isset($value) && '' != $value;

        return sprintf(self::boolean($value_set, $options), $value);
    }

    /**
     * Boolean.
     *
     * @param array $options The false / true values to return
     *
     * @return string Formatted version of the boolean field
     */
    public static function boolean(mixed $value, mixed $options = null): string {
        if (!is_null($options) && is_string($options)) {
            $options = explode('|', $options);
        }

        if (sizeof($options) != 2) {
            $options = ['No', 'Yes'];
        }

        return $options[(bool) $value];
    }

    /**
     * Format the string response, default is to just return the string.
     *
     * @param null|mixed $format
     *
     * @return formatted string
     */
    public static function string($value, $format = null) {
        if (is_null($format)) {
            $format = '%s';
        }

        return sprintf($format, $value);
    }

    /**
     * Format the datetime.
     *
     * @param string $value
     * @param string $format
     *
     * @return formatted datetime
     */
    public static function datetime($value, $format = 'Y-m-d H:i:s') {
        if (empty($value)) {
            return null;
        }

        $datetime = new \DateTime($value);

        return $datetime->format($format);
    }

    /**
     * Format options.
     *
     * @param string $value
     * @param string $format
     *
     * @return string
     */
    public static function options($value, $format) {
        $options = explode('|', $format);

        $result = [];

        foreach ($options as $option) {
            $transform = explode('.', $option);
            $result[$transform[0]] = $transform[1];
        }

        if (isset($result[$value])) {
            return $result[$value];
        }

        return 'undefined';
    }
}
