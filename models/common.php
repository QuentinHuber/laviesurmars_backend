<?php
class Common {

	public function __construct()
	{

	}

	public function logout(): void
	{
		unset($_SESSION);
		session_destroy();
	}

	public function echappe(string $string): string
	{
		return str_replace("'","''",$string);
	}

	public function text(string $string): string 
	{
		$searched = array('&lt;','&gt;');
		$replaced = array('<','>');

		$string = htmlspecialchars($string, ENT_QUOTES, "UTF-8");
		$string = str_replace($searched,$replaced,$string);

		return $string;
	}

	public function upload(array $file, string $extension, string $destination_dir): string 
	{
		$tmp_name = $file['tmp_name'];
		$name 	  = round(microtime(true)).'.'.$extension;
		$destination = dirname(__DIR__).'/'.$destination_dir;
		move_uploaded_file($tmp_name,$destination.$name);
		return $name;
	}
	
	public function uploadFile(array $file, string $destination, array $autorise): ?string 
	{
		
		 $extre = explode('.',$file['name']);
		 $extension = end($extre);

		 if(in_array($extension,$autorise)){
			return $this->upload($file, $extension, $destination);
		 }
		
		 return null;	
	}

	public function sizeImage(array $file, int $t): bool 
	{
		$taille = $file['size'];
		$autorise = 1024*$t;
		return $taille<=$autorise ? true : false;
	}	

	public function forUrl(string $string): string 
	{
		$string = str_replace('é','e',$string);
		$string = str_replace('?','e',$string);
		$string = $this->noAccent($string);
		$string = strtolower($string);
		$string = str_replace(' ','-',$string);
		$string = str_replace(',','-',$string);
		$string = str_replace("'",'-',$string);
		$string = str_replace('--','-',$string);
		$string = str_replace('_','-',$string);
											
		return $string;
	}

	public function noAccent(string $string): string
	{
		$string = utf8_decode($string);
		$string =  strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ?',
	'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUYe');
		$string = str_replace('?','e',$string);

