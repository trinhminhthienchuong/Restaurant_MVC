<?php
/**
 * Pagination by Chương
 *
 * This Pagination class helps to integrate ajax pagination in PHP.
 *
 * @class		Pagination
 * @author		ThienChuong  
 * @contact		Trinhminhthienchuong@gmail.com
 * @version		1.0
 */
class pagerAjax{
	protected $_baseURL		= '';	//Link lấy dữ liệu phân trang
	protected $_totalRows  	= '';	// tổng số page
	protected $_perPage	 	= 6;	// số lượng item trong 1 page
	protected $_numLinks	=  4;	// số lượng link page hiển thị
	protected $_currentPage	=  0;	// page hiện tại
	protected $_firstLink   	= '&lsaquo; First';	//«
	protected $_nextLink		= '&gt;';			//
	protected $_prevLink		= '&lt;';
	protected $_lastLink		= 'Last &rsaquo;';	//»
	protected $_fullTagOpen	= '<div class="pagination">';
	protected $_fullTagClose	= '</div>';
	protected $_firstTagOpen	= '';
	protected $_firstTagClose	= '&nbsp;';
	protected $_lastTagOpen	= '&nbsp;';
	protected $_lastTagClose	= '';
	protected $_curTagOpen		= '&nbsp;<b>';
	protected $_curTagClose	= '</b>';
	protected $_nextTagOpen	= '&nbsp;';
	protected $_nextTagClose	= '&nbsp;';
	protected $_prevTagOpen	= '&nbsp;';
	protected $_prevTagClose	= '';
	protected $_numTagOpen		= '&nbsp;';
	protected $_numTagClose	= '';
	protected $_anchorClass	= '';
	protected $_showCount      = true;
	protected $_currentOffset	= 0;
	protected $_contentDiv     = '';
    protected $_additionalParam= '';
    
	function __construct($params = array()){
		if (count($params) > 0){
			$this->initialize($params);		
		}
		
		if ($this->anchorClass != ''){
			$this->anchorClass = 'class="'.$this->anchorClass.'" ';
		}	
	}
	
	function initialize($params = array()){
		if (count($params) > 0){
			foreach ($params as $key => $val){
				if (isset($this->$key)){
					$this->$key = $val;
				}
			}		
		}
	}
	
	/**
	 * Generate the pagination links
	 */	
	function createLinks(){ 
		// If total number of rows is zero, do not need to continue
		if ($this->totalRows == 0 OR $this->perPage == 0){
		   return '';
		}

		// Calculate the total number of pages
		$numPages = ceil($this->totalRows / $this->perPage);

		// Is there only one page? will not need to continue
		if ($numPages == 1){
			if ($this->showCount){
				$info = 'Showing : ' . $this->totalRows;
				return $info;
			}else{
				return '';
			}
		}

		// Determine the current page	
		if ( ! is_numeric($this->currentPage)){
			$this->currentPage = 0;
		}
		
		// Links content string variable
		$output = '';
		
		// Showing links notification
		if ($this->showCount){
		   $currentOffset = $this->currentPage;
		   $info = 'Showing ' . ( $currentOffset + 1 ) . ' to ' ;
		
		   if( ( $currentOffset + $this->perPage ) < ( $this->totalRows -1 ) )
			  $info .= $currentOffset + $this->perPage;
		   else
			  $info .= $this->totalRows;
		
		   $info .= ' of ' . $this->totalRows . ' | ';
		
		   $output .= $info;
		}
		
		$this->numLinks = (int)$this->numLinks;
		
		// Is the page number beyond the result range? the last page will show
		if ($this->currentPage > $this->totalRows){
			$this->currentPage = ($numPages - 1) * $this->perPage;
		}
		
		$uriPageNum = $this->currentPage;
		
		$this->currentPage = floor(($this->currentPage/$this->perPage) + 1);

		// Calculate the start and end numbers. 
		$start = (($this->currentPage - $this->numLinks) > 0) ? $this->currentPage - ($this->numLinks - 1) : 1;
		$end   = (($this->currentPage + $this->numLinks) < $numPages) ? $this->currentPage + $this->numLinks : $numPages;

		// Render the "First" link
		if  ($this->currentPage > $this->numLinks){
			$output .= $this->firstTagOpen 
				. $this->getAJAXlink( '' , $this->firstLink)
				. $this->firstTagClose; 
		}

		// Render the "previous" link
		if  ($this->currentPage != 1){
			$i = $uriPageNum - $this->perPage;
			if ($i == 0) $i = '';
			$output .= $this->prevTagOpen 
				. $this->getAJAXlink( $i, $this->prevLink )
				. $this->prevTagClose;
		}

		// Write the digit links
		for ($loop = $start -1; $loop <= $end; $loop++){
			$i = ($loop * $this->perPage) - $this->perPage;
					
			if ($i >= 0){
				if ($this->currentPage == $loop){
					$output .= $this->curTagOpen.$loop.$this->curTagClose;
				}else{
					$n = ($i == 0) ? '' : $i;
					$output .= $this->numTagOpen
						. $this->getAJAXlink( $n, $loop )
						. $this->numTagClose;
				}
			}
		}

		// Render the "next" link
		if ($this->currentPage < $numPages){
			$output .= $this->nextTagOpen 
				. $this->getAJAXlink( $this->currentPage * $this->perPage , $this->nextLink )
				. $this->nextTagClose;
		}

		// Render the "Last" link
		if (($this->currentPage + $this->numLinks) < $numPages){
			$i = (($numPages * $this->perPage) - $this->perPage);
			$output .= $this->lastTagOpen . $this->getAJAXlink( $i, $this->lastLink ) . $this->lastTagClose;
		}

		// Remove double slashes
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		$output = $this->fullTagOpen.$output.$this->fullTagClose;
		
		return $output;		
	}

	function getAJAXlink( $count, $text) {
        if( $this->contentDiv == '')
            return '<a href="'. $this->anchorClass . ' ' . $this->baseURL . $count . '">'. $text .'</a>';

        $pageCount = $count?$count:0;
        $this->additionalParam = "{'page' : $pageCount}";
		
	    return "<a href=\"javascript:void(0);\" " . $this->anchorClass . "
				onclick=\"$.post('". $this->baseURL."', ". $this->additionalParam .", function(data){
					   $('#". $this->contentDiv . "').html(data); }); return false;\">"
			   . $text .'</a>';
	}
}
?>