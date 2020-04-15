<?php 
/**
 * demo
 */
/*$mazey=<<<EOF
<html>
<head>
<title>标题</title>
</head>
<body>
<script type="text/javascript" src="http://www.fx551.com/static/www/user/js/jquery-1.9.1.min.js"></script>
<script>
function changeUrlArg(url, arg, val){
    var pattern = arg+'=([^&]*)';
    var replaceText = arg+'='+val;
    return url.match(pattern) ? url.replace(eval('/('+ arg+'=)([^&]*)/gi'), replaceText) : (url.match('[\?]') ? url+'&'+replaceText : url+'?'+replaceText);
}
var baseURL = "http://test.web1.com/page.php?page=1&c=d";
var page_jump=function(a){
	var b=$("#page_jump_num").val();if(b){isNaN(b)&&(b=1);var c=changeUrlArg(baseURL,'page',b);window.location=c;}
};
</script>

EOF;
echo $mazey;
$page = new page('http://test.web1.com/page.php?c=d',100,5);

echo $page->page();
echo "<hr>";
echo $page->simple_page();*/
//$page->expose();
/**
 * 分页类
 */
namespace Org\Util;
class pageT
{
	private $_url = '';//原始页面地址
	private $config = array(
		//以下是设置标记
        'mark_total_page'     => '共<i>[TOTAL_PAGE]</i>页', //总页数标记
        'mark_page'     => '<a href="[URL]">[PAGE]</a>', //页码标记
        'mark_cur_page'  => '<span class="num">[CUR_PAGE]</span>', //当前页标记
        'mark_jump_page' => '<span>[MARK_TOTAL_PAGE]，到第<input id="page_jump_num" maxlength="4" value="1" onkeyup="this.value=this.value.replace(/[^0-9]/g,\'\');" onkeydown="javascript:if(event.keyCode==13){page_jump();return false;}">页</span><a class="btn btn-default" href="javascript:page_jump();">确定</a>', //跳转页标记
        'mark_prev_page' => '<a href="[URL]"> &lt; 上一页 </a>', //上一页标记
        'mark_next_page'  => '<a href="[URL]">下一页&gt;</a>',//下一页标记
        'mark_prev_page_disable' => '<span> &lt; 上一页 </span>', //上一页禁用标记
        'mark_next_page_disable'  => '<span>下一页&gt;</span>',//下一页禁用标记
        'mark_break_page' => '<span>....</span>',// 省略页标记
        // 以下是简单模式设置标记
        'mark_simple_page' =>'<span class="pageState fl"><span>[CUR_PAGE]</span>/[TOTAL_PAGE]</span>',//简单模式页码 1/10
        'mark_simple_prev_page' => '<a href="[URL]" class="prev prevStop"><s class="arrow arrow-lthin"><s></s></s></a>',//简单模式上一页标记
        'mark_simple_next_page' => '<a href="[URL]" class="next nextStop"><s class="arrow arrow-rthin"><s></s></s></a>',//简单模式下一页标记
        'mark_simple_prev_page_disable' => '<a href="javascript:void(0)" class="prev prevStop"><s class="arrow arrow-lthin"><s></s></s></a>',//简单模式上一页禁用标记
        'mark_simple_next_page_disable' => '<a href="javascript:void(0)" class="next nextStop"><s class="arrow arrow-rthin"><s></s></s></a>',//简单模式下一页禁用标记

        //以下是属性设置
        'per_page_num' => 3,//显示页码数量
        'is_prev_next_page_disable' => false, //是否开启上一页下一页禁用按钮 true 开启，false 关闭
    );
	private $_total_page;//总页数
	private $_total_rows; //总记录数
	private $_list_rows; //每页记录数
	private $_var_page; //自定义分页变量名
	private $_cur_page; //当前页码
	private $_per_page_num; //显示页码数量