		return $string;
	}

	public function redirect(string $destination_url): void 
	{
		$js = '<script type="text/javascript">';
		$js .= 'window.location = "'.$destination_url.'";';
		$js .= '</script>';

		echo $js;
	}

	public function verifMail(string $email): bool 
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function envoiMail(string $destinataire, string $sujet, string $contenu, ?string $replyto = NULL): bool
	{

		if(is_null($replyto)) $replyto = EXP_MAIL;

		$from  = "From:".EXP_MAIL."\n";
		$from .= "MIME-version: 1.0\n";
		$from .= "Content-type: text/html; charset= utf-8\n";
		$from .= "Reply-To: $replyto\n";

		$message = '';
		$message .= stripslashes($contenu);

		$envoi = mail($destinataire,$sujet,$contenu,$from);

		return $envoi;
	}

	public function dateFR2EN(string $dateFr): string 
	{
		$tabDate = explode('/',$dateFr);
		return  $tabDate[2].'-'.$tabDate[1].'-'.$tabDate[0];
	}

	public function dateEN2FR(string $dateEN): string
	{
		$tabDate = explode('-',$dateEN);
		return $tabDate[2].'/'.$tabDate[1].'/'.$tabDate[0];
	}

	public function dateTimeEN2FR(string $dateEN): string 
	{
		$tabDateEN = explode(' ',$dateEN);
		$tabDate = explode('-',$tabDateEN[0]);
		return $tabDate[2].'/'.$tabDate[1].'/'.$tabDate[0];
	}

	public function cryptPass(string $password): string 
	{
		return hash('sha512',$password);
	}

	public function formatFileSize(int $size): string 
	{
		if($size > (1024*1024*1024)) {
			return round($size/(1024*1024*1024),2).' Go';
		}
		elseif($size > (1024*1024)) {
			return round($size/(1024*1024),2).' Mo';
		}
		elseif($size > 1024) {
			return round($size/1024).' Ko';
		}
		else {
			return $size.' o';
		}
	}
	
		
		//Genere un mot de passe automatiquement
	public function uniqidReal(int $lenght = 10): string 
	{
		
		if (function_exists("random_bytes")) {
			$bytes = random_bytes(ceil($lenght / 2));
		} elseif (function_exists("openssl_random_pseudo_bytes")) {
			$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
		} else {
			throw new Exception("no cryptographically secure random function available");
		}
		return substr(bin2hex($bytes), 0, $lenght);
	}
	
	public function trunc(string $phrase, int $max): string
	{
		$phrase_array = explode(' ',$phrase);
		if(count($phrase_array) > $max && $max > 0){
			$phrase = implode(' ',array_slice($phrase_array, 0, $max)).'...';
		}
		return $phrase;
	}
		
	public	function affDateFr(string $date): string
	{	
		$tab =explode(' ', $date);
		
		$year = $tab[2];
		$month = $tab[1];
		$day = $tab[0];
		$hour = $tab[4];
		$a = $tab[3];
		
		$str = $day." ";
		if($month == 'January') $str .= "Janvier";
		if($month == 'February') $str .= "F&eacute;vrier";
		if($month == 'March') $str .= "Mars";
		if($month == 'April') $str .= "Avril";
		if($month == 'May') $str .= "Mai";
		if($month == 'June') $str .= "Juin";
		if($month == 'July') $str .= "Juillet";
		if($month == 'August') $str .= "Ao&ucirc;t";
		if($month == 'September') $str .= "Septembre";
		if($month == 'October') $str .= "Octobre";
		if($month == 'November') $str .= "Novembre";
		if($month == 'December') $str .= "D&eacute;cembre";
		$str .= " ".$year." ".$a." ".$hour;
		
		return $str;
	}

	public	function affMoisFr(string $month): string{
		if($month == 'Jan' || $month == 'January'|| $month == '01') $str = "Janvier";
		if($month == 'February' || $month == 'Feb' || $month == '02') $str = "F&eacute;vrier";
		if($month == 'March' || $month == 'Mar' || $month == '03') $str = "Mars";
		if($month == 'April' || $month == 'Apr' || $month == '04') $str = "Avril";
		if($month == 'May' || $month == '05') $str = "Mai";
		if($month == 'June' ||$month == 'Jun' || $month == '06') $str = "Juin";
		if($month == 'July' || $month == 'Jul' || $month == '07') $str = "Juillet";
		if($month == 'August' || $month == 'Aug' || $month == '08') $str = "Ao&ucirc;t";
		if($month == 'September' || $month == 'Sep' || $month == '09') $str = "Septembre";
		if($month == 'October' || $month == 'Oct' || $month == '10') $str = "Octobre";
		if($month == 'November' || $month == 'Nov' || $month == '11') $str = "Novembre";
		if($month == 'December' || $month == 'Dec' || $month == '12') $str = "D&eacute;cembre";
		
		return $str;
	}

	public	function affDateFrNum(string $date): string
	{
		$tab =explode('-', $date);
		
		$year = $tab[0];
		$month = $tab[1];
		$day = $tab[2];
		
		$str = $day." ";
		if($month == 1) $str .= "Janvier";
		if($month == 2) $str .= "F&eacute;vrier";
		if($month == 3) $str .= "Mars";
		if($month == 4) $str .= "Avril";
		if($month == 5) $str .= "Mai";
		if($month == 6) $str .= "Juin";
		if($month == 7) $str .= "Juillet";
		if($month == 8) $str .= "Ao&ucirc;t";
		if($month == 9) $str .= "Septembre";
		if($month == 10) $str .= "Octobre";
		if($month == 11) $str .= "Novembre";
		if($month == 12) $str .= "D&eacute;cembre";
		$str .= " ".$year;
		
		return $str;
	}

	public	function affDateTimeFrNum(string $date): string
	{
		$tab =explode('-', $date);
		
		$year = $tab[0];
		$month = $tab[1];
		$day = $tab[2];
		$times = explode(' ', $day);
		$hour = $times[1];
		$day = $times[0];
		
		$str = $day." ";
		if($month == 1) $str .= "Janvier";
		if($month == 2) $str .= "F&eacute;vrier";
		if($month == 3) $str .= "Mars";
		if($month == 4) $str .= "Avril";
		if($month == 5) $str .= "Mai";
		if($month == 6) $str .= "Juin";
		if($month == 7) $str .= "Juillet";
		if($month == 8) $str .= "Ao&ucirc;t";
		if($month == 9) $str .= "Septembre";
		if($month == 10) $str .= "Octobre";
		if($month == 11) $str .= "Novembre";
		if($month == 12) $str .= "D&eacute;cembre";
		$str .= " ".$year." à ".$hour;
		
		return $str;
	}

}
?>
