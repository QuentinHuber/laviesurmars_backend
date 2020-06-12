<?php
class Content {

    private $tableSub;

	public function __construct()
	{
        $this->tableSub = TABLE_SUB;
	}

    
    public function addSubject(array $dataForm): string
	{
		global $db;
        global $cmn;
		
        $title = trim($cmn->text($dataForm['title']));
        $desc = trim($cmn->text($dataForm['desc']));
        
        $verif = $db->sqlSingleResult("SELECT COUNT(sub_id) AS nb FROM ".$this->tableSub." WHERE sub_sTitre = ?",
                                        array("sub_sTitre"=>$title));
        
        if($verif->nb > 0) {
            return 'exist';
        }
        
        $dest = 'assets/subject/';
        $image = $cmn->uploadFile($_FILES['image'], $dest, array('svg', 'jpg', 'jpeg', 'png'));

        if($image !== null){
            $img = SITE_ROOT.$dest.$image;
            $tabParams = array(
                'sub_iSta'           => 1,
                'sub_sTitre'         => $title,
                'sub_sDescriptif'    => $desc,
                'sub_sImage'         => $img,
                'sub_sRealimage'     => $_FILES['image']['name']
            );

            $insert = $db->sqlSimpleQuery('INSERT INTO '.$this->tableSub.'(sub_iSta,sub_sTitre,sub_sDescriptif,sub_sImage,sub_sRealimage) 
                                            VALUES(?,?,?,?,?)',$tabParams);
            return 'success';
        }else{
            return 'format';
        }
    }

    public function listSubject(){
        global $db;
        global $cmn;

        return $db->sqlManyResults('SELECT * FROM '.$this->tableSub);
    }

}
?>
