<?php

class PhotoUpload {
    protected $src;
    CONST AVALIABLE_TYPES = array(
	"image/jpeg",
	"image/jpg",
	"image/png",
    );
    
    CONST IMG_SIZE=2*1024*1024;
    CONST UPLOAD_DIR='photos';
    
    public function validate(){
	//Првоеряет наличие файла и его размеры, допустимость по размеру
	$file=$_FILES['photo'];
	if(empty($_FILES['photo'])){
	    return FALSE;
	}else if(!in_array($file['type'], self::AVALIABLE_TYPES)){
	    return FALSE;
	}else if($file['size']>self::IMG_SIZE){
		    return FALSE;
		}
		return TRUE;
	}
    
    public function upload(){
	//
	$file = $_FILES['photo'];
	$file_name_parts = explode(".", $file['name']);
	$file_extention = array_pop($file_name_parts);
	$file_base_name = implode("", $file_name_parts);
	$file_name = md5($file_bae_name . rand(1, getrandmax()));
	$file_name .= '.' . $file_extention;
	$this->src = self::UPLOAD_DIR .'/'. $file_name;
	move_uploaded_file($file['tmp_name'], $this->src);
	return $this;
    }

    public function addToDb(){
	if($this->src){
	    $query = "INSERT INTO images (src) VALUES ('{$this->src}')";
	    $dbh = new PDO('mysql:host=localhost;dbname=gallery', 'root', '');
	    $dbh->query($query);
	}
    }
}

$pu=new PhotoUpload();
if($pu->validate()){
    $pu->upload()->addToDb();
}

$images=array();

$query = "SELECT * FROM images";
$dbh = new PDO('mysql:host=localhost;dbname=gallery', 'root', '');
$images = array();
foreach ($dbh->query($query) as $row) {
    $images[] = array(
        'id' => $row['id'],
        'src' => $row['src'],
    );
}
 header('Content-type: application/json');
 echo json_encode($images);