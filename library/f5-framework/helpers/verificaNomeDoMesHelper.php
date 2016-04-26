<?php

/**
 * verificaNomeDoMesHelper
 * Controle de sessões.
 * @copyright (c) Junho, 2015, Anderson B. Glaeser - F5 Digital
 */
class verificaNomeDoMesHelper {
    public function pegaMes($m) {
		
		if($m == 1) $mm = 'Janeiro';
		else if($m == 2) $mm = 'Fevereiro';
		else if($m == 3) $mm = 'Março';
		else if($m == 4) $mm = 'Abril';
		else if($m == 5) $mm = 'Maio';
		else if($m == 6) $mm = 'Junho';
		else if($m == 7) $mm = 'Julho';
		else if($m == 8) $mm = 'Agosto';
		else if($m == 9) $mm = 'Setembro';
		else if($m == 10) $mm = 'Outubro';
		else if($m == 11) $mm = 'Novembro';
		else if($m == 12) $mm = 'Dezembro';
		
        return $mm;
    }
    public function pegaMesIng($m) {
		
		if($m == 1) $mm = 'January';
		else if($m == 2) $mm = 'February';
		else if($m == 3) $mm = 'March';
		else if($m == 4) $mm = 'April';
		else if($m == 5) $mm = 'May';
		else if($m == 6) $mm = 'June';
		else if($m == 7) $mm = 'July';
		else if($m == 8) $mm = 'August';
		else if($m == 9) $mm = 'September';
		else if($m == 10) $mm = 'October';
		else if($m == 11) $mm = 'November';
		else if($m == 12) $mm = 'December';
		
        return $mm;
    }
}