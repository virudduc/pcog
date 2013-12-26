<?php
class Paging{	

	function showSortBy($var_sort_by, $arr_sort_by ){
		$arrsortby = array();
		list($order_by, $order_by2 )		 = explode(':', $var_sort_by);

		if(count($arr_sort_by)>0){
			foreach($arr_sort_by as $s_k => $s_v){
					if($s_v == $order_by){
						if($order_by2 == 'asc'){
						$get_qry_str			=  $_SERVER['PHP_SELF'].$this->get_qry_str(array('order_by','order_by2'),array($s_v,'desc'));
						$arrsortby[$s_v]	= '<a href="'.$get_qry_str.'"><span style="float:left"><b>'.$s_k.'</b></span> <span style="float:right"> <img src="'.IMAGES_DIR.'sort_asc.gif"> </span></a>';
						}else{
						$get_qry_str			=  $_SERVER['PHP_SELF'].$this->get_qry_str(array('order_by','order_by2'),array($s_v,'asc'));
						$arrsortby[$s_v]	= '<a href="'.$get_qry_str.'"><span style="float:left"><b>'.$s_k.'</b></span> <span style="float:right"> <img src="'.IMAGES_DIR.'sort_desc.gif"> </span></a>';
						}
					}else{
						$get_qry_str			=  $_SERVER['PHP_SELF'].$this->get_qry_str(array('order_by','order_by2'),array($s_v,'asc'));
						$arrsortby[$s_v]	= '<a href="'.$get_qry_str.'"><span style="float:left"><b>'.$s_k.'</b></span> <span style="float:right"> <img src="'.IMAGES_DIR.'spacer.gif" width="10px" height="10px"> </span></a>';
					}
			}
		}
		return $arrsortby;
	}

	function get_qry_str($over_write_key = array(), $over_write_value= array())
		{
		global $_GET;
		$m = $_GET;
			if(is_array($over_write_key))
				{
				$i=0;
				foreach($over_write_key as $key)
					{
					$m[$key] = $over_write_value[$i];
					$i++;
					}
				}else{
				$m[$over_write_key] = $over_write_value;
				}
		$qry_str = $this->qry_str($m);
		return $qry_str;
		} 

	function qry_str($arr, $skip = ''){
			$s = "?";
			$i = 0;
			foreach($arr as $key => $value) {
				if ($key != $skip) {
					if ($i == 0) {
						$s .= "$key=$value";
						$i = 1;
					} else {
						$s .= "&$key=$value";
					} 
				} 
			}
	return $s;
	} 

	function showPaging($reccnt, $pagesize, $m, $start){
			$page_str = "";
			if($reccnt!=0){	
			$pagenum	= $reccnt/$pagesize;
			$PHP_SELF	= $_SERVER['PHP_SELF'];


			$qry_str	= $_SERVER['argv'];

			if(count($_SERVER['argv'])>0){
			$qry_str	= $_SERVER['argv'];
			}

			//$m			= $_GET;
			unset($m['start']);
			$qry_str	= $this->qry_str($m);
				if($pagenum>40){
					$j	= $start/$pagesize;		
					$k	= $j+40;
					if($k>$pagenum){
						$k=$pagenum;
					}
				}else{
					$j	= 0;
					$k	= $pagenum;
				}
		
		if($pagenum>1){
			//	$page_str .='<table width="100%" height="26" border="0" align="center" cellpadding="0" cellspacing="0">';	
			//	$page_str .='<tr> <td align="left" >&nbsp;</td> ';	
			//	$page_str .=' <td  height="20"><b>';	
				
			//	$page_str .='</b></td>';	
			//	$page_str .='<td align="right"><b>';	
				if($start!=0){
				$page_str .='<a href="'.$PHP_SELF.$qry_str.'&start='.($start-$pagesize).'"  style="text-decoration:none;" ><b>&laquo; Previous</b></a>';
				}elseif($start!='0'){
				$page_str .='<a href="#"><b>&laquo; Previous</b></a>';
				}

				for($i=$j;$i<$k;$i++){
				if($i==$j)$page_str .= "  ";
					if(($pagesize*($i))!=$start){
						$page_str .= '<a href="'.$PHP_SELF.$qry_str.'&start='.$pagesize*($i).'" style="text-decoration:none;" >';
						$page_str .= $i+1;
						$page_str .= '</a>&nbsp;';
					}else{
						$page_str .= '<span><b>'.($i+1).'</b></span>';
						$page_str .= '&nbsp;';
					}
				}
				$page_str .='&nbsp;';
				if($start+$pagesize < $reccnt){
					
				$page_str .='<a href="'.$PHP_SELF.$qry_str.'&start='.($start+$pagesize).'"  style="text-decoration:none;" ><b>Next &raquo;</b></a>';
				}
                //elseif($pagesize < $reccnt){
				//$page_str .='<a href="#"><b>Next &raquo;</b></a>';	
				//}
		//		$page_str .=' </b>&nbsp;&nbsp;</td></tr>';
		//		$page_str .=' </table>';
				}else{
				$page_str = "<BR />";
				}
			}

		return $page_str;
		}
	//Paging Functions End
	


