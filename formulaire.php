<?php

//FORMULAIRE PHP + VERIFICATION + ENVOI DU MAIL

$webmaster = "hassanrennes@gmail.com"; // METTRE TON MAIL ICI

// Style pour le input et le textarea 
$style_input_blanc = "style =    
\"font-family: verdana;
border-right: solid #000000 1px;
border-TOP: solid #000000 1px;
font-size: 8pt;
border-left: solid #000000 1px;
color: #000000;
border-bottom: solid #000000 1px;
background-color: #ffffff \"";

$style_input_rouge ="style = 
\"font-family: verdana;
border-right: solid #000000 1px;
border-top: solid #000000 1px;
font-size: 8pt;
border-left: solid #000000 1px;
color: #000000;
border-bottom: solid #000000 1px;
background-color: #ff0000 \"";

$style_textarea_blanc = "style = \"
font-family: verdana;
border-right: solid #000000 1px;
border-top: solid #000000 1px;
FONT-size: 8pt;
border-left: solid #000000 1px;
color: #000000;
border-bottom: solid #000000 1px;
background-color: #ffffff\"";

$style_textarea_rouge = "style = \"
font-family: verdana;
border-right: solid #000000 1px;
border-top: solid #000000 1px;
font-size: 8pt;
border-left: solid #000000 1px;
color: #000000;
border-bottom: solid #000000 1px;
background-color: #ff0000\"";
// Fin du style


//ENT_QUOTES  Convertit les guillemets doubles et les guillemets simples.
// ENT_NOQUOTES Ignore les guillemets doubles et les guillemets simples.

if(isset($_POST['envoyer'])){ // si une action est faite par l'utilisateur
    
    $alerte = $_POST['envoyer']; //chargement du button envoyer (htmlentities — Convertit tous les caractères éligibles en entités HTML)
    $nom = htmlentities($_POST['nom'], ENT_NOQUOTES); // chargement du nom + mise en forme de la varible
    $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES); // chargement du mail  + mise en forme de la varible  ( htmlspecialchars — Convertit les caractères spéciaux en entités HTML)
    $tel = htmlspecialchars($_POST['tel'], ENT_QUOTES); // chargement du tel + mise en forme de la varible
    $sujet = htmlspecialchars($_POST['sujet'], ENT_QUOTES); // chargement du sujet + mise en forme de la varible
    $message = htmlspecialchars($_POST['msg'], ENT_QUOTES); // chargement du message + mise en forme de la varible
	
}

function verif_null($var){ // fonction qui verifie si le champs est vide
    if($var!=""){
     return $var;
   }
}

function verif_mail($var) // fonction qui verifie si le mail est correct et si le champs est vide
{
   $code_syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#'; // chargement de la syntaxe mail valide  
      if(preg_match($code_syntaxe,$var)){ // compare la syntaxe mail valide au mail saisie
        return $var;
      }   
}

function verif_tel($var) // fonction qui verifie si le n° de tel est correct 
{
   $code_syntaxe='#^[0-9]{9,18}$#'; // chargement de la syntaxe tel valide  
      if(preg_match($code_syntaxe,$var)){ // compare la syntaxe tel valide au tel saisie
        return $var;
      }
      //La fonction PHP preg_match() va nous permettre de rechercher des motifs bien précis au sein d’une chaîne de caractères.
}
function envoi_mail($webmaster,$nom,$mail,$sujet,$tel,$message){ //fonction qui envoie le mail
       $contenu_message = "Nom : ".$nom."\nMail : ".$mail."\nSujet : ".$sujet."\nTelephone : ".$tel."\nMessage : ".$message;
	   $entete = "From: ".$nom." <".$mail."> \nContent-Type: text/html; charset=iso-8859-1";
	 
       mail($webmaster,$sujet,$contenu_message,$entete);
	
	   
}
 

