<?php
	/*****************************
	 * FORMBUILDER CLASS
	 * (c) Stefan Roock
	 * Version 0.01
	 *****************************/

	class formbuilder {
		#---------------------------------------------------------#
		# VARIABEL												  #
		#---------------------------------------------------------#
		
		var $return = "";
		var $formName = "";
		var $submit = "";
		
		var $nextParameter = "";
		var $nextValidation = "";
		var $nextSuggestions = "";
		var $nextHelpText = "";


		
		
		#---------------------------------------------------------#
		# PRIVATE METHODEN										  #
		#---------------------------------------------------------#
		
		//Text zur Ausgabe hinzufügen
		private function add($txt) {
			$this->return .= $txt;
		}
		
		//Ermitteln des CSS Classen Namen
		private function getClassName($lenght) {
			switch($lenght) {
				case 1: $l="text-small"; break;
				case 2: $l="text-medium"; break;
				case 3: $l="text-long"; break;
				default: $l="text-medium"; break;
			}			
			
			return "class=$l";
		}
			
		//Ermittelt alle Eigenschaften für das nächste Feld
		private function getDataKeys($required, $length) {
			$c = $this->getClassName($length);
			$p = $this->nextParameter;
			$s = $this->nextSuggestions;
			$h = $this->nextHelpText;
			$v = $this->nextValidation;
			
			if($required && $this->nextValidation=="") {
				$v = "data-validation='required'";
			}
			
			$this->nextParameter = "";
			$this->nextValidation = "";
			$this->nextSuggestions = "";
			$this->nextHelpText = "";			
			
			return "$c $v $h $s $p";			
		}
		
		//Füge Validierung hinzu
		private function getValidation($typ, $min=0, $max=0) {
			if($this->nextValidation=="") {
				switch($typ) {
					case "number":
						if($min==0 && $max==0) {
							$this->nextValidation = "data-validation='number'";		
						} else {
							$this->nextValidation = "data-validation='number' data-validation-allowing='range[$min;$max]'";							
						}
						break;
						
					case "length":
						if($min==0 && $max>0) {
							$this->nextValidation = "data-validation='length' data-validation-length='max$max'";	
						} elseif($min>0 && $max==0) {
							$this->nextValidation = "data-validation='length' data-validation-length='min$min'";	
						} else {
							$this->nextValidation = "data-validation='length' data-validation-length='$min-$max'";	
						}
						break;
						
					case "email":
						$this->nextValidation = "data-validation='email'";
						break;
						
					case "url": 
						$this->nextValidation = "data-validation='url'";
						break;
						
					default:
						$this->nextValidation = "";
						break;
				}				
			}
		}
				



		#---------------------------------------------------------#
		# PUBLIC METHODEN										  #
		#---------------------------------------------------------#
			
		//Konstruktor
		public function __construct($name, $submit, $method="POST") {
			$this->formName = $name;
			$this->submit = $submit;
			
			$this->add("<fieldset>");
			$this->add("<form method='$method' id='$this->formName'>");
		} 
		
		//Zusätzliche Parameter hinzufügen (wie style, onclick, etc.)
		public function addExtraParameter($array) {
			$para = "";	
				
			foreach($array as $var =>$val) {
				$para .= $var."='".$val."' ";
			}
			
			$this->nextParameter = $para;
		}
		
		public function addLength($min, $max=0) {
			$this->getValidation("length", $min, $max);
		}
			
		//Füge Vorschläge hinzu
		public function addSuggestions($array) {
			$para = implode(", ", $array);	
			$this->nextSuggestions = "data-suggestions='".$para."'";		
		}
		
		//Füge einen Hilfe Text hinzu
		public function addHelpText($text) {
			$this->nextHelpText = "data-validation-help='$text'";
		}
		
		
		
		//Normales Input Feld
		public function textfield($lable, $name, $value="", $lenght=3, $required=TRUE) {
			$d = $this->getDataKeys($required, $lenght);
			
			$this->add("<p>");
			$this->add("<label for=$name>$lable:</label>");
			$this->add("<input type=text name=$name id=$name value='$value' $d />");
			$this->add("</p>");		
		}
		
		//E-Mail Input Feld
		public function email($lable, $name, $value="", $lenght=3, $required=TRUE) {
			$this->getValidation("email");
			$d = $this->getDataKeys($required, $lenght);
			
			$this->add("<p>");
			$this->add("<label for=$name>$lable:</label>");
			$this->add("<input type=email name=$name id=$name value='$value' $d />");
			$this->add("</p>");		
		}
		
		//E-Mail Input Feld
		public function number($lable, $name, $value="", $min=0, $max=0, $lenght=2, $required=TRUE) {
			$this->getValidation("number", $min, $max);
			$d = $this->getDataKeys($required, $lenght);
			
			$this->add("<p>");
			$this->add("<label for=$name>$lable:</label>");
			$this->add("<input type=number name=$name id=$name value='$value' $d />");
			$this->add("</p>");		
		}
		
		//Passwort Feld
		public function password($lable, $name, $value="", $lenght=3, $required=TRUE) {
			$d = $this->getDataKeys($required, $lenght);
			
			$this->add("<p>");
			$this->add("<label for=$name>$lable:</label>");
			$this->add("<input type=password name=$name id=$name value='$value' $d />");
			$this->add("</p>");		
		}
		
		//E-Mail Input Feld
		public function date($lable, $name, $value="", $lenght=2, $required=TRUE) {
			$d = $this->getDataKeys($required, $lenght);
			
			$this->add("<p>");
			$this->add("<label for=$name>$lable:</label>");
			$this->add("<input type=date name=$name id=$name value='$value' $d />");
			$this->add("</p>");		
		}
		
		//E-Mail Input Feld
		public function time($lable, $name, $value="", $lenght=2, $required=TRUE) {
			$d = $this->getDataKeys($required, $lenght);
			
			$this->add("<p>");
			$this->add("<label for=$name>$lable:</label>");
			$this->add("<input type=time name=$name id=$name value='$value' $d />");
			$this->add("</p>");		
		}
		
		//Passwort Feld
		public function textarea($lable, $name, $value="", $row=3, $lenght=3, $required=TRUE) {
			$d = $this->getDataKeys($required, $lenght);
			
			$this->add("<p>");
			$this->add("<label for=$name>$lable:</label>");
			$this->add("<textarea name=$name rows=$row $d>$value</textarea>");
			$this->add("</p>");		
		}
		
		//Checkbox
		public function checkbox($lable, $name, $value, $checked=FALSE, $required=TRUE) {
			$d = $this->getDataKeys($required, 3);

			if($checked) { $c = "checked=checked"; } else { $c = ""; }
			
			$this->add("<p>");
			$this->add("<span class=checkbox>");
			$this->add("<input type=checkbox name=$name id=$name value=$value $c $d>");
			$this->add("<label for=$name>$lable</label>");
			$this->add("</span>");
			$this->add("</p>");	
		}		
		
		public function radio($name, $options, $checked=FALSE, $required=TRUE) {
			$d = $this->getDataKeys($required, 3);
			
			$this->add("<p>");
			foreach($options as $id => $val) {
				if($checked==$val['1']) { $c = "checked=checked"; } else { $c = ""; }
				
				$this->add("<span class=checkbox>");
				$this->add("<input type=radio name=$name id=$name$id value=$val[1] $c $d>");
				$this->add("<label for=$name$id>$val[0]</label>");
				$this->add("</span>");				
			}
			$this->add("</p>");	
		}

		public function dropdown($lable, $name, $options, $checked=false, $required=TRUE) {
			$d = $this->getDataKeys($required, 3);
			
			$this->add("<p>");
			$this->add("<label for=$name>$lable</label>");
			$this->add("<select name=$name id=$name class=dropdown $d>");
			
			
			foreach($options as $var => $val) {
				if($var == $checked) { $s = "selected"; } else { $s = ""; }
				$this->add("<option value='$var' $s>$val</option>");
			}

            $this->add("</select>");    
            $this->add("</p>");     
		}
		
		public function hidden($name, $value) {
			$this->add("<input type=hidden name=$name id=$name value=$value>");
		}
		
		
		public function infoText($txt) {
			$this->add("<p>");	
			$this->add($txt);	
			$this->add("</p>");		
		}
		
		public function link($txt) {
			$this->add("<span style='float: right;'>");	
			$this->add($txt);	
			$this->add("</span>");		
		}
		 
		public function buildForm($onClick=false) {
			if($onClick!=false) {
				$this->add("<input type=button class=button-submit name='$this->formName' value='$this->submit' onClick='$onClick'>");
			} else {
				$this->add("<input type=submit class=button-submit name='$this->formName' value='$this->submit'>");
			}	

			$this->add("</form>");
			$this->add("</fieldset>");
			
			$this->add("<script>$.validate();</script>");
			
			echo $this->return;
		}
		
	}

?>