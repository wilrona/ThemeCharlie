<?php
namespace App\Controllers;


use App\Models\Whatsapp;
use TypeRocket\Controllers\Controller;
use TypeRocket\Http\Request;
use TypeRocket\Http\Response;

class WhatsappController extends Controller
{
    protected $modelClass = Whatsapp::class;

    protected $APIurl;
    protected $token;

    public function __construct(Request $request, Response $response)
    {
        $this->APIurl = 'https://api.chat-api.com/instance76908/';
        $this->token = '6oguke9wauk5cy0w';

        parent::__construct($request, $response);
    }


    public function botMessage(){

        $this->APIurl = 'https://api.chat-api.com/instance76908/';
        $this->token = '6oguke9wauk5cy0w';

        // get the JSON body from the instance
        $json = file_get_contents('php://input');
        $decoded = json_decode($json,true);


        ob_start();
        var_dump($decoded);
        $input = ob_get_contents();
        ob_end_clean();
//        file_put_contents(get_template_directory().'/input_requests.log',$input.PHP_EOL,FILE_APPEND);


        if(isset($decoded['messages'])) {
            //check every new message
            foreach ($decoded['messages'] as $message) {

                if (!$message['fromMe']) {

                    $this->readMessage($message['chatId']);

                    $phone = explode('@', $message['author']);

                    $indication = tr_options_field('options.indications');

                    $correct_indication = false;

                    foreach ($indication as $indic):
                        if(substr(mb_strtolower($phone[0],'UTF-8'), 0, strlen($indic['indication'])) === $indic['indication'] && $indic['active']):
                            $correct_indication = true;
                            break;
                        endif;
                    endforeach;

                    $text = explode(' ',trim($message['body']));

                    if($correct_indication):

                        $subscriber = $this->check_participant($phone[0]);

                        if(!$subscriber->iduser):

                            $prefix_secret = tr_options_field('options.secret_prefix');
                            $prefix_activa = tr_options_field('options.activa_prefix');

                            $text_search = preg_replace("/[^a-zA-Z-0-9]/", "", $text[0]); // supprimer les etoiles sur le texte envoyé

                            $is_secret = substr(mb_strtolower($text_search,'UTF-8'), 0, strlen($prefix_secret)) === strtolower($prefix_secret);
                            $is_activa = substr(mb_strtolower($text_search,'UTF-8'), 0, strlen($prefix_activa)) === strtolower($prefix_activa);

                            if($is_secret):
                                $text_search = substr(mb_strtolower($text_search,'UTF-8'), 0, strlen($prefix_secret));
                            endif;

                            if($is_activa):
                                $text_search = substr(mb_strtolower($text_search,'UTF-8'), 0, strlen($prefix_activa));
                            endif;

                            switch(mb_strtolower($text_search,'UTF-8')){
                                case strtolower($prefix_secret): {


                                    $parrain_search = ltrim(strtolower(preg_replace("/[^a-zA-Z-0-9]/", "", $text[0])), strtolower($prefix_secret));
                                    $parent = (new Whatsapp())->where('codeParrain', '=', $parrain_search)->first();

                                    if($parent):

                                        $subscriber = (new Whatsapp)->findById($subscriber->id);
                                        $subscriber->idparent = $parent->id;
                                        $subscriber->save();

                                        $this->existParent($message['chatId'], true);
                                        sleep(3);
                                        $this->choiceTypeUser($message['chatId']);

                                    else:

                                        $this->existParent($message['chatId']);

                                    endif;

                                    break;
                                }
                                case strtolower($prefix_activa):{

                                    $subscriber = (new Whatsapp)->findById($subscriber->id);
                                    $subscriber->codeactivation = strtoupper(preg_replace("/[^a-zA-Z-0-9]/", "", $text[0]));
                                    $subscriber->save();

                                    $string = "*Code d'activation enregistré*\n\n";
                                    $string .= "Votre code d'activation a été enregistré avec succès. Vous pouvez terminer/continuer votre inscription sur le site web.";

                                    $this->sendMessage($message['chatId'], $string);

                                    break;
                                }

                                case 'inscriremembre' :
                                case '*inscriremembre*' :{

                                    $activa_prefix = tr_options_field('options.activa_prefix');

                                    $codeactivation = strtolower(strtoupper($activa_prefix).''.generateParrainCode(6));;

                                    $subscriber = (new Whatsapp)->findById($subscriber->id);
                                    $subscriber->codeactivation = $codeactivation;
                                    $subscriber->save();


                                    $string = "*Lien d'inscription en tant que membre*\n\n";
                                    $string .= "Si vous avez des problemes d'inscription, cliquez sur ce lien d'inscription.\n\n";
                                    $string .= "".home_url('/register/membre/'.$codeactivation)."";

                                    $this->sendMessage($message['chatId'], $string);

                                    break;
                                }

                                case 'inscrireescort' :
                                case '*inscrireescort*' :{

                                    $activa_prefix = tr_options_field('options.activa_prefix');

                                    $codeactivation = strtolower(strtoupper($activa_prefix).''.generateParrainCode(6));

                                    $subscriber = (new Whatsapp)->findById($subscriber->id);
                                    $subscriber->codeactivation = $codeactivation;
                                    $subscriber->save();

                                    $string = "*Lien d'inscription en tant que escort*\n\n";
                                    $string .= "Si vous avez des problemes d'inscription, cliquez sur ce lien d'inscription.\n\n";
                                    $string .= "".home_url('/register/escort/'.$codeactivation)."";

                                    $this->sendMessage($message['chatId'], $string);

                                    break;
                                }

                                case 'membre':
                                case 'm':
                                case 'e':
                                case 'escort': {

                                     if($subscriber->idparent):

                                         $type = $text_search;
                                         if($text_search === 'membre'):
                                             $type = 'm';
                                         endif;

                                         if($text_search === 'escort'):
                                             $type = 'e';
                                         endif;

                                        $subscriber = (new Whatsapp)->findById($subscriber->id);
                                        $subscriber->typeUser = $type;
                                        $subscriber->save();

                                        $string = "*Type d'inscription enregistré*\n\n";
                                        $string .= "Votre inscription a été initialisée. Entrez dans ce lien ".home_url('/start/'.$subscriber->numero)." pour completer";
                                        $string .= " votre inscription.";

                                        $this->sendMessage($message['chatId'], $string);
                                     else:

                                         $string = "*Type d'inscription non enregistré*\n\n";
                                         $string .= "Envoyez au préalable le code secret avant de définir votre type d'inscription";

                                         $this->sendMessage($message['chatId'], $string);
                                     endif;

                                    break;
                                }

                                default: {

                                    if(!$subscriber->sessions):

                                        $string = "*Charlie et ses droles de dames* \n\n";
                                        $string .= "Bienvenue sur l'assistant de charliescort.tk \n";
                                        $string .= "Envoyez le code d'activation ou le code secret pour initier votre inscription.\n";

                                        $this->sendMessage($message['chatId'], $string);

                                        $subscriber = (new Whatsapp)->findById($subscriber->id);
                                        $subscriber->sessions = 1;
                                        $subscriber->save();

                                    else:

                                        if($subscriber->sessions === 2):

                                            $conseiller = tr_options_field('options.conseiller');

                                            $string = "*Assistance charliescort.tk* \n\n";
                                            $string .= "Si vous avez besoin d'assistance avec un téléconseiller, Ecrivez à l'un de ces numéros par whatsapp.\n\n";
                                            foreach ($conseiller as $conseil):

                                                $string .= "- *".$conseil."*\n";

                                            endforeach;

                                            $this->sendMessage($message['chatId'], $string);

                                        endif;

                                        if($subscriber->sessions <= 2):

                                            $subscriber = (new Whatsapp)->findById($subscriber->id);
                                            $subscriber->sessions = $subscriber->sessions + 1;
                                            $subscriber->save();

                                        endif;
//
                                    endif;

                                    break;
                                }

                            }

                        else:

                            switch(mb_strtolower($text[0],'UTF-8')){

                                case 'affiliation':
                                case '*affiliation*': {
                                    $string = "*Programme d'affiliation*\n\n";
                                    $string .= "Envoyer : \n\n";
                                    $string .= "  - *afficode* : pour recevoir votre code et le message d'affiliation à partager dans votre reseau \n";

                                    $this->sendMessage($message['chatId'], $string);
                                    break;

                                }

                                case 'afficode':
                                case '*afficode*':{

                                    $prefix_secret = tr_options_field('options.secret_prefix');
                                    $code = strtoupper($prefix_secret."".$subscriber->codeParrain);

                                    $string = "Votre code secret est : *".$code."*";
                                    $this->sendMessage($message['chatId'], $string);

                                    $string = "*Comment tu te fais plus de revenu ?*\n\n";
                                    $string .= "Partage le message suivant en invitant des escorts Girls/Boys afin que tu puisse gagner 20% du montant des frais de la mise en relation ";
                                    $string .= "entre un membre et votre escort enregistre(e).";

                                    $this->sendMessage($message['chatId'], $string);

                                    $string = "*Message à partager*\n\n";
                                    $string .= "Bonjour,\n\n";
                                    $string .= "Je te presente un réseau de mise en relation entre les clients vérifiés et les escorts Girls/Boys (accompagnateur(trice) de soirée et divers si possible). Le réseau s’appelle charliescort\n\n";
                                    $string .= "Nous recrutons actuellement des escorts pour des milliers de membre de notre base de donnee. Si tu es escort va sur ". home_url('/affiliation/'.strtolower($code))."\n\n";
                                    $string .= "Si tu veux être membre et tu a besoin d'escort va sur ".get_the_permalink(tr_options_field('options.page_inscription_membre'))."\n\n";

                                    $this->sendMessage($message['chatId'], $string);

                                    $string = "*Message à partager*\n\n";
                                    $string .= "Nous recrutons actuellement des escorts pour des milliers de membre de notre base de donnee. Rejoinds nous sur ". home_url('/affiliation/'.strtolower($code))."\n\n";

                                    $this->sendMessage($message['chatId'], $string);

                                    break;

                                }

                                case 'conseil':
                                case '*conseil*':{

                                    $conseiller = tr_options_field('options.conseiller');

                                    $string = "*Assistance charliescort.tk* \n";
                                    $string .= "Si vous avez besoin d'assistance avec un téléconseiller, Ecrivez à l'un de ces numéros par whatsapp.\n";
                                    foreach ($conseiller as $conseil):

                                        $string .= "- ".$conseil."\n";

                                    endforeach;

                                    $this->sendMessage($message['chatId'], $string);
                                    break;

                                }
                                default:{
                                    break;
                                }

                            }

                        endif;

                    else:

                        $string = "*Numero non éligible*\n\n";

                        $string .= "Nous sommes désolés, ce service n'est disponible que pour les pays suivant :\n";

                        foreach ($indication as $indic):
                            $string .= "  - ".$indic['pays']."\n";
                        endforeach;

                        $string .= "\nVous serez informé de l'activation de notre service dans votre pays très bientot.\n";
                        $string .= "*Merci de votre intérêt.*";

                        $this->sendMessage($message['chatId'], $string);

                    endif;



                }


            }

        }

    }

