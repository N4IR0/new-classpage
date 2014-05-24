<?php
	class tablebuilder {
		var $return = "";
		var $rows = 0;
		var $rowOpen = false;
		
		private function add($txt) {
			$this->return .= $txt;
		}
		
		private function extraParameter($array) {
			$para = "";	
				
			foreach($array as $var =>$val) {
				$para = $var."='".$val."' ";
			}
			
			return $para;
		}
		
		public function __construct() {
			$this->add("<table>");
		} 
		
		public function noHeader() {
			$this->rows++;
		}
		
		public function addRow() {			
			if($this->rows%2 == 1) {
				$class = "class='odd'";
			} else {
				$class = "";
			}

			if($this->rowOpen) {
				$this->add("</tr>");
				$this->rowOpen=false;
			}
			
			$this->add("<tr $class>");
			$this->rows++;
			$this->rowOpen = true;
		}
		
		public function addCloum($txt, $action="") {
			if($this->rows<=1) {
				$var = "th";
			} else {
				$var = "td";
			}
			
			if($action!="") {
				$this->add("<$var class='$action'>");	
			} else {
				$this->add("<$var>");
			}

			$this->add($txt);
			$this->add("</$var>");
		}
		
		public function buildTable() {
			$this->add("</tr></table>");
			
			echo $this->return;
		}
		
	}

?>