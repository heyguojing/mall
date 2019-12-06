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
class Page
{
    static $staticTotalPage = null; //总页数
    static $staticUrl = null; //url地址
    static $fix = ''; //静态后缀如.html
    static $pageNumLabel = '{page}'; //替换标签
    public $totalRow; //总条数
    public $totalPage; //总页数
    public $arcRow; //每页显示数
    public $pageRow; //每页显示页码数
    public $selfPage; //当前页
    public $url; //页面地址
    public $customUrl;//自定义url地址
    public $args; //页面传递参数
    public $startId; //当前页开始ID
    public $endId; //当前页末尾ID
	//superman新增  2015-06-22 09:13
	public $first_link       = '';
	public $first_tag_open   = '';
	public $first_tag_close  = '';
	public $last_link        = '';
	public $last_tag_open    = '';
	public $last_tag_close   = '';
	public $next_link        = '';
	public $next_tag_open    = '';
	public $next_tag_close   = '';
	public $prev_link        = '';
	public $prev_tag_open    = '';
	public $prev_tag_close   = '';
	public $num_tag_open     = '';
	public $num_tag_close    = '';
	public $cur_tag_open     = '';
	public $cur_tag_close    = '';
	public $anchor_class		= '';//其他样式
	public $current_anchor_class = '';//当前样式
	public $next_class   = '';//superman新增上一页样式
	public $prev_class   = '';//superman新增下一页样式
	public $first_class   = '';//superman新增上一页样式
	public $end_class   = '';//superman新增下一页样式
	public $unit = '条'; //单位
    //superman新增  2015-07-27 14:33
    public $nowPage_open ='<span class="nowPage">';//当前页码
    public $nowPage_close ='</span>';//当前页码
    public $count_total_open ='<span class="count">';//总共 
    public $count_total_close ='</span>';//总共 
    //superman新增 2016-06-03
    public $cur_a_open    = '';//superman新增当前页标签
    public $cur_a_end    = '';//superman新增当前页标签
    public $cur_a_close  = '';//superman新增当前页结束标签
    //superman新增  2016-06-05
    public $page_start_str = "";
    public $page_end_str="";

    /**
     * @param int $total 总条数
     * @param string $row 每页显示条数
     * @param string $pageRow 显示页码数量
     * @param string $setSelfPage 当前页
     * @param string $customUrl 自定义url地址
     * @param string $pageNumLabel 页码变量,默认为{page}
     */

