<?php

namespace Peregrine\Application\Helpers;

use \Phalcon\Tag;

class MetaTag extends Tag {

    static public function tag($parameters) {
        if (!is_array($parameters)) {
            $parameters = array($parameters);
        }

        if(!(bool)count(array_filter(array_keys($parameters), 'is_string'))){
            $attributes['name'] = $parameters[0];
            if(isset($parameters[1])){
                $attributes['content'] = $parameters[1];
            }else{
                $attributes['content'] = $attributes['name'];
            }
        }else{
            $attributes = $parameters;
        }

        $meta = '<meta';
        foreach($attributes as $k => $v){
            $meta .= ' '.$k.'="'.$v.'"';
        }
        $meta .= '>'.PHP_EOL;

        return $meta;
    }

}