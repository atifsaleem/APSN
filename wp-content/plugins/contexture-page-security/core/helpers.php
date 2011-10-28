<?php

if(!class_exists('CTX_Helper')){
/**Put any methods used for generating HTML */
class CTX_Helper{
    /**
     * Turns an attributes array into HTML-friendly attributes
     * @param array $atts Attributes and values as an associative array.
     * @return string Attributes ready to be used in an HTML element.
     */
    public static function atts($atts){
        $return='';
        foreach($atts as $att=>$val){
            if(is_array($val) || is_object($val)){
                $return .= sprintf('%s="%s" ',$att,implode($val,' '));
            }else{
                $return .= sprintf('%s="%s" ',$att,$val);
            }
        }
        return $return;
    }
    /**
     * Combines a default attributes array with new values
     * @global $atts Uses the $atts variable.
     * @param array $defaults An associative array of default key=>value pairs
     * @return array Returns an array where the defaults are overwritten with the new values
     */
    public static function atts_default($defaults=array()){
        global $atts;
        return array_merge($defaults,$atts);
    }
    /**
     * Generates HTML for any tag.
     *
     * @param string $tag The element name.
     * @param array $atts Associative array (recommended) or a string containing pre-processed attributes.
     * @param string $content Any content (html) to used inside the element.
     * @return string Returns the assembled element html.
     */
    public static function gen($tag,$atts,$content=null,$closetag=false){
        $return = sprintf('<%s %s', $tag, (is_array($atts))?self::atts($atts):$atts);
        if(!empty($content)){
            $return .= sprintf('>%s</%s>',$content,$tag);
        }
        else if($closetag){
            $return .= sprintf('></%s>',$tag);
        }
        else{
            $return .= '/>';
        }
        return $return;
    }
    /**
     * Takes an opening HTML tag and automagically generates the closing tag after any provided content.
     * @param string $string
     * @return string The full HTML string with closing tag.
     */
    public static function wrap($string,$content=''){
        $tag=array();
        preg_match('/^\<([a-zA-Z]+)/',$string,$tag);
        if(empty($tag[1])){ new WP_Error('bad_data',__('Invalid html was passed to CTX_Helper:wrap','contexture-page-security')); }
        $string .= sprintf('%s</%s>',$content,$tag[1]);
        return $string;
    }
    public static function img($atts,$echo=true){
        if($echo){ echo self::gen('img', $atts); }
        else{ return self::gen('img', $atts); }
    }
    public static function ol($atts,$content,$echo=true){
        if($echo){ echo self::gen('ol', $atts, $content); }
        else{ return self::gen('ol', $atts, $content); }
    }
    public static function ul($atts,$content,$echo=true){
        if($echo){ echo self::gen('ul', $atts, $content); }
        else{ return self::gen('ul', $atts, $content); }
    }
    public static function li($atts,$content,$echo=true){
        if($echo){ echo self::gen('li', $atts, $content); }
        else{ return self::gen('li', $atts, $content); }
    }
    public static function div($atts,$content,$echo=true){
        if($echo){ echo self::gen('div', $atts, $content); }
        else{ return self::gen('div', $atts, $content); }
    }
    public static function span($atts,$content,$echo=true){
        if($echo){ echo self::gen('span', $atts, $content); }
        else{ return self::gen('span', $atts, $content); }
    }
    public static function table($atts,$content,$echo=true){
        if($echo){ echo self::gen('table', $atts, $content); }
        else{ return self::gen('table', $atts, $content); }
    }
    public static function thead($atts,$content,$echo=true){
        if($echo){ echo self::gen('thead', $atts, $content); }
        else{ return self::gen('thead', $atts, $content); }
    }
    public static function tbody($atts,$content,$echo=true){
        if($echo){ echo self::gen('tbody', $atts, $content); }
        else{ return self::gen('tbody', $atts, $content); }
    }
    public static function tfoot($atts,$content,$echo=true){
        if($echo){ echo self::gen('tfoot', $atts, $content); }
        else{ return self::gen('tfoot', $atts, $content); }
    }
    public static function tr($atts,$content,$echo=true){
        if($echo){ echo self::gen('tr', $atts, $content); }
        else{ return self::gen('tr', $atts, $content); }
    }
    public static function td($atts,$content,$echo=true){
        if($echo){ echo self::gen('td', $atts, $content); }
        else{ return self::gen('td', $atts, $content); }
    }
    public static function a($atts,$content,$echo=true){
        if($echo){ echo self::gen('a', $atts, $content); }
        else{ return self::gen('a', $atts, $content); }
    }
    public static function input($atts,$echo=true){
        self::atts_default(array(
            'id'=>'rand'.mt_rand(1000,9999),
            'name'=>'rand'.mt_rand(1000,9999),
            'type'=>'text'
        ));
        if($echo){ echo self::gen('input', $atts); }
        else{ return self::gen('input', $atts); }
    }
    public static function message($atts,$content,$echo=true){
        if($echo){ echo self::gen('a', $atts, $content); }
        else{ return self::gen('a', $atts, $content); }
    }
}}

?>