	//--Site Paging Functions

	function showSitePaging($reccnt, $pagesize, $m, $start){
			$page_str = "";
			if($reccnt!=0){	
			$pagenum	= $reccnt/$pagesize;
			$PHP_SELF	= $_SERVER['PHP_SELF'];


			$qry_str	= $_SERVER['argv'];

			if(count($_SERVER['argv'])>0){
			$qry_str	= $_SERVER['argv'];
			}

			//$m			= $_GET;
			unset($m['start']);
			$qry_str	= $this->qry_str($m);
				if($pagenum>40){
					$j	= $start/$pagesize;		
					$k	= $j+40;
					if($k>$pagenum){
						$k=$pagenum;
					}
				}else{
					$j	= 0;
					$k	= $pagenum;
				}
		
		if($pagenum>1){
			//	$page_str .='<table width="100%" height="26" border="0" align="center" cellpadding="0" cellspacing="0">';	
			//	$page_str .='<tr> <td align="left" >&nbsp;</td> ';	
			//	$page_str .=' <td  height="20"><b>';	
				
			//	$page_str .='</b></td>';	
			//	$page_str .='<td align="right"><b>';	

				if($start!=0){
				$page_str .='<a href="'.$PHP_SELF.$qry_str.'&start='.($start-$pagesize).'"  style="text-decoration:none;" ><b>&laquo; Previous</b></a>';
				}else{
				$page_str .='';
                //$page_str .='<a href="#"><b>&laquo; Previous</b></a>';
				}

				for($i=$j;$i<$k;$i++){
				if($i==$j)$page_str .= " |&nbsp;Page : ";
					if(($pagesize*($i))!=$start){
						$page_str .= '<a href="'.$PHP_SELF.$qry_str.'&start='.$pagesize*($i).'" style="text-decoration:none;" >';
						$page_str .= $i+1;
						$page_str .= '</a>&nbsp;';
					}else{
						$page_str .= '<span style="color:#ff9625; font-size:14px;"><b>'.($i+1).'</b></span>';
						$page_str .= '&nbsp;';
					}
				}
				$page_str .='&nbsp;&nbsp;|&nbsp;&nbsp;';
				if($start+$pagesize < $reccnt){
					
				$page_str .='<a href="'.$PHP_SELF.$qry_str.'&start='.($start+$pagesize).'"  style="text-decoration:none;" ><b>Next &raquo;</b></a>';
				}else{
				$page_str .='<a href="#"><b>Next &raquo;</b></a>';	
				}
		//		$page_str .=' </b>&nbsp;&nbsp;</td></tr>';
		//		$page_str .=' </table>';
				}else{
				$page_str = "<BR />";
				}
			}
		return $page_str;
	}
}
?>