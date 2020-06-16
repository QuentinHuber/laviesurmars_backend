<?php
class Content {

    private $tableSub;
    private $tableArt;
    private $tableFea;

	public function __construct()
	{
        $this->tableSub = TABLE_SUB;
        $this->tableArt = TABLE_ART;
        $this->tableTya = TABLE_TYA;
        $this->tableFea = TABLE_FEA;
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

    public function listSubject(?int $sta=null): array
    {
        global $db;
        global $cmn;

        if($sta !== null){
            return $db->sqlManyResults('SELECT * FROM '.$this->tableSub.' WHERE sub_iSta=?',array("sub_iSta"=>$sta));
        }
        return $db->sqlManyResults('SELECT * FROM '.$this->tableSub);
    }

    public function listArticle(?int $sub=null): array
    {
        global $db;
        global $cmn;
        if($sub !== null){
            return $db->sqlManyResults('SELECT * FROM '.$this->tableArt.' 
                                        INNER JOIN '.$this->tableTya.' ON '.$this->tableTya.'.tya_id='.$this->tableArt.'.tya_id
                                        WHERE '.$this->tableArt.'.sub_id = ?',
                                        array("sub_id"=>$sub));
        }
        return $db->sqlManyResults('SELECT * FROM '.$this->tableArt.' 
                                    INNER JOIN '.$this->tableTya.' ON '.$this->tableTya.'.tya_id='.$this->tableArt.'.tya_id');
    }

    public function subject(int $id)
    {
        global $db;
        global $cmn;

        return $db->sqlSingleResult('SELECT * FROM '.$this->tableSub.' WHERE sub_id=?',array("sub_id"=>$id));
    }

    public function article(int $id)
    {
        global $db;
        global $cmn;

        return $db->sqlSingleResult('SELECT * FROM '.$this->tableArt.' 
                                    INNER JOIN '.$this->tableTya.' ON '.$this->tableTya.'.tya_id='.$this->tableArt.'.tya_id
                                    INNER JOIN '.$this->tableSub.' ON '.$this->tableSub.'.sub_id='.$this->tableArt.'.sub_id
                                    WHERE art_id=?',array("art_id"=>$id));
    }

    public function type_article()
    {
        global $db;
        global $cmn;

        return $db->sqlManyResults('SELECT * FROM '.$this->tableTya.' ORDER BY tya_sLib ASC');
    }


    public function editSubject(array $dataForm): string
	{
		global $db;
        global $cmn;
		
        $title = trim($cmn->text($dataForm['title']));
        $desc = trim($cmn->text($dataForm['desc']));

        $verif = $db->sqlSingleResult("SELECT COUNT(sub_id) AS nb FROM ".$this->tableSub." WHERE sub_sTitre = ? AND sub_id != ?",
                                        array("sub_sTitre"=>$title, "sub_id"=>$dataForm['id']));

        if($verif->nb > 0) {
            return 'exist';
        }
        if($dataForm['image'] == 0){
            $tabParams = array(
                'sub_sTitre'         => $title,
                'sub_sDescriptif'    => $desc,
                'sub_id'             => $dataForm["id"]
            );
            $update = $db->sqlSimpleQuery('UPDATE '.$this->tableSub.' SET sub_sTitre = ?, sub_sDescriptif = ? WHERE sub_id = ?',$tabParams);
            return 'success';
        }
        else {
            $dest = 'assets/subject/';
            $image = $cmn->uploadFile($_FILES['image'], $dest, array('svg', 'jpg', 'jpeg', 'png'));
    
            if($image !== null){
                $img = SITE_ROOT.$dest.$image;
                $tabParams = array(
                    'sub_sTitre'         => $title,
                    'sub_sDescriptif'    => $desc,
                    'sub_sImage'         => $img,
                    'sub_sRealimage'     => $_FILES['image']['name'],
                    'sub_id'             => $dataForm["id"]
                );
    
                $update = $db->sqlSimpleQuery('UPDATE '.$this->tableSub.' SET sub_sTitre = ?, sub_sDescriptif = ?, sub_sImage = ?, sub_sRealimage = ?  WHERE sub_id = ?',$tabParams);
                return $img;
            }else{
                return 'format';
            }
        }
    }


    public function addArticle(array $dataForm): string
	{
		global $db;
        global $cmn;
		
        $title = trim($cmn->text($dataForm['title']));
        $p1 = trim($cmn->text($dataForm['p1']));
        $p2 = $dataForm['p2'] == 0 ? NULL : $dataForm['p2'];
        $p3 = $dataForm['p3'] == 0 ? NULL : $dataForm['p3'];
        $p4 = $dataForm['p4'] == 0 ? NULL : $dataForm['p4'];
        
        $verif = $db->sqlSingleResult("SELECT COUNT(art_id) AS nb FROM ".$this->tableArt." WHERE art_sTitre = ? AND sub_id = ?",
                                        array("art_sTitre"=>$title, "sub_id"=>$dataForm['idSub']));

        if ($verif->nb > 0) {
            return 'exist';
        }
        
        if ($dataForm['audio'] == 0) {
            $audio = NULL;
        } else {
            $dest = 'assets/article/audio/';
            $audio = SITE_ROOT.$dest.$cmn->uploadOnlyFile($_FILES['audio'], $dest);
        }
        
        if ($dataForm['v1'] == 0) {
            $v1 = NULL;
        } else {
            $dest = 'assets/article/video/';
            $v1 = SITE_ROOT.$dest.$cmn->uploadOnlyFile($_FILES['v1'], $dest);
        }

        if ($dataForm['v2'] == 0) {
            $v2 = NULL;
        } else {
            $dest = 'assets/article/video/';
            $v2 = SITE_ROOT.$dest.$cmn->uploadOnlyFile($_FILES['v2'], $dest);
        }

        if ($dataForm['img1'] == 0) {
            $img1 = NULL;
        } else {
            $dest = 'assets/article/img/';
            $img1 = SITE_ROOT.$dest.$cmn->uploadOnlyFile($_FILES['img1'], $dest);
        }
        if ($dataForm['img2'] == 0) {
            $img2 = NULL;
        } else {
            $dest = 'assets/article/img/';
            $img2 = SITE_ROOT.$dest.$cmn->uploadOnlyFile($_FILES['img2'], $dest);
        }

        $tabParams = array(
            'art_sTitre'     => $title,
            'tya_id'         => $dataForm["theme"],
            'sub_id'         => $dataForm['idSub'],
            'art_sVideo_1'   => $v1,
            'art_sVideo_2'   => $v2,
            'art_sAudio'     => $audio,
            'art_sImage_1'   => $img1,
            'art_sImage_2'   => $img2,
            'art_sPar_1'     => $p1,
            'art_sPar_2'     => $p2,
            'art_sPar_3'     => $p3,
            'art_sPar_4'     => $p4
        );

        $insert = $db->sqlSimpleQuery('INSERT INTO '.$this->tableArt.'
        (art_sTitre,tya_id,sub_id,art_sVideo_1,art_sVideo_2,art_sAudio,
        art_sImage_1,art_sImage_2,art_sPar_1,art_sPar_2,art_sPar_3,art_sPar_4) 
                                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?)',$tabParams);
        return 'success'; 
    }


    public function editArticle(array $dataForm)
	{
		global $db;
        global $cmn;
        
        $title = trim($cmn->text($dataForm['title']));
        $p1 = trim($cmn->text($dataForm['p1']));
        $p2 = $dataForm['p2'] == 0 ? NULL : $dataForm['p2'];
        $p3 = $dataForm['p3'] == 0 ? NULL : $dataForm['p3'];
        $p4 = $dataForm['p4'] == 0 ? NULL : $dataForm['p4'];
        
        $verif = $db->sqlSingleResult("SELECT COUNT(art_id) AS nb FROM ".$this->tableArt." WHERE art_sTitre = ? AND sub_id = ? AND art_id != ?",
                                        array("art_sTitre"=>$title, "sub_id"=>$dataForm['idSub'], "art_id"=>$dataForm['id']));

        if ($verif->nb > 0) {
            return 'exist';
        }
        
        if ($dataForm['audio'] == 0) {
            $audio = $dataForm['audio_m'];
        } else {
            $dest = 'assets/article/audio/';
            $audio = SITE_ROOT.$dest.$cmn->uploadOnlyFile($_FILES['audio'], $dest);
        }
        
        if ($dataForm['v1'] == 0) {
            $v1 = $dataForm['v1_m'] != "" ? $dataForm['v1_m']:NULL;
        } else {
            $dest = 'assets/article/video/';
            $v1 = SITE_ROOT.$dest.$cmn->uploadOnlyFile($_FILES['v1'], $dest);
        }

        if ($dataForm['v2'] == 0) {
            $v2 = $dataForm['v2_m'] != "" ? $dataForm['v2_m']:NULL;
        } else {
            $dest = 'assets/article/video/';
            $v2 = SITE_ROOT.$dest.$cmn->uploadOnlyFile($_FILES['v2'], $dest);
        }

        if ($dataForm['img1'] == 0) {
            $img1 = $dataForm['img1_m'] != "" ? $dataForm['img1_m']:NULL;
        } else {
            $dest = 'assets/article/img/';
            $img1 = SITE_ROOT.$dest.$cmn->uploadOnlyFile($_FILES['img1'], $dest);
        }
        if ($dataForm['img2'] == 0) {
            $img2 = $dataForm['img2_m'] != "" ? $dataForm['img2_m']:NULL;
        } else {
            $dest = 'assets/article/img/';
            $img2 = SITE_ROOT.$dest.$cmn->uploadOnlyFile($_FILES['img2'], $dest);
        }

        $tabParams = array(
            'art_sTitre'     => $title,
            'tya_id'         => $dataForm["theme"],
            'art_sVideo_1'   => $v1,
            'art_sVideo_2'   => $v2,
            'art_sAudio'     => $audio,
            'art_sImage_1'   => $img1,
            'art_sImage_2'   => $img2,
            'art_sPar_1'     => $p1,
            'art_sPar_2'     => $p2,
            'art_sPar_3'     => $p3,
            'art_sPar_4'     => $p4,
            'art_id'         => $dataForm['id']
        );

        $update = $db->sqlSimpleQuery('UPDATE '.$this->tableArt.' SET
        art_sTitre=?,tya_id=?,art_sVideo_1=?,art_sVideo_2=?,art_sAudio=?,
        art_sImage_1=?,art_sImage_2=?,art_sPar_1=?,art_sPar_2=?,art_sPar_3=?,art_sPar_4=? WHERE art_id=?',$tabParams);
        return $this->article($dataForm['id']); 
    }

    public function features()
    {
        global $db;
        global $cmn;

        return $db->sqlSingleResult('SELECT * FROM '.$this->tableFea);
    }

    
    public function editFeautures(array $dataForm)
	{
		global $db;
        global $cmn;
        
        if ($dataForm['video'] == 0) {
            $video = $dataForm['video_m'] != "" ?$dataForm['video_m']:NULL;
        } else {
            $dest = 'assets/features/';
            $video = SITE_ROOT.$dest.$cmn->uploadOnlyFile($_FILES['video'], $dest);
        }  
        $tabParams = array(
            'fea_sVideo'     => $video,
            'fea_iDiametre'         => $dataForm["diametre"],
            'fea_iDistanceSoleil'   => $dataForm["soleil"],
            'fea_sRotation'   => $dataForm["rotation"],
            'fea_iTemperatue'     => $dataForm["temp"],
            'fea_iPhobos'   => $dataForm["phobos"],
            'fea_iDistance'   => $dataForm["distance"],
            'fea_id'         => $dataForm['id']
        );

        $update = $db->sqlSimpleQuery('UPDATE '.$this->tableFea.' SET
        fea_sVideo=?,fea_iDiametre=?,fea_iDistanceSoleil=?,fea_sRotation=?,fea_iTemperatue=?,
        fea_iPhobos=?,fea_iDistance=? WHERE fea_id=?',$tabParams);
        return $this->features(); 
    }
}
?>