    public function choiceTypeUser($chatId){

        $string = "*Choix du type d'inscription*\n\n";
        $string .= "- Escort : membre de notre site web offrant des services de massage et rencontre adulte.\n";
        $string .= "- Membre : membre de notre site web cherchant des services de massage et rencontre adulte.\n";
        $string .= "\nEnvoyez *escort* ou *membre* pour indiquer votre choix.\n";

        $this->sendMessage($chatId, $string);
    }

    public function existParent($chatId, $exist = false){

        // Envoie du message du message d'enregistrement
        $string = "Votre code secret est valide.";

        if(!$exist):
            // Envoie du message d'erreur
            $string = "Ce code secret n'est pas valide.";
        endif;

        $this->sendMessage($chatId, $string);
    }


    public function check_participant($phone){

        $subscriber = (new Whatsapp())->where('numeroWhatsapp', '=', $phone)->first();

        if(!$subscriber):

            $numero = correctWhatsapp($phone);

            $create = new Whatsapp();
            $create->numero = $numero;
            $create->numeroWhatsapp = $phone;
            $create->save();

            $subscriber = (new Whatsapp())->where('numeroWhatsapp', '=', $phone)->first();

        endif;

        return $subscriber;

    }

    public function sendMessage($chatId, $text){
        $data = array('chatId'=>$chatId,'body'=>$text);
        $this->sendRequest('sendMessage',$data);
    }

    public function sendMessageByPhone($phone, $text){
        $data = array('phone'=>$phone,'body'=>$text);
        $this->sendRequest('sendMessage',$data);
    }

    public  function readMessage($chatId){
        $data = array('chatId'=>$chatId);
        $this->sendRequest('readChat', $data);
    }

    public function sendRequest($method,$data){

        $url = $this->APIurl.$method.'?token='.$this->token;

        if(is_array($data)){ $data = json_encode($data);}
        $options = stream_context_create(['http' => [
            'method'  => 'POST',
            'header'  =>'Content-type: application/json',
            'content' => $data]]);
        $response = file_get_contents($url,false,$options);
//        file_put_contents(get_template_directory().'/requests.log',$response.PHP_EOL,FILE_APPEND);

    }

    public function search($array, $key, $value)
    {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, $this->search($subarray, $key, $value));
            }
        }

        return $results;
    }


}
