<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);

function getProductInfo(){
    if(isset($_GET['id'])){
        return FindProductById($_GET['id']);
    }
    return null;
}
function GetCountFavoriteProduct(){
    global $db;
	$stmt = $db->prepare("SELECT COUNT(*)as soluong FROM listproduct");
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function FindProductById($id){
    global $db;
	$stmt = $db->prepare("SELECT * FROM listproduct WHERE idProduct=?");
    $stmt->execute (array($id));
return $stmt->fetch(PDO::FETCH_ASSOC);
}

function AddProduct($name,$decription,$price,$data){
    global $db;
    
	$stmt = $db->prepare("INSERT INTO listproduct(NameProduct, Description,Price,MainPicture) VALUES(?,?,?,?)");
$stmt->execute (array($name,$decription,$price,$data)); 
}

function findPostById($id){
    global $db;
	$stmt = $db->prepare("SELECT * FROM post WHERE id=?");
$stmt->execute (array($id)); 
return $stmt->fetch(PDO::FETCH_ASSOC);
}



function loadNewsfeed(){
    global $db;
	$stmt = $db->query("SELECT * FROM post ps join profile pf on ps.userid=pf.userid");
    return $stmt->fetchAll();
}

function UpStatus($content,$userid,$data){
    global $db;
	$stmt = $db->prepare("INSERT INTO post(content,userid,postimage) VALUES(?,?,?)");
$stmt->execute (array($content,$userid,$data)); 
return findPostById($db->lastInsertId());
}
function loadlistProduct(){
    global $db;
	$stmt = $db->query("SELECT * FROM ListProduct");
    return $stmt->fetchAll();
}


function resizeImage($filename, $max_width, $max_height)
{
  list($orig_width, $orig_height) = getimagesize($filename);

  $width = $orig_width;
  $height = $orig_height;

  # taller
  if ($height > $max_height) {
      $width = ($max_height / $height) * $width;
      $height = $max_height;
  }

  # wider
  if ($width > $max_width) {
      $height = ($max_width / $width) * $height;
      $width = $max_width;
  }

  $image_p = imagecreatetruecolor($width, $height);

  $image = imagecreatefromjpeg($filename);

  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

  return $image_p;
}
function SendEmail($to , $subject,$content){
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
try{

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'ltweb18600057@gmail.com';                     // SMTP username
    $mail->Password   = 'ltweblt18600057';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('ltweb18600057@gmail.com', 'Web Web');
    $mail->addAddress($to);     // Add a recipient
    

   
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $content;
  

    $mail->send();
    $a = 1;
    return $a;
} catch (Exception $e) {
    $a = 0;
    return $a;
}
    

}