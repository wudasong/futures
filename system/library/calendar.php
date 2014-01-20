<?php

class Calendar{
	var $YEAR,$MONTH,$DAY;
	var $COLOR_TODAY = "lightgray"; //当前日期的背景色

	var $COLOR_THIS_MONTH = "lightgray"; //当前月的背景色

	var $COLOR_THIS_YEAR = "lightgray"; //当前年的背景色

	var $NUMS_YEAR = 1; //年份下拉表里可以显示的年份数目


	var $WEEK=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
	var $_MONTH=array(
			"01"=>"一月",
			"02"=>"二月",
			"03"=>"三月",
			"04"=>"四月",
			"05"=>"五月",
			"06"=>"六月",
			"07"=>"七月",
			"08"=>"八月",
			"09"=>"九月",
			"10"=>"十月",
			"11"=>"十一月",
			"12"=>"十二月"
	);
	function setYear($year){
		$this->YEAR=$year;
	}
	//获得年份

	function getYear(){
		return $this->YEAR;
	}
	//设置月份

	function setMonth($month){
		$this->MONTH=$month;
	}
	//获得月份

	function getMonth(){
		return $this->MONTH;
	}
	//设置日期

	function setDay($day){
		$this->DAY=$day;
	}
	//获得日期

	function getDay(){
		return $this->DAY;
	}
	//获得方法内指定的日期的星期数 0（表示星期天）到 6（表示星期六）

	function getWeek($year,$month,$day){
		$week=date("w",mktime(0,0,0,$month,$day,$year));//获得星期

		return $week;//获得星期

	}
	//为$YEAR,$MONTH,$DAY赋值

	function _env(){
		if(isset($_POST['month'])){//有指定月

			$month=$_POST['month'];
		}else{
			$month=date("m");//默认为本月

		}
		if(isset($_POST['year'])){//有指年

			$year=$_POST['year'];
		}else{
			$year=date("Y");//默认为本年

		}
		$this->setYear($year);
		$this->setMonth($month);
		$this->setDay(date("d"));
	}
	//打印日历

	function out(){
		$this->_env();
		$week=$this->getWeek($this->YEAR,$this->MONTH,$this->DAY);//获得日期为星期几 （例如今天为2011-10-31，星期一）

		$fweek=$this->getWeek($this->YEAR,$this->MONTH,1);//获得此月第一天为星期几

		//echo "<div style=\"align:center;margin:0;border:1 solid black;font:9pt\"><table border=1 solid align=center><tr><td colspan='7'>

		echo "<table border=1 solid align=center><tr><td colspan='7'>
		<form action=$_SERVER[PHP_SELF] method=\"post\" style=\"margin:0\">
		月份：<select name=\"month\" onchange=\"this.form.submit();\">";
		for($ttmpa=1;$ttmpa<13;$ttmpa++){//打印12个月

			$ttmpb=sprintf("%02d",$ttmpa);
			if(strcmp($ttmpb,$this->MONTH)==0){
				$select="selected style=\"background-color:$this->COLOR_THIS_MONTH\"";
			}else{
				$select="";
			}
			echo "<option value=\"$ttmpb\" $select>".$this->_MONTH[$ttmpb]."</option>";
		}
		echo "</select> 年份：<select name=\"year\" onchange=\"this.form.submit();\">";//打印年份

		for($ctmpa=$this->YEAR-$this->NUMS_YEAR;$ctmpa<=$this->YEAR+$this->NUMS_YEAR;$ctmpa++){
			if($ctmpa>2037){
				break;
			}
			if($ctmpa<1970){
				continue;
			}
			if(strcmp($ctmpa,$this->YEAR)==0){
				$select="selected style=\"background-color:$this->COLOR_THIS_YEAR\"";
			}else{
				$select="";
			}
			echo "<option value=\"$ctmpa\" $select>$ctmpa</option>";
		}
		echo "</select>
		</form></td></tr><tr>";
		for($Tmpa=0;$Tmpa<count($this->WEEK);$Tmpa++){//打印星期标头

			echo "<td>".$this->WEEK[$Tmpa]."</td>";
		}
		echo "</tr><tr>";
		for($Tmpc=0;$Tmpc<$fweek;$Tmpc++){
			echo "<td></td>";
		}
		for($Tmpb=1;$Tmpb<=date("t",mktime(0,0,0,$this->MONTH,$this->DAY,$this->YEAR));$Tmpb++){//打印所有日期

			$Tmpb=sprintf("%02d",$Tmpb);
			if((strcmp($Tmpb,$this->DAY)==0) && ($this->MONTH == date("m")) && ($this->YEAR == date("Y")) ){//获得当前日期，做标记

				$flag=" bgcolor='$this->COLOR_TODAY'";
			}else{
				$flag=" bgcolor='white'";
			}
			if((strcmp($this->getWeek($this->YEAR,$this->MONTH,$Tmpb),0)==0) && (1==$Tmpb)){ //第一天是星期日则不用加<tr>

				echo "<tr><td align=center $flag>$Tmpb</td>"; //星期日则换行，添加行首

			}else if(strcmp($this->getWeek($this->YEAR,$this->MONTH,$Tmpb),0)==0){
				echo "<tr><td align=center $flag>$Tmpb</td>"; //星期日则换行，添加行首

			}else if(strcmp($this->getWeek($this->YEAR,$this->MONTH,$Tmpb),6)==0){
				echo "<td align=center $flag>$Tmpb</td></tr>";//星期六为行尾

			}else{
				echo "<td align=center $flag>$Tmpb</td>";
			}

		}//for($Tmpb=1;$Tmpb<=date("t",mktime(0,0,0,$this->MONTH,$this->DAY,$this->YEAR));$Tmpb++)

		//最后一天是星期六不用再加</tr>

		if(strcmp($this->getWeek($this->YEAR,$this->MONTH,date("t",mktime(0,0,0,$this->MONTH,$this->DAY,$this->YEAR))),6)==0)
			echo "</table>";
		else
			echo "</tr></table>";
	}//out();

}//class Calendar
?>