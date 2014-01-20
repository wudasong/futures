<?php
class Pagination {
	public $total = 0;
	public $page = 1;
	public $limit = 20;
	public $num_links = 10;
	public $url = '';
	public $text = 'Showing {start} to {end} of {total} ({pages} Pages)';
	public $text_first = '首页';
	public $text_last = '尾页';
	public $text_next = '下一页';
	public $text_prev = '上一页';
	public $style_links = 'pageritemlink';
	public $style_results = 'results';
	 
	public function render() {
		$total = $this->total;
		
		if ($this->page < 1) {
			$page = 1;
		} else {
			$page = $this->page;
		}
		
		if (!(int)$this->limit) {
			$limit = 10;
		} else {
			$limit = $this->limit;
		}
		
		$num_links = $this->num_links;
		$num_pages = ceil($total / $limit);
		
		$output = '';
		
		if ($page > 1) {
			$output .= ' <a class="pageritemlink" href="' . str_replace('{page}', 1, $this->url) . '#pd">' . $this->text_first . '</a> <a class="pageritemlink" href="' . str_replace('{page}', $page - 1, $this->url) . '#pd">' . $this->text_prev . '</a> ';
    	}

		if ($num_pages > 1) {
			if ($num_pages <= $num_links) {
				$start = 1;
				$end = $num_pages;
			} else {
				$start = $page - floor($num_links / 2);
				$end = $page + floor($num_links / 2);
			
				if ($start < 1) {
					$end += abs($start) + 1;
					$start = 1;
				}
						
				if ($end > $num_pages) {
					$start -= ($end - $num_pages);
					$end = $num_pages;
				}
			}

			if ($start > 1) {
				$output .= ' .... ';
			}

			for ($i = $start; $i <= $end; $i++) {
				if ($page == $i) {
					$output .= ' <span class="pagercurrent" pageindex="' . $i . '">' . $i . '</span> ';
				} else {
					$output .= ' <a class="pageritemlink" href="' . str_replace('{page}', $i, $this->url) . '#pd">' . $i . '</a> ';
				}	
			}
							
			if ($end < $num_pages) {
				$output .= ' .... ';
			}
		}
		
   		if ($page < $num_pages) {
			$output .= ' <a class="pageritemlink" href="' . str_replace('{page}', $page + 1, $this->url) . '#pd">' . $this->text_next . '</a> <a class="pageritemlink" href="' . str_replace('{page}', $num_pages, $this->url) . '#pd">' . $this->text_last . '</a> ';
		}
		
		$find = array(
			'{start}',
			'{end}',
			'{total}',
			'{pages}'
		);
		
		$replace = array(
			($total) ? (($page - 1) * $limit) + 1 : 0,
			((($page - 1) * $limit) > ($total - $limit)) ? $total : ((($page - 1) * $limit) + $limit),
			$total, 
			$num_pages
		);
		
		return ($output ? '<div class="' . $this->style_links . '">' . $output . '</div>' : '') . '<!--<div class="' . $this->style_results . '">' . str_replace($find, $replace, $this->text) . '</div>-->';
	}
}
?>