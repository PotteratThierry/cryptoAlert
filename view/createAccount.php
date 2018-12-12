<?php
include_once "../controller/createAccount_controller.php";

include_once "../templates/defaultTop.php";
if($dbConnected)
{
    ?>

    <form class="form" role="form" method="post" action="<?php echo NAME_PAGE;?>">
        <?php if($errorMsg != ""){?><div class="alert alert-danger"><?php echo $errorMsg;?></div><?php }?>
        <?php if($successMsg != ""){?><div class="alert alert-success"><?php echo $successMsg;?></div><?php }?>
        <button type="submit" class="btn btn-primary"><?php echo $lang_send ;?></button>
        <div class="form-group">
            <label><?php echo $lang_loginName;?></label>
            <input id="loginName" type="text" class="form-control" name="<?php echo NEW_USER;?>" value="" placeholder="Nom de compte" />
        </div>
        <div id="login_format">
            <ul>
                <ol class="invalid"><?php echo $lang_errorMsg_loginName ;?></ol>
            </ul>
        </div>
        <div id="login_info">
            <ul>
                <ol class="invalid"><?php echo $lang_errorMsg_existUser ;?></ol>
            </ul>
        </div>
        <div class="form-group">
            <label><?php echo $lang_mail ;?></label>
            <input id="mail" type="email" class="form-control" name="<?php echo MAIL;?>" placeholder="adresse mail">
        </div>
        <div id="mail_format">
            <ul>
                <ol class="invalid"><?php echo $lang_errorMsg_mail ;?></ol>
            </ul>
        </div>
        <div id="mail_info">
            <ul>
                <ol class="invalid"><?php echo $lang_errorMsg_existMail ;?></ol>
            </ul>
        </div>
        <div class="form-group">
            <label><?php echo $lang_dbPassword ;?></label>
            <input type="password" class="form-control pswd" id="pswd" name="<?php echo PASSWORD_1;?>"  placeholder="Mots de passe">
        </div>

        <div class="form-group">
            <label><?php echo $lang_confirm ;?></label>
            <input type="password" class="form-control pswd" id="pswdRepeat" name="<?php echo PASSWORD_2;?>" placeholder="confirmation">
        </div>
        <div id="pswd_info">
            <div id="pswd_info_title"><?php echo $lang_infoPassword ;?></div>
            <ul>
                <li id="letter" class="invalid"><?php echo $lang_infoPasswordLetter ;?></li>
                <li id="capital" class="invalid"><?php echo $lang_infoPasswordUppercase ;?></li>
                <li id="number" class="invalid"><?php echo $lang_infoPasswordNumber ;?></li>
                <li id="length" class="invalid"><?php echo $lang_infoPasswordNumberChar ;?></li>
                <li id="repeat" class="invalid"><?php echo $lang_infoPasswordSame ;?></li>
            </ul>
        </div>

    </form>

    <?php
}
if(!$dbConnected)
{
    ?>
    <div class="alert alert-danger">Impossible de se connecté à la base de donnée<div>
    <?php
}
?>

<?php
include_once "../templates/defaultBottom.php";
?>



<?php
die;
//-------------------------------------------------------//
//connection et manipulation de la base de donnée redis
//-------------------------------------------------------//

// /!\ ses ligne devront être ajouter au modèéle de la base de donnée, (model/model_db).
// elle sont ici que pour les test preliminaires
/*
try
{
    $redis = new Redis();
    $redis->connect('localhost', 6379);
    $redis->set('name', 'Redis is Installed');
    echo $glueStatus = $redis->get('name')."<br>";

} catch (Exception $ex) {
    echo $ex->getMessage();
}*/

//class de connection à une DB
$redis = new dbConnect();

//connection à la base
$redis = $redis->connect();


// set ajout d'une clef
$redis->set("counter", 0);

//verifie l'exitance d'une clef
echo "if existe : ".($redis->exists('counter')) ? "Oui<br>" : "please populate the message key<br>";


//-------------------------------------//
//incementation decrementation de clef //
// ------------------------------------//


//incrémentation de la clef de +1 (x2)
$redis->incr("counter");
$redis->incr("counter");

//decementation de la clef de -1
$redis->decr("counter");

//reset de la clef a 0
$redis->set("counter", 0);

//incrémentation d'une certaine valeur
$redis->incrby("counter", 15);
$redis->incrby("counter", 5);

//decrementation d'une certaine valeur
$redis->decrby("counter", 10);

//verifie l'exitance d'une clef

//recupère la valeur d'une clef
echo "count = ".$redis->get("counter")."<br>";

//---------------------//
//création d'une liste //
//---------------------//


// nom de la liste + valeur
// ATTENTION les valeur ne sont pas unique donc si on execute 2 fois la ligne il y aura 2 fois "french" avec 2 clef différante
// rpush = ajouté au début donc : 0 = arabic 1 = french
$redis->rpush("languages", "french");
$redis->rpush("languages", "arabic");

//lpush = ajouter à la fin donc : 0 = arabic 1 = french 2 englsih 3 swdish
$redis->lpush("languages", "english");
$redis->lpush("languages", "swedish");

//suprrime l'element à gauche donc "arabic"
$redis->lpop("languages");
//supprime l'element à droite donc " swedish"
$redis->rpop("languages");

//recupère la longeur d'une liste
$redis->llen("languages"); // 2

//retourne toute les valeur d'une liste
$all =  $redis->lrange("languages", 0, -1);

//retourne les valeur entre 0 et 1 (ici english et french
$engFr =  $redis->lrange("languages", 0, 1);

//----------------------------//
//création de tableau(Hashes) //
//----------------------------//

$key = 'linus torvalds';

$redis->hset($key, 'age', 44);
$redis->hset($key, 'country', 'finland');
$redis->hset($key, 'occupation', 'software engineer');
$redis->hset($key, 'reknown', 'linux kernel');
$redis->hset($key, 'to delete', 'i will be deleted');

//affiche l'age et la nationalité
echo "age = ".$redis->hget($key, 'age')."<br>"; // 44
echo "country = ".$redis->hget($key, 'country')."<br>"; // Finland

//supprime une valeur
$redis->del($key, 'to delete');

//incrémente l valeur de l'age de 20
$redis->hincrby($key, 'age', 20); // 64

$redis->hmset($key, [
    'age' => 44,
    'country' => 'finland',
    'occupation' => 'software engineer',
    'reknown' => 'linux kernel',
]);

//affiche tout les valeur de la clef
var_dump($redis->hGetAll($key));

//------------------//
// entrée multiple  //
//------------------//

$key = "countries";

//ajout x valeur
$redis->sadd($key, 'china');
$redis->sadd($key, 'england', 'france', 'germany');
$redis->sadd($key, 'china'); // this entry is ignored

//spuprime les clef suivante
$redis->srem($key, 'england', 'china');

$redis->sismember($key, 'england'); // false

//affiche le tableau complet
var_dump($redis->smembers($key));

//-----------------//
// clef temporaire //
//-----------------//
$key = "expire in 1 hour";
//ajout un temps d'expiration à une clef, en secondes
$redis->expire($key, 3600); // expires in 1 hour

//fais demarer l'exiration à partir de l'heur actuel(ou d'une heure donnée)
$redis->expireat($key, time() + 3600); // expires in 1 hour

//recupère le temps resant
$redis->ttl($key);

//modifie une valeur qui doit expirer pour qu'elle n'expire plus
$redis->persist($key);

// supprime toute la base de donnée avec * ou simplement la clef ou valeur specifiée
$redis->delete($redis->keys('*'));

?>



<?php
include_once "../templates/defaultBottom.php";
?>