<?php
class Admin {

    private $table;

    public function __construct() {
        $this->table = TABLE_ADM; 
    }

    public function login(string $username, string $password) {
        global $db;
        global $cmn;

        $pass = $cmn->cryptPass($password);
        $data = array(
            'adm_sPwd'=> $pass,
            'adm_sPseudo'=> $username,
            'adm_sEmail'=> $username
        );
        $query = 'SELECT * FROM '.$this->table.' WHERE adm_sPwd = ? AND (adm_sPseudo = ? OR adm_sEmail = ?)';
        $verification = $db->sqlSingleResult($query, $data);
            
        return $verification;

    }

    public function isMailAvailableAdmin(string $email, ?int $id): int
	{
		global $db;
		global $cmn;
		
		$param = array('adm_sEmail'=>$email, 'adm_id'=>$id);
		$verif = $db->sqlSingleResult('SELECT COUNT(adm_id) AS nb FROM '.$this->table.' WHERE adm_sEmail = ? AND adm_id != ?', $param);
		return $verif->nb;
	}

	public function isPseudoAvailableAdmin(string $pseudo, ?int $id): int
	{
		global $db;
		global $cmn;
		
		$param = array('adm_sPseudo'=>$pseudo, 'adm_id'=>$id);
		$verif = $db->sqlSingleResult('SELECT COUNT(adm_id) AS nb FROM '.$this->table.' WHERE adm_sPseudo = ? AND adm_id != ?', $param);
		return $verif->nb;
    }
    
    public function editProfil(array $dataForm)
	{
		global $db;
		global $cmn;
		
        $pseudo = $cmn->text($dataForm["pseudo"]);
        $email = $cmn->text($dataForm["email"]);
        $id = intval($dataForm["id"]);
        
        $verifEmail = $this->isMailAvailableAdmin($email, $id);
        $verifPseudo = $this->isPseudoAvailableAdmin($pseudo, $id);
        
		if($verifPseudo != 0 && $verifEmail == 0){
			return 'pseudo';
        }
        else if($verifPseudo == 0 && $verifEmail != 0){
			return 'email';
        }
        else if($verifPseudo != 0 && $verifEmail != 0){
			return 'all';
		}
		else{
			$tabParams = array(
			'adm_sEmail' => $email,
			'adm_sPseudo' => $pseudo,
			'adm_id' => $id);
			
			$results = $db->sqlSimpleQuery('UPDATE '.$this->table.' SET adm_sEmail=?,adm_sPseudo=? WHERE adm_id = ?',$tabParams);
            $retour = $db->sqlSingleResult('SELECT * FROM '.$this->table.' WHERE adm_id = ?', array("adm_id"=>$id));
            return $retour;
		}
    }
    

    public function changePass(array $dataForm): void
	{
		global $db;
		global $cmn;
		
		$encNouveau = $cmn->cryptPass($dataForm['npass']);
        $tabParams = array('adm_sPwd' => $encNouveau, 'adm_id' => $dataForm['id']);

        $results = $db->sqlSimpleQuery('UPDATE '.$this->table.' SET adm_sPwd = ? WHERE adm_id = ?',$tabParams);
        return;
	}
	
	
	public function changePassVerif(array $dataForm)
	{
		global $db;
		global $cmn;

		$encAncien = $cmn->cryptPass($dataForm['apass']);
        $tabParamsVerif = array('adm_sPwd' => $encAncien, 'adm_id' => $dataForm['id']);
        
		$result = $db->sqlSingleResult('SELECT COUNT(adm_id) AS nb FROM '.$this->table.' WHERE adm_sPwd = ? AND adm_id = ?',$tabParamsVerif);

		if($result->nb == 1) {
            return true;
		}
		else{
			return false;
		}
	}
	

}
?>