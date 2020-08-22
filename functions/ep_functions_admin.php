<?php

require_once(__DIR__ . '/../config.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../tools/PHPMailer/src/Exception.php';

require __DIR__ . '/../tools/PHPMailer/src/PHPMailer.php';

require __DIR__ . '/../tools/PHPMailer/src/SMTP.php';

//  Creation de la clé de confirmation
function CreateConfirmationKey(){
    $nbr = 24;
    $chn = '';
    for ($i=1;$i<=$nbr;$i++){
        $chn .= chr(floor(rand(0, 25)+65));
    }
    return $chn;
}

function CreateNewUser($mail, $username, $password){
    $dbh = BddConnect();

    //Clean des texts afin d'eviter les injections sql etc...
    $mail = CleanText($mail);
    $username = CleanText($username);
    $password = CleanText($password);
    
    if(!checkEmail($mail)){
        return "Votre adresse mail est invalide";
    }
    if(($return = checkUsername($username))){
        return $return;
    }
    if(($return = checkPassword($password))){
        return $return;
    }

	$requete = "SELECT * FROM epic_users 
    WHERE username='" . $username . "'
    OR mail='" . $mail . "'";
    
    if($result = mysqli_query($dbh, $requete)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                if($row['mail'] == $mail)
                {
                    return "Email déjà utilisé";
                }
                else if($row['username'] == $username)
                {
                    return "Nom d'utilisateur déjà utilisé";
                }
            }
        }
    }

    //Hash du mot de passe
    $password = hash('md5', $password, false);

	$requete = "INSERT INTO `epic_users` 
    (`username`, `password`, `mail`, `confirmed`, `dateRegistred`) 
    VALUES ('" . $username . "', '" . $password . "', '" . $mail . "', 0, '" . date("Y-m-d") . "')";

    mysqli_query($dbh, $requete);

    $keyGen = CreateConfirmationKey();
    //Creation de la clé de confirmation
    $requete = "INSERT INTO `epic_users_confirm_keys` 
    (`id_user`, `key_gen`) 
    VALUES(
	(SELECT id FROM epic_users WHERE username='". $username ."'),
	'". $keyGen ."')";

    mysqli_query($dbh, $requete);

    SendMail($mail, $username, $keyGen);
}


//  Permet l'envoie d'un mail
function SendMail($to, $username, $key){
    require_once('mailTemplate.php');

    $subject = "Confirmation d'inscription";

    $body = getMail($username, $key);

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <noreply@example.com>' . "\r\n";
    $headers .= 'Cc:' . $to . "\r\n";

    $mail = new PHPMailer(true);
    try{
    //$mail->SMTPDebug = 2;
    $mail->CharSet = "UTF-8";
    $mail->isSMTP();
    $mail->Host="mail.epicporn.fr";
    $mail->SMTPAuth="true";
    $mail->Username="no-reply@epicporn.fr";
    $mail->Password=";D0I-V6%%;;X";
    $mail->SMTPSecure="ssl";
    $mail->Port="465";
    

    $mail->SetFrom("no-reply@epicporn.fr", "Epicporn");
    $mail->addAddress($to);

    
    $mail->isHTML(true);
    $mail->Subject  = $subject;
    $mail->Body     = $body;

    $mail->Send();

    } catch (Exception $e){

    }
}

//  Permet de valider un email
function ValidMail($key){
    $dbh = BddConnect();

	$requete = "SELECT id, id_user FROM `epic_users_confirm_keys` 
    WHERE key_gen='" . $key . "'";
    
    if($result = mysqli_query($dbh, $requete)){
        while($row = mysqli_fetch_array($result))
        {
            $requete = "UPDATE `epic_users` 
            SET confirmed=1
            WHERE id='". $row['id_user']  ."'";
    
            mysqli_query($dbh, $requete);
            
            $requete = "DELETE FROM `epic_users_confirm_keys`
            WHERE id='". $row['id']  ."'";
    
            mysqli_query($dbh, $requete);
            return true;
        }
    } else {
        return false;
    }
}



function ConnectUser($username, $password){

    $username = CleanText($username);
    $password = CleanText($password);
    
    if(($return = checkUsername($username))){
        return $return;
    }
    if(($return = checkPassword($password))){
        return $return;
    }

    $dbh = BddConnect();
    $password = hash('md5', $password, false);

	$requete = "SELECT * FROM epic_users 
    WHERE username='" . $username . "'
    AND password='" . $password . "'";
    
    if($result = mysqli_query($dbh, $requete)){
        while($row = mysqli_fetch_array($result))
        {
            $_SESSION["user"] = $row["id"];
        }
    }
    return "Nom d'utilisateur ou mot de passe incorrect";
    
}


function checkEmail($email) {
    /*
    $toFind = array(' ','<', '>', '_');
    $str = str_replace($toFind, '', $email);
    $find1 = strpos($email, '@');
    $find2 = strripos($email, '.');

    return ($find1 !== false && $find2 !== false && $find2 > $find1 && strlen($email) > 6 && strlen($email) < 254 && $email == $str);*/

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return false;
    } else {
        return true;
    }
}
function checkUsername($username){
    $str = preg_replace("/[^A-Za-z0-9]/", '', $username);
    
    $count = strlen($str);

    if($count > 18){
        return "Nom d'utilisateur trop long (18 caractères maximum)";
    } else if ($count < 6){
        return "Nom d'utilisateur trop court (6 caractères minimum)";
    } else if ($str != $username){
        return "Votre nom d'utilisateur est invalide";
    }
}
function checkPassword($password){
    
    $count = strlen($password);

    if($count > 18){
        return "Mot de passe trop long (18 caractères maximum)";
    } else if ($count < 6){
        return "Mot de passe trop court (6 caractères minimum)";
    } 
}

?>