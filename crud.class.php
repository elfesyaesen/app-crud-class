<?php 
    class PhpYardimlasmaGrubu
    {
        /* VERİTABANI BAĞLANTISI İÇİN GEREKLİ PARAMETRELER TANIMLANDI.. */
        protected $pdo = null;
        protected $host = 'localhost';
        protected $user = 'root';
        protected $pass = '';
        protected $dbname   = 'crud';
        protected $charset = 'utf8';
        protected $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        /* VERİTABANI BAĞLANTI KURULUMU */
        public function __construct()
        {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
            try {
             $this->pdo = new PDO($dsn, $this->user, $this->pass, $this->options);
            } catch (\PDOException $e) {
             throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
	//db veri ekleme
   public function pdoPrepareInsert($sql,$args = []){
     $prepare = $this->pdo->prepare($sql);
     $prepare->execute($args);
     $result = $prepare->fetch(PDO::FETCH_ASSOC);
	 $lastInsertID = $this->pdo->lastInsertID();
     if($lastInsertID){ return true; }else{ return false; }
   }
	//db veri güncelleme
   public function pdoPrepareUpdate($sql,$args = []){
     $prepare = $this->pdo->prepare($sql);
     $prepare->execute($args);
     $result = $prepare->fetch(PDO::FETCH_ASSOC);
	 $rowCount = $prepare->rowCount();
     if($rowCount){ return true; }else{ return false; }
   }
   //db veri silme
   public function pdoPrepareDelete($sql,$args = []){
     $prepare = $this->pdo->prepare($sql);
     $prepare->execute($args);
     $result = $prepare->fetch(PDO::FETCH_ASSOC);
	 $rowCount = $prepare->rowCount();
     if($rowCount){ return true; } else{ return false; }
   }
   //db tekli veri çekme
   public function pdoQuerySingle($sql){
	   $query = $this->pdo->query($sql);
	   $result = $query->fetch(PDO::FETCH_ASSOC);
     if($result){ return $result; }else{ return false; }
   }
   //db çoklu veri çekme
   public function pdoQueryMultiple($sql){
	   $query = $this->pdo->query($sql);
	   $result = $query->fetchAll(PDO::FETCH_ASSOC);
     if($result){ return $result; }else{ return false; }
   }
	//input boş mu kontrol
    public function pdoEmpty($variable){
        if(is_array($variable)){
            foreach ($variable as $value) {
                if(is_null($value)){
                    return false;
                } elseif (empty($value)) {
                    return false;
                }
            }
        } elseif (is_null($variable)) {
            return false;
        } elseif (empty($variable)) {
            return false; }
        return true;
    }
	
	//koşullu çoklu veri çekme
   public function pdoPrepareMultiple($sql,$args = []){
     $prepare = $this->pdo->prepare($sql);
     $prepare->execute($args);
     $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
     if($result){ return $result; }else{ return false; }
   }
   //koşullu tekli veri çekme
      public function pdoPrepareSingle($sql,$args = []){
     $prepare = $this->pdo->prepare($sql);
     $prepare->execute($args);
     $result = $prepare->fetch(PDO::FETCH_ASSOC);
     if($result){ return $result; } else{ return false; }
   }
   //resim yükleme
 public function upload($image_input_name,$upload_path){
      $input         = $image_input_name;
      $klasor        = $upload_path;
      $target_dir    = $klasor;
      $target_file   = $target_dir . basename($_FILES[$input]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $filename      = strtotime(date('Ymd H:i:s'));
      $extension     = pathinfo( $_FILES[$input]["name"], PATHINFO_EXTENSION );
      $basename      = $filename . "." . $extension;
      $yeniyol       = $target_dir.$basename;
      $image_upload = move_uploaded_file($_FILES[$input]["tmp_name"], $yeniyol);
	  if ($image_upload) {
		  return $basename;
	  } else { return false; }
 }
//güvenlik fonksiyonu
public function getSecurity($data){
     if(is_array($data)){
          $varible  = array_map('htmlspecialchars',$data);
          $response = array_map('stripslashes',$varible);
          $respon   = str_replace(["INSERT","DELETE","UPDATE","delete","insert","update","JOIN","SHOW","DECLARE","ALTER","CREATE","ADD"]," ",$response);
          return $respon;
     }else{
          $varible  = htmlspecialchars($data);
          $response = stripslashes($varible);
          $respon   = str_replace(["INSERT","DELETE","UPDATE","delete","insert","update","JOIN","SHOW","DECLARE","ALTER","CREATE","ADD"]," ",$response);
          return $respon;
     }
}

public function getDate(){
	return date('Y.m.d H:i:s');
}
    }
