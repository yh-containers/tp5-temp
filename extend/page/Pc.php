<?php
namespace page;
use think\paginator\driver\Bootstrap;

class Pc extends Bootstrap
{
    public function render()
    {
        if ($this->hasPages()) {
//           '<div class="page wow fadeInUp">
//					<div class="page_num">
//						<a href="" class="first">首页</a>
//						<a href="" class="prev">上一页</a>
//						<a href="" class="cur2">1</a>
//						<a href="">2</a>
//						<a href="">3</a>
//						<a href="">4</a>
//						<a href="" class="next">下一页</a>
//						<a href="" class="last">尾页</a>
//					</div>
//				</div>';
            return sprintf(
                '<div class="page wow fadeInUp">
					<div class="page_num">%s %s %s</div>
				</div>',
                $this->getPreviousButton('上一页'),
                $this->getLinks(),
                $this->getNextButton('下一页')
            );
        }

        $render = parent::render(); // TODO: Change the autogenerated stub
        return $render;
    }



    /**
     * 生成一个可点击的按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page)
    {
        return '<a class="" href="' . htmlentities($url) . '">' . $page . '</a>';
    }

    /**
     * 生成一个禁用的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        return '<a  class="" href="javascript:;">' . $text . '</a>';
    }

    /**
     * 生成一个激活的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<a  class="cur2" href="javascript:;">' . $text . '</a>';
    }
}