	/**
	 * 初始化
	 * @param string $url        [页面初始地址]
	 * @param [type] $total_rows [总记录数]
	 * @param [type] $list_rows  [每页记录数]
	 * @param string $var_page   [自定义分页变量]
	 */
	function __construct($url='',$total_rows,$list_rows,$var_page='')
	{
		$this->_url = $url;
		$this->_total_rows = max(1,$total_rows);
		$this->_list_rows = max(1,$list_rows);
		$this->_var_page = empty($var_page) ? 'page' : $var_page;
		$this->_cur_page = empty($_GET[$this->_var_page]) ? 1 : max(1,intval($_GET[$this->_var_page]));
		$this->_total_page = intval(ceil($this->_total_rows / $this->_list_rows)); //计算总页数
		if(!empty($this->_total_page) && $this->_cur_page > $this->_total_page) {
            $this->_cur_page = $this->_total_page;
        }
	}
	public function url($page){
		$join_symbol =((strpos($this->_url, '?') !== false) ? '&' : '?');
		return str_replace('[PAGE]', $page, ($this->_url . $join_symbol.$this->_var_page."=[PAGE]"));
	}
	// 设置标签
	public function setlabel($config){
		$this->config = array_merge($this->config, $config);
	}
	// 全分页
	public function page(){
		@extract($this->config);
		$this->_per_page_num = $per_page_num;
		if($this->_total_page < 2 ) return '';
		$_html_prev_page = '';
		//上一页
		if($this->_cur_page > 1 ){
			$_html_prev_page = str_replace('[URL]', $this->url($this->_cur_page-1), $mark_prev_page); 
		}else{
			$_html_prev_page = $is_prev_next_page_disable ?  $mark_prev_page_disable : '';
		}
		//下一页
		$_html_next_page = '';
		if($this->_cur_page < $this->_total_page){
			$_html_next_page = str_replace('[URL]', $this->url($this->_cur_page+1), $mark_next_page);
		}else{
			$_html_next_page = $is_prev_next_page_disable ? $mark_next_page_disable : '';
		}
		// 数字链接
		$start = max(1, min($this->_cur_page - ceil($this->_per_page_num / 2), $this->_total_page - $this->_per_page_num));
        $end = min($this->_per_page_num + $start, $this->_total_page);
		$number_link_page = []; 
		for($i = $start; $i <= $end; $i++){
			if($i == $this->_cur_page ){
				$number_link_page[$i] = str_replace('[CUR_PAGE]', $this->_cur_page, $mark_cur_page); 
			}else{
				$number_link_page[$i] = str_replace(array('[URL]','[PAGE]'), array($this->url($i),$i), $mark_page);
			}
		}
		$_html_number_link_page = '';
		if(array_key_exists(1,$number_link_page)){
			$_html_break_page = $mark_break_page. str_replace(array('[URL]','[PAGE]'), array($this->url($this->_total_page),$this->_total_page), $mark_page);
			$_html_number_link_page = implode('', $number_link_page) . ($this->_total_page == $this->_cur_page || array_key_exists($this->_cur_page,$number_link_page) ? '' : $_html_break_page );
		}else if(array_key_exists($this->_total_page,$number_link_page)){
			$_html_break_page = str_replace(array('[URL]','[PAGE]'), array($this->url(1),1), $mark_page).$mark_break_page;
			$_html_number_link_page = $_html_break_page.implode('', $number_link_page);
		}else{
			$_html_number_link_page = str_replace(array('[URL]','[PAGE]'), array($this->url(1),1), $mark_page).$mark_break_page.implode('', $number_link_page).$mark_break_page.str_replace(array('[URL]','[PAGE]'), array($this->url($this->_total_page),$this->_total_page), $mark_page);
		}
		// 显示顺序 上一页，数字链接，下一页，跳转
		$_html = $_html_prev_page.$_html_number_link_page.$_html_next_page;

		$_html_jump_page=str_replace(array('[MARK_TOTAL_PAGE]','[TOTAL_PAGE]','[CUR_PAGE]'), array($mark_total_page,$this->_total_page,$this->_cur_page), $mark_jump_page);
		return $_html.$_html_jump_page;
	}
	// 简单分页
	public function simple_page(){
		@extract($this->config);
		$_html_simple_page = str_replace(array('[CUR_PAGE]','[TOTAL_PAGE]'), array($this->_cur_page,$this->_total_page), $mark_simple_page);
		//当前只有1页
		if($this->_total_page < 2 ) return $mark_simple_prev_page_disable.$_html_simple_page.$mark_simple_next_page_disable;
		if($this->_cur_page == 1){
			$_html = $mark_simple_prev_page_disable.$_html_simple_page.str_replace(array('[URL]'), array($this->url($this->_cur_page+1)), $mark_simple_next_page);
		}else if($this->_cur_page == $this->_total_page){
			$_html = str_replace(array('[URL]'), array($this->url($this->_cur_page-1)), $mark_simple_prev_page).$_html_simple_page.$mark_simple_next_page_disable;
		}else{
			$_html = str_replace(array('[URL]'), array($this->url($this->_cur_page-1)), $mark_simple_prev_page).$_html_simple_page.str_replace(array('[URL]'), array($this->url($this->_cur_page+1)), $mark_simple_next_page);
		}
		return $_html;
	}
	public function expose(){
		print_r(get_object_vars($this));
	}
}