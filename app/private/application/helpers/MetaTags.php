<?php

namespace Peregrine\Application\Helpers;

use \Phalcon\Tag;

class MetaTags extends Tag {

    /**
     * Generates a widget to show a metaTag
     *
     * @param array
     * @return string
     */
    static public function tag($parameters) {

        // Converting parameters to array if it is not
        if (!is_array($parameters)) {
            $parameters = array($parameters);
        }

        if (!isset($parameters[0])) {
            $parameters[0] = $parameters["name"];
        }

        $name = $parameters[0];
        if (!isset($parameters["name"])) {
            $parameters["name"] = $name;
        } else {
            if (!$parameters["name"]) {
                $parameters["name"] = $name;
            }
        }

        // Determining widget value,
        // \Phalcon\Tag::setDefault() allows to set the widget value
        if (isset($parameters["content"])) {
            $content = $parameters["content"];
            unset($parameters["content"]);
        } else {
            $content = self::getValue($name);
        }

        // Generate the tag code
        $code = '<meta name="' . $name . '" content="' . $content . '" ' . "/>".PHP_EOL;

        return $code;
    }

}