    function __construct($total, $row = 10, $pageRow = '', $setSelfPage = '', $customUrl = '', $pageNumLabel = '{page}',$page_start_str="list_",$page_end_str=".html",$url_model=2)
    {
        $this->totalRow = $total; //总条数
        $this->arcRow =  $row; //每页显示条数
        $this->pageRow = (empty($pageRow) ? config('page.PAGE_ROW') : $pageRow) - 1; //显示页码数量
        $this->totalPage = ceil($this->totalRow / $this->arcRow); //总页数
        self::$staticTotalPage = $GLOBALS['totalPage'] = $this->totalPage; //总页数
        self::$pageNumLabel = empty($pageNumLabel) ? self::$pageNumLabel : $pageNumLabel; //替换标签
        $this->selfPage = min($this->totalPage, empty($setSelfPage) ? empty($_GET[config("page.PAGE_VAR")]) ? 1 : max(1, (int)$_GET[config("page.PAGE_VAR")]) : max(1, (int)$setSelfPage)); //当前页
		
        $this->url = $this->setUrl($customUrl,$url_model); //配置url地址
        $this->customUrl = $customUrl;//自定义url是否为空
        $this->startId = ($this->selfPage - 1) * $this->arcRow + 1; //当前页开始ID
        $this->endId = min($this->selfPage * $this->arcRow, $this->totalRow); //当前页结束ID

        //superman新增 2016-06-05  22:32
        $this->page_start_str = empty($page_start_str) ? config("page.PAGE_START_STR") : $page_start_str; //分页开始字符串
        $this->page_end_str = empty($page_end_str) ? config("page.PAGE_END_STR") : $page_end_str; //分页结束字符串

         //分页样式可以读取
        $this->first_tag_open  = config("page.first_tag_open")?config("page.first_tag_open"):$this->first_tag_open;
        $this->first_tag_close  = config("page.first_tag_close")?config("page.first_tag_close"):$this->first_tag_close;
        $this->last_tag_open    = config("page.last_tag_open")?config("page.last_tag_open"):$this->last_tag_open;
        $this->last_tag_close   = config("page.last_tag_close")?config("page.last_tag_close"):$this->last_tag_close;
        $this->next_tag_open    = config("page.next_tag_open")?config("page.next_tag_open"):$this->next_tag_open;
        $this->next_tag_close   = config("page.next_tag_close")?config("page.next_tag_close"):$this->next_tag_close;
        $this->prev_tag_open    = config("page.prev_tag_open")?config("page.prev_tag_open"):$this->prev_tag_open;
        $this->prev_tag_close    = config("page.prev_tag_close")?config("page.prev_tag_close"):$this->prev_tag_close;
        $this->num_tag_open     = config("page.num_tag_open")?config("page.num_tag_open"):$this->num_tag_open;
        $this->num_tag_close    = config("page.num_tag_close")?config("page.num_tag_close"):$this->num_tag_close;
        $this->cur_tag_open     = config("page.cur_tag_open")?config("page.cur_tag_open"):$this->cur_tag_open;
        $this->cur_tag_close    = config("page.cur_tag_close")?config("page.cur_tag_close"):$this->cur_tag_close;
        $this->anchor_class    = config("page.anchor_class")?config("page.anchor_class"):$this->anchor_class;//其他样式
        $this->current_anchor_class   = config("page.current_anchor_class")?config("page.current_anchor_class"):$this->current_anchor_class;
        $this->prev_class              = config("page.prev_class")?config("page.prev_class"):$this->prev_class;
        $this->next_class              = config("page.next_class")?config("page.next_class"):$this->next_class;
        $this->first_class   = config("page.first_class")?config("page.first_class"):$this->first_class;//superman新增上一页样式
        $this->end_class   = config("page.end_class")?config("page.end_class"):$this->end_class;//superman新增下一
        //新增链接文字
        $this->prev_link              = config("page.prev_link")?config("page.prev_link"):$this->prev_link;
        $this->next_link              = config("page.next_link")?config("page.next_link"):$this->next_link;
        $this->first_link             = config("page.first_link")?config("page.first_link"):$this->first_link;
        $this->last_link               = config("page.last_link")?config("page.last_link"):$this->last_link;
        //新增当前页a标签代码
        $this->cur_a_open              = config("page.cur_a_open")?config("page.cur_a_open"):$this->cur_a_open;
        $this->cur_a_end             = config("page.cur_a_end")?config("page.cur_a_end"):$this->cur_a_end;
        $this->cur_a_close               = config("page.cur_a_close")?config("page.cur_a_close"):$this->cur_a_close;
    }
	//初始化
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
	}
    //获取URL地址
    protected function getUrl($pageNum)
    {
        $returnUrl = $this->url;
        /**
         * 数型返回url地址
         * b(before)返回url地址前部分
         * a(after)返回url地址后部分
         */
        if (strtolower($pageNum) == 'b') {
            $returnUrl = substr($returnUrl, 0, strpos($returnUrl, self::$pageNumLabel));
        } elseif (strtolower($pageNum) == 'a') {
            $returnUrl = substr($returnUrl, strpos($returnUrl, self::$pageNumLabel) + strlen(self::$pageNumLabel));
        } else {
            $returnUrl = str_replace(self::$pageNumLabel, $pageNum, $returnUrl);
        }
        //判断传过来地自定义的 增加时间 2016-07-02 16:17
        if($this->customUrl && config('page.url_html_suffix') !=""){
           return $returnUrl.".".config('page.url_html_suffix');
        }elseif($this->customUrl){
            return $returnUrl;
        }
        $get = $_GET;
        unset($get["m"]);
        unset($get['c']);
        unset($get["a"]);
        unset($get[config("page.PAGE_VAR")]);
   
        //superman新增修改 2016-06-03 21:08
        if($pageNum == 1  ){//判断是是否第一页
            $returnUrl = str_replace($this->page_start_str."1","",url($returnUrl,$get));
            $returnUrl = str_replace($this->page_end_str,"",$returnUrl);  
        }else{
            $returnUrl = url($returnUrl,$get);
        }
        return url($returnUrl);
    }

    //配置URL地址
    protected function setUrl($customUrl,$url_model=2)
    {
        if (!is_null(self::$staticUrl)) {
            $returnUrl = self::$staticUrl . self::$fix; //配置url地址
        } else if (!empty($customUrl)) {
            if (strstr($customUrl, self::$pageNumLabel)) {
                $returnUrl = $customUrl;
            } else {
                switch ($url_model) {
                    case 2:
                        $returnUrl = reduce_double_slashes($customUrl . '/' . config('page.PAGE_VAR') . '/' . self::$pageNumLabel . self::$fix);
                        break;
                    case 1:
                    default:
                        $returnUrl = reduce_double_slashes($customUrl . '&' . config('page.PAGE_VAR') . '=' . self::$pageNumLabel . self::$fix);
                        break;
                }
            }
        }
        return $returnUrl;
    }

    /**
     * SQL的limit语句
     * @return string
     */
    public function limit()
    {
        return max(0, ($this->selfPage - 1) * $this->arcRow) . "," . $this->arcRow;
    }

    //上一页
    protected function pre()
    {
		$pre = $this->prev_link;
        if ($this->selfPage > 1 && $this->selfPage <= $this->totalPage) {
            return $this->prev_tag_open.'<a href="'.$this->getUrl($this->selfPage - 1).'"'.$this->prev_class.'>'.$pre.'</a>'.$this->prev_tag_close;
        }else{
			return '';
		}
    }

    //下一页
    public function next()
    {
		$next = $this->next_link;
        if ($this->selfPage < $this->totalPage) {
            return $this->next_tag_open."<a href='" . $this->getUrl($this->selfPage + 1) . "' ".$this->next_class.">{$next}</a>".$this->next_tag_close;
        }else{
			return '';
		}
        
		
    }

    //列表项
    private function pageList()
    {
        //页码
        $pageList = array();
        $start = max(1, min($this->selfPage - ceil($this->pageRow / 2), $this->totalPage - $this->pageRow));
        $end = min($this->pageRow + $start, $this->totalPage);
        if ($end == 1) //只有一页不显示页码
            return '';
        for ($i = $start; $i <= $end; $i++) {
            if ($this->selfPage == $i) {
                $pageList [$i] ['url'] = "";
                $pageList [$i] ['str'] = $i;
                continue;
            }
            $pageList [$i] ['url'] = $this->getUrl($i);
            $pageList [$i] ['str'] = $i;
        }
        return $pageList;
    }

    //文字页码列表
    public function strList()
    {
        $arr = $this->pageList();
        $str = '';
        if (empty($arr))
            //return $this->cur_tag_open."<a href='javascript:void(0);'".$this->current_anchor_class.">1</a>".$this->cur_tag_close;
            return '';
        foreach ($arr as $k=>$v) {
            $str .= empty($v ['url']) ?$this->cur_tag_open.$this->cur_a_open.$this->current_anchor_class.$this->cur_a_end."{$v['str']}".$this->cur_a_close.$this->cur_tag_close : $this->num_tag_open."<a href=\"{$v['url']}\"".$this->anchor_class.">{$v['str']}</a>".$this->num_tag_close;
        }
        return $str;
    }

    //图标页码列表
    public function picList()
    {
        $str = '';
        $first = $this->selfPage == 1 ? "" : "<a href='" . $this->getUrl(1) . "' class='picList'><span><<</span></a>";
        $end = $this->selfPage >= $this->totalPage ? "" : "<a href='" . $this->getUrl($this->totalPage) . "'  class='picList'><span>>></span></a>";
        $pre = $this->selfPage <= 1 ? "" : "<a href='" . $this->getUrl($this->selfPage - 1) . "'  class='picList'><span><</span></a>";
        $next = $this->selfPage >= $this->totalPage ? "" : "<a href='" . $this->getUrl($this->selfPage + 1) . "'  class='picList'><span>></span></a>";

        return $first . $pre . $next . $end;
    }

    //选项列表
    public function select()
    {
        $arr = $this->pageList();
        if (!$arr) {
            return '';
        }
        $str = "<select name='page' class='page_select' onchange='
		javascript:
		location.href=this.options[selectedIndex].value;'>";
        foreach ($arr as $v) {
            $str .= empty($v ['url']) ? "<option value='{$this->getUrl($v['str'])}' selected='selected'>{$v['str']}</option>" : "<option value='{$v['url']}'>{$v['str']}</option>";
        }
        return $str . "</select>";
    }

    //输入框
    public function input()
    {
        $str = "<input id='pagekeydown' type='text' name='page' value='{$this->selfPage}' class='pageinput' onkeydown = \"javascript:
					if(event.keyCode==13){
						location.href='{$this->getUrl('B')}'+this.value+'{$this->getUrl('A')}';
					}
				\"/>
				<button class='pagebt' onclick = \"javascript:
					var input = document.getElementById('pagekeydown');
					location.href='{$this->getUrl('B')}'+input.value+'{$this->getUrl('A')}';
				\">进入</button>
";
        return $str;
    }

    //前几页
    public function pres()
    {
        $num = max(1, $this->selfPage - $this->pageRow);
        return $this->selfPage > $this->pageRow ? "<a href='" . $this->getUrl($num) . "' class='pres'>前{$this->pageRow}页</a>" : "";
    }

    //后几页
    public function nexts()
    {
        $num = min($this->totalPage, $this->selfPage + $this->pageRow);
        return $this->selfPage + $this->pageRow < $this->totalPage ? "<a href='" . $this->getUrl($num) . "' class='nexts'>后{$this->pageRow}页</a>" : "";
    }

    //首页
    public function first()
    {
        $first = $this->first_link;
        return $this->selfPage > 1 ? $this->first_tag_open."<a href='" . $this->getUrl(1)."'".$this->first_class.">{$first}</a>".$this->first_tag_close : "";
    }

    //末页
    public function end()
    {
        $end = $this->last_link;
        return $this->selfPage < $this->totalPage && $this->totalPage > 2 ? $this->last_tag_open."<a href='" . $this->getUrl($this->totalPage)."'".$this->end_class.">{$end}</a>".$this->last_tag_close : "";
    }

    //当前页记录
    public function nowPage()
    {
		$unit = $this->unit;
        return $this->nowPage_open."第{$this->startId}-{$this->endId}{$unit}".$this->nowPage_close;
    }

    //count统计
    public function count()
    {
        return $this->count_total_open."[共{$this->totalPage}页] [{$this->totalRow}条记录]".$this->count_total_close;
    }

    /**
     * 返回所有分页信息
     * @return Array
     */
    public function getAll()
    {
        $show = array();
        $show['count'] = $this->count();
        $show['first'] = $this->first();
        $show['pre'] = $this->pre();
        $show['pres'] = $this->pres();
        $show['strList'] = $this->strList();
        $show['nexts'] = $this->nexts();
        $show['next'] = $this->next();
        $show['end'] = $this->end();
        $show['nowPage'] = $this->nowPage();
        $show['select'] = $this->select();
        $show['input'] = $this->input();
        $show['picList'] = $this->picList();
        return $show;
    }

    /**
     * 显示页码
     * @param string $style 风格
     * @param int $pageRow 页码显示行数
     * @return string
     */
    public function show($style = '', $pageRow = null)
    {
        if (empty($style)) {
            $style = config('page.PAGE_STYLE');
        }
        //页码显示行数
        $this->pageRow = is_null($pageRow) ? $this->pageRow : $pageRow - 1;
        switch ($style) {
            case 1 :
                return "{$this->count()}{$this->first()}{$this->pre()}{$this->pres()}{$this->strList()}{$this->nexts()}{$this->next()}{$this->end()}
                {$this->nowPage()}{$this->select()}{$this->input()}{$this->picList()}";
            case 2 :
                return $this->pre() . $this->strList() . $this->next() . $this->count();
            case 3 :
                return $this->pre() . $this->strList() . $this->next();
            case 4 :
                return "<span class='total'>总计:{$this->totalRow}
                {$this->unit}</span>" . $this->picList() . $this->select();
            case 5:
                return $this->first() . $this->pre() . $this->strList() . $this->next() . $this->end();
            case 6:
                return $this->strList();
            case 7:
                return $this->pre() . $this->next();
            case 8:
                return $this->first() . $this->pre() . $this->strList() . $this->next() . $this->end()."<li class='li_page_total'><span>共<i>{$this->totalRow}</i>个信息</span><li>";
        }
    }

}