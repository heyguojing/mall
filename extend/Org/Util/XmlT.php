<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: superman <953369865@qq.com>
// +----------------------------------------------------------------------
namespace Org\Util;
class XmlT {

	var $parser;
	var $document;
	var $stack;
	var $data;
	var $last_opened_tag;
	var $isnormal;
	var $attrs = array();
	var $failed = FALSE;

	function __construct($isnormal="") {
		$this->XMLparse($isnormal);
	}

	function XMLparse($isnormal) {
		$this->isnormal = $isnormal;
		$this->parser = xml_parser_create('ISO-8859-1');
		xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, false);
		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, 'open','close');
		xml_set_character_data_handler($this->parser, 'data');
	}

	function destruct() {
		xml_parser_free($this->parser);
	}

	function parse(&$data) {
		$this->document = array();
		$this->stack	= array();
		return xml_parse($this->parser, $data, true) && !$this->failed ? $this->document : '';
	}

	function open(&$parser, $tag, $attributes) {
		$this->data = '';
		$this->failed = FALSE;
		if(!$this->isnormal) {
			if(isset($attributes['id']) && !is_string($this->document[$attributes['id']])) {
				$this->document  = &$this->document[$attributes['id']];
			} else {
				$this->failed = TRUE;
			}
		} else {
			if(!isset($this->document[$tag]) || !is_string($this->document[$tag])) {
				$this->document  = &$this->document[$tag];
			} else {
				$this->failed = TRUE;
			}
		}
		$this->stack[] = &$this->document;
		$this->last_opened_tag = $tag;
		$this->attrs = $attributes;
	}

	function data(&$parser, $data) {
		if($this->last_opened_tag != NULL) {
			$this->data .= $data;
		}
	}

	function close(&$parser, $tag) {
		if($this->last_opened_tag == $tag) {
			$this->document = $this->data;
			$this->last_opened_tag = NULL;
		}
		array_pop($this->stack);
		if($this->stack) {
			$this->document = &$this->stack[count($this->stack)-1];
		}
	}
	//转xml文件
	function array2xml($arr, $htmlon = TRUE, $isnormal = FALSE, $level = 1) {
		$s = $level == 1 ? "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\r\n<root>\r\n" : '';
		$space = str_repeat("\t", $level);
		foreach($arr as $k => $v) {
			if(!is_array($v)) {
				$s .= $space."<item id=\"$k\">".($htmlon ? '<![CDATA[' : '').$v.($htmlon ? ']]>' : '')."</item>\r\n";
			} else {
				$s .= $space."<item id=\"$k\">\r\n".$this->array2xml($v, $htmlon, $isnormal, $level + 1).$space."</item>\r\n";
			}
		}
		$s = preg_replace("/([\x01-\x08\x0b-\x0c\x0e-\x1f])+/", ' ', $s);
		return $level == 1 ? $s."</root>" : $s;
	}
	//转为数组
	function xml2array(&$xml, $isnormal = FALSE) {
		$xml_parser = new xmlT($isnormal);
		$data = $xml_parser->parse($xml);
		$xml_parser->destruct();
		return $data;
	}

	//superman新增插件名称
	//转xml文件
	function array_plugin_xml($arr, $htmlon = TRUE, $isnormal = FALSE, $level = 1) {
		$s = $level == 1 ? "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\r\n<root>\r\n<item id=\"Title\"><![CDATA[superman商城]]></item>
	<item id=\"Version\"><![CDATA[v1.0]]></item>
	<item id=\"Time\"><![CDATA[".date('Y-m-d H:i:s',time())."]]></item>
	<item id=\"From\"><![CDATA[superman商城()]]></item>\r\n" : '';
		$space = str_repeat("\t", $level);
		foreach($arr as $k => $v) {
			if(!is_array($v)) {
				$s .= $space."<item id=\"$k\">".($htmlon ? '<![CDATA[' : '').$v.($htmlon ? ']]>' : '')."</item>\r\n";
			} else {
				$s .= $space."<item id=\"$k\">\r\n".$this->array_plugin_xml($v, $htmlon, $isnormal, $level + 1).$space."</item>\r\n";
			}
		}
		$s = preg_replace("/([\x01-\x08\x0b-\x0c\x0e-\x1f])+/", ' ', $s);
		return $level == 1 ? $s."</root>" : $s;
	}

}

?>