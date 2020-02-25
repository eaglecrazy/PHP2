<?php
function def($v){
    return strip_tags((preg_replace ( "'<script[^>]*?>.*?'si", "", $v )));
}