function verif_form($webmaster,$nom,$mail,$sujet,$tel,$message){ //fonction qui verifie si le formulaire est pret a etre envoyer
        if(verif_null($nom) && verif_null($sujet) && verif_null($message) && verif_tel($tel)&& verif_mail($mail)){ // verifie si toute les fontions sont a true
		   envoi_mail($webmaster,$nom,$mail,$sujet,$tel,$message);
		   echo "<font color=\"red\"  size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\" ><strong>Tout les champs sont valider le mail est envoyé. Merci</strong></font><br>"; // Le mail est envoyé
		}else{
		   echo "<font color=\"red\" size=\"3\" face=\"Verdana, Arial, Helvetica, sans-serif\" ><strong>Veuillez saisir correctement tous les champs en rouge.</strong></font><br>"; // Une erreur dans le formulaire
		}
}

?>

<br />
<?php 
if(isset($alerte)){ // verifi si l'utilisateur a fait l'action d'envoyer
   verif_form($webmaster,$nom,$mail,$sujet,$tel,$message); 
}
?>
<br />

<?php /* FORMULAIRE DEBUT */ ?>

<form method="post">
  <table width="44%" height="317" border="0">
    <tr>
      <td width="14%" align="left" valign="middle">
	  <font size="3" face="Verdana, Arial, Helvetica, sans-serif"> Nom :</font>
      </td>
      <td width="86%">
	 <input type="text" name="nom"  size="50" 
	 <?php  if(isset($alerte)){  //si verif_null est false on background en rouge 
              if(verif_null($nom)){ 
                 echo $style_input_blanc; 
              }else { 
                echo $style_input_rouge; 
              }
           } ?> 
        value="<?php  if(isset($alerte)){ echo $nom; } ?>"> 
      </td>
    </tr>
    <tr>
      <td align="left" valign="middle">
	  <font size="3" face="Verdana, Arial, Helvetica, sans-serif">Mail :</font></td>
      <td>	    
	 <input type="text" name="mail" size="50"  
	 <?php  if(isset($alerte)){  //si verif_mail est false on background en rouge 
              if(verif_mail($mail)){ 
                 echo $style_input_blanc; 
              }else { 
                echo $style_input_rouge; 
              }
           } ?> 
        value="<?php  if(isset($alerte)){ echo $mail; } ?>">  
      </td>
    </tr>
    <tr>
      <td valign="middle">
      <font size="3" face="Verdana, Arial, Helvetica, sans-serif">Tel :</font></td>
      <td>  
	 <input type="text" name="tel" size="20"  
	 <?php  if(isset($alerte)){  //si verif_tel est false on background en rouge 
              if(verif_tel($tel)){ 
                 echo $style_input_blanc; 
              }else { 
                echo $style_input_rouge; 
              }
           } ?> 
        value="<?php  if(isset($alerte)){ echo $tel; } ?>"> 
      </td>
    </tr>
      <td align="left" valign="middle">
	 <font size="3" face="Verdana, Arial, Helvetica, sans-serif">Sujet :</font>
      </td>
      <td>
	<input type="text" name="sujet" size="50" 
        <?php  if(isset($alerte)){  //si verif_null est false on background en rouge 
              if(verif_null($sujet)){ 
                 echo $style_input_blanc; 
              }else { 
                echo $style_input_rouge; 
              }
           } ?> 
        value="<?php  if(isset($alerte)){ echo $sujet; } ?>"> 
      </td>
    </tr>
    <tr>
      <td height="181" valign="top">
	 <font size="3" face="Verdana, Arial, Helvetica, sans-serif">Message : </font>
      </td>
      <td valign="top">  
<textarea name="msg"  cols="47" rows="10" <?php  if(isset($alerte)){ if(verif_null($message)){ echo $style_textarea_blanc; }else { echo $style_textarea_rouge; }} ?> ><?php  if(isset($alerte)){ echo $message; } ?></textarea>
      </td>
    </tr>
    <tr>
      <td>
        &nbsp;  
      </td>
      <td>
	<input type="submit"  name="envoyer" value="Envoyer">
        &nbsp;&nbsp;
        <input type="reset" value="Effacer" name="effacer" >
      </td>
    </tr>
  </table>
</form>
<? /* FOMULAIRE FIN*/ ?>

