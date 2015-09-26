<?php
	Class Date{
		private $sqlDate = array('year' => '', 'month' => '', 'day' => '', 'hour' => '', 'minutes' => '', 'seconds' => '');
		private $now = array('year' => '', 'month' => '', 'day' => '', 'hour' => '', 'minutes' => '', 'seconds' => '');
		private $monthSize = array(1 => 31, 2 => 28, 3 => 31, 4 => 30, 5 => 31, 6 => 30, 7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31);
		private $monthName = array(
			'01' => 'jan.', 
			'02' => 'fev.', 
			'03' => 'mar.', 
			'04' => 'abr.', 
			'05' => 'mai.', 
			'06' => 'jun.', 
			'07' => 'jul.', 
			'08' => 'ago.', 
			'09' => 'set.', 
			'10' => 'out.', 
			'11' => 'nov.', 
			'12' => 'dez.');

		private function isSQLDate($date){
			if(strlen($date) == 19){
				$dateFields = split('-', $date);
				$temp = split(' ', $dateFields[2]);
				$dateFields[2] = $temp[0];
				$temp = split(':', $temp[1]);
				foreach($temp as $x){
					$dateFields[sizeof($dateFields)] = $x;
				}
				if(strlen($dateFields[0])==4 && is_numeric($dateFields[0])){
					for($i = 1; $i < sizeof($dateFields); $i++){
						if(strlen($dateFields[$i]) == 2 && is_numeric($dateFields[0])) $error = false;
						else $error = true;
					}
					if($error) return false;
					else return true;
				}
				else return false;
			}
			else return false;
		}

		private function setDateFields($date, $now){
			if($now) $this->now['year'] = substr($date, 0, 4); 
			else $this->sqlDate['year'] = substr($date, 0, 4);
			$keys = array_keys($this->sqlDate);
			$j = 5;
			for($i = 1; $i < sizeof($this->sqlDate); $i++){
				if($now) $this->now[$keys[$i]] = substr($date, $j, 2);
				 
				else $this->sqlDate[$keys[$i]] = substr($date, $j, 2);
				$j += 3;
			}
		}

		private function getMillenniumDate($arr){
			$mllDt['year'] = intval($arr['year'])-2001;
			$mllDt['month'] = intval($arr['month'])+($mllDt['year']*12);
			$mllDt['day'] = intval($arr['day']);
			$mth = 1;
			$year = 2001;
			for($i = 1; $i <= $mllDt['month']; $i++){
				$mllDt['day'] += $this->monthSize[$mth++];
				if($mth == 13){
					$mth = 1;
					if($this->isBissextile($year)) $mllDt['day']++;
					$year++;
				} 
			}
			$mllDt['hour'] = intval($arr['hour'])+($mllDt['day']*24);
			$mllDt['minutes'] = intval($arr['minutes'])+($mllDt['hour']*60);
			$mllDt['seconds'] = intval($arr['seconds'])+($mllDt['minutes']*60);
			return $mllDt;
		}

		private function isBissextile($year){
			return $year%4 == 0 && ($year%100 != 0 || $year%400 == 0);
		}

		private function getFieldDiff($field){
			$mllSqlDate = $this->getMillenniumDate($this->sqlDate);
			$mllNow = $this->getMillenniumDate($this->now);
			foreach($mllNow as $key => $value){
				$diffDate[$key] = $value-$mllSqlDate[$key];
			}
			if($field) return $diffDate[$field];
			else return $diffDate;
		}

		private function getNowDate(){
			return mysql_fetch_array(mysql_query('select now()'))[0];
		}

		public function getFullDate(){
			return $this->sqlDate['day'].' de '.$this->monthName[$this->sqlDate['month']].' às '.$this->sqlDate['hour'].':'.$this->sqlDate['minutes'];
		}

		public function setSqlDate($date){
			if($this->isSQLDate($date)){
				$this->setDateFields($date, false);
				return true;
			}
			else return 'Erro: Data inválida; insira uma data no formato SQL(yyyy-mm-dd hh:mm:ss)';	
		}

		public function getDisplayableDate(){
			if($this->sqlDate['year'] == '') return 'Erro: Não foi setada nenhuma data';
			else{
				$this->setDateFields($this->getNowDate(), true);
				$diff = $this->getFieldDiff(false);
				if($diff['year'] || $diff['month'] || $diff['hour'] >= 48){
					return $this->getFullDate();
				}
				else if($diff['hour'] >= 24){
					return 'Ontem às '.$this->sqlDate['hour'].':'.$this->sqlDate['minutes'];		
				}
				else if($diff['minutes'] >= 60){
					$hour = intval($diff['minutes']/60);
					return 'Há '.$hour.' hora'.($hour>1?'s':'');				
				}
				else if($diff['seconds'] >= 60){
					$minutes = intval($diff['seconds']/60);
					return 'Há '.$minutes.' minuto'.($minutes>1?'s':'');				
				}
				else{
					return 'Agora mesmo';
				}
			}
		}
	}
?>