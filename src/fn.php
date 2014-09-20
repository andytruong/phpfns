<?php

use AndyTruong\Yaml\YamlDumper;
use AndyTruong\Yaml\YamlParser;
use Zend\EventManager\EventManager;

/**
 * Can not: new Thing()->doStuff();
 * But: at_id(new Thing())->doStuff();
 */
if (!function_exists('at_id')) {

    function at_id($x)
    {
        return $x;
    }

}

/**
 * Invokes the "new" operator with a vector of arguments. There is no way to
 * call_user_func_array() on a class constructor, so you can instead use this
 * function:
 *
 * $obj = at_newv($class_name, $argv);
 *
 * That is, these two statements are equivalent:
 *
 * $pancake = new Pancake('Blueberry', 'Maple Syrup', true);
 * $pancake = newv('Pancake', array('Blueberry', 'Maple Syrup', true));
 *
 * @param  string  The name of a class.
 * @param  list    Array of arguments to pass to its constructor.
 * @return obj     A new object of the specified class, constructed by passing
 *                  the argument vector to its constructor.
 */
function at_newv($class_name, $argv = array())
{
    $reflector = new ReflectionClass($class_name);
    if ($argv) {
        return $reflector->newInstanceArgs($argv);
    }
    return $reflector->newInstance();
}

/**
 * Camelizes a given string.
 *
 * @param  string $string Some string
 *
 * @return string The camelized version of the string
 */
function at_camelize($string)
{
    return preg_replace_callback('/(^|_|\.)+(.)/', function ($match) {
        return ('.' === $match[1] ? '_' : '') . strtoupper($match[2]);
    }, $string);
}

/**
 * Helper function easy access array item:
 *
 * Use echo at_array_item($array, 'path.to.item');
 * instead of echo $array['path']['to']['item];
 *
 * @param array $array
 * @param string $path
 * @param mixed $defaultValue
 * @return mixed
 */
function at_array_item(array $array, $path, $defaultValue = null)
{
    $current = $array;
    $p = strtok($path, '.');

    while ($p !== false) {
        if (!isset($current[$p])) {
            return $defaultValue;
        }
        $current = $current[$p];
        $p = strtok('.');
    }

    return $current;
}

/**
 * Get event Manager.
 *
 * @staticvar array $managers
 * @param string $name
 * @param EventManager $event_manager
 * @return EventManager
 * @see atc()
 */
function at_event_manager($name = 'default', $event_manager = NULL)
{
    static $managers = array();

    // Let use alter default event manager
    if (function_exists('at_event_manager_before') && is_null($event_manager)) {
        at_event_manager_before($name, $event_manager);
    }

    if (!isset($managers[$name]) && !is_null($event_manager)) {
        $managers[$name] = $event_manager;
    }

    if (!empty($managers[$name])) {
        return $managers[$name];
    }

    if (!isset($managers['default'])) {
        $managers['default'] = new EventManager();
    }

    return $managers['default'];
}

if (!function_exists('yaml_parse')) {

    /**
     * Read YAML input.
     *
     * @param  string $input The string to parse as a YAML document stream.
     * @return mixed
     */
    function yaml_parse($input)
    {
        $parser = new YamlParser();
        return $parser->parse($input);
    }

}

if (!function_exists('yaml_emit')) {

    function yaml_emit($data)
    {
        $dumper = new YamlDumper();
        return $dumper->dump($data);
    }

}
