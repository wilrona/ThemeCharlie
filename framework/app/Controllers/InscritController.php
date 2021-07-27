<?php
namespace App\Controllers;

use App\Models\Inscrit;
use App\Models\Whatsapp;
use Spipu\Html2Pdf\Tag\Html\Ins;
use TypeRocket\Controllers\WPPostController;
use TypeRocket\Exceptions\ModelException;
use TypeRocket\Http\Request;
use TypeRocket\Http\Response;

class InscritController extends WPPostController
{
    protected $modelClass = Inscrit::class;

    public function connectOne(){

        $validation = [
            'pseudo' => 'required'
        ];

        $fields = $this->request->getFields();

        $validator = tr_validator($validation, $fields);

        $validator->errorMessages = [
            'regex' => false,
            'messages' => array(
                'pseudo:required' => 'Le pseudo ou le numéro whatsapp est obligatoire'
            )
        ];

        $validator->validate();

        if($validator->getErrors()):

            foreach ($validator->getErrors() as $error):
                flash('error-data-connexion', $error, 'uk-text-danger');
            endforeach;

            return tr_redirect()->toUrl(get_post_permalink(tr_options_field('options.page_connexion')))->withFields($fields);

        else:

            if(username_exists($fields['pseudo'])):

                $correct = $this->LoginSendPassword($fields['pseudo']);

                if($correct):

                    flash('infos-data-connexion', 'Message envoyé à votre numero whatsapp avec succès', 'uk-text-success');
                    return tr_redirect()->toHome('/connexion/two');

                else:

                    flash('error-data-connexion', 'Ce pseudo correspond à un compte membre. Vous n\'avez pas le droit de vous connecter.', 'uk-text-danger');
                    return tr_redirect()->back()->now();

                endif;

            endif;

            if($this->checkWhatsappNumber($fields['pseudo'])):

                $correct = $this->LoginSendPassword($fields['pseudo'], true);

                if($correct):

                    flash('infos-data-connexion', 'Message envoyé à votre numero whatsapp avec succès', 'uk-text-success');
                    return tr_redirect()->toHome('/connexion/two');

                else:

                    flash('error-data-connexion', 'Ce pseudo correspond à un compte membre. Vous n\'avez pas le droit de vous connecter.', 'uk-text-danger');
                    return tr_redirect()->back()->now();

                endif;

            endif;

            flash('error-data-connexion', 'Le pseudo ou le numero whatsapp n\'existe pas dans notre système', 'uk-text-danger');
            return tr_redirect()->toUrl(get_post_permalink(tr_options_field('options.page_connexion')))->withFields($fields);

        endif;
    }
    
    public function connexionTwo(){

        if ( is_user_logged_in() ) {
            return tr_redirect()->toHome();
        }

        if(!isset($_SESSION['login']) || empty($_SESSION['login'])){
            return tr_redirect()->toUrl(get_post_permalink(tr_options_field('options.page_connexion')));
        }

        return tr_view('connexion.two')->setTitle('Connexion en tant que escort');
    }
    
    public function connectTwo(){

        $validation = [
            'password' => 'required'
        ];

        $fields = $this->request->getFields();

        $validator = tr_validator($validation, $fields);

        $validator->errorMessages = [
            'regex' => false,
            'messages' => array(
                'password:required' => 'Le mot de passe n\'a pas été saisi'
            )
        ];

        $validator->validate();

        if($validator->getErrors()):

            foreach ($validator->getErrors() as $error):
                flash('error-data-connexion', $error, 'uk-text-danger');
            endforeach;

            return tr_redirect()->toHome('/connexion/two');
        else:

            $creds = array(
                'user_login' => isset($_SESSION['login']) ? $_SESSION['login'] : '',
                'user_password' => $fields['password']
            );

            $user_connect = wp_signon($creds);
            if(is_wp_error($user_connect)):

                flash('error-data-connexion', 'ce mot de passe ne correspond pas à l’identifiant', 'uk-text-danger');
                return tr_redirect()->toHome('/connexion/two');

            else:

                if(isset($_SESSION['login'])) unset($_SESSION['login']);
                return tr_redirect()->toUrl(get_the_permalink(tr_options_field('options.page_dashboard')));

            endif;


        endif;
    }

    public function inscrireOne(){

        $validation = [
            'pseudo' => 'required',
            'name' => 'required',
            'sexe' => 'required',
            'datenais' => 'required'
        ];

        $fields = $this->request->getFields();

        $validator = tr_validator($validation, $fields);

        $validator->errorMessages = [
            'regex' => false,
            'messages' => array(
                'pseudo:required' => 'Le pseudo est obligatoire',
                'name:required' => 'Le nom complet est obligatoire',
                'sexe:required' => 'Le choix du sexe est obligatoire',
                'datenais:required' => 'La date de naissance est obligatoire'
            )
        ];

        $validator->validate();

        if($validator->getErrors()):

            foreach ($validator->getErrors() as $error):
                flash('error-data-inscription', $error, 'uk-text-danger');
            endforeach;

            return tr_redirect()->toHome('/inscription/one')->withFields($fields);

        else:

            if(username_exists($fields['pseudo'])):

                flash('error-data-inscription', 'Le pseudo '.$fields['pseudo'].' est déjà utilisé par un autre utilisateur', 'uk-text-danger');
                return tr_redirect()->toHome('/inscription/one')->withFields($fields);

            else:

                $_SESSION['inscription']['one'] = $fields;
                return tr_redirect()->toHome('/inscription/two')->withFields($fields);

            endif;

        endif;

    }

    public function inscriptionOne(){

        if ( is_user_logged_in() ) {
            return tr_redirect()->toHome()->now();
        }

        return tr_view('inscription.one')->setTitle('Devenir escorte chez charlie');

    }

    public function inscrireTwo(){

        $validation = [
            'nationalite' => 'required',
            'ville' => 'required',
            'taille' => 'required',
            'poids' => 'required',
            'teint' => 'required',
            'type_corps' => 'required'
        ];

        $fields = $this->request->getFields();

        $validator = tr_validator($validation, $fields);

        $validator->errorMessages = [
            'regex' => false,
            'messages' => array(
                'nationalite:required' => 'Le choix de la nationalité est obligatoire',
                'ville:required' => 'Le choix de la ville est obligatoire',
                'taille:required' => 'La taille est obligatoire',
                'teint:required' => 'Le choix du teint est obligatoire',
                'type_corps:required' => 'Le choix du type de corps est obligatoire',
                'poids:required' => 'Le poids est obligatoire'
            )
        ];

        $validator->validate();

        if($validator->getErrors()):

            foreach ($validator->getErrors() as $error):
                flash('error-data-inscription', $error, 'uk-text-danger');
            endforeach;

            return tr_redirect()->toHome('/inscription/two')->withFields($fields);

        else:

            $_SESSION['inscription']['two'] = $fields;

            return tr_redirect()->toHome('/inscription/tree')->withFields($fields);

        endif;

    }

    public function inscriptionTwo(){

        if ( is_user_logged_in() ) {
            return tr_redirect()->toHome()->now();
        }

        if(!isset($_SESSION['inscription'])) return tr_redirect()->toHome()->now();

        return tr_view('inscription.two')->setTitle('Devenir escorte chez charlie');
    }

    public function inscrireTree(){

        $validation = [

            'disponibilite' => 'required',
            'service_offert' => 'required',
            'service_propose' => 'required'
        ];

        $fields = $this->request->getFields();

        $validator = tr_validator($validation, $fields);

        $validator->errorMessages = [
            'regex' => false,
            'messages' => array(
                'service_propose:required' => 'Choisissez au moin un service à proposer',
                'service_offert:required' => 'Le choix du genre est obligatoire',
                'disponibilite:required' => 'Le choix de la disponibilité est obligatoire'
            )
        ];

        $validator->validate();

        if($validator->getErrors()):

            foreach ($validator->getErrors() as $error):
                flash('error-data-inscription', $error, 'uk-text-danger');
            endforeach;

            return tr_redirect()->toHome('/inscription/tree')->withFields($fields);

        else:

            $options = tr_options_field('options.insc_horaire') ? tr_options_field('options.insc_horaire') : [];

            if(!$options):
                flash('error-data-inscription', 'Impossible de faire des enregistrements sans definir un taux horaire', 'uk-text-danger');
                return tr_redirect()->toHome('/inscription/tree')->withFields($fields);
            endif;

            $key = 1;
            $service_price = [];

            if(intval($fields[$key]['amount']) > 0 && $fields[$key]['actif'] && $fields[$key]['shot'] > 0):

                foreach ($options as $option):
                    if($option['name'] === $fields[$key]['name']):

                        if(intval($fields[$key]['amount']) > 0 && intval($fields[$key]['shot']) > 0):
                            $service_price[] = $fields[$key];
                        endif;

                        $key++;

                    endif;
                endforeach;

                $fields['service_price'] = $service_price;

            else:

                flash('error-data-inscription', 'Le montant ou le shot du taux horaire de '.$fields[$key]['name'].' doit être renseigné', 'uk-text-danger');
                return tr_redirect()->toHome('/inscription/tree')->withFields($fields);

            endif;

            if($fields['disponibilite'] === 'in' || $fields['disponibilite'] === 'both'):

                if(empty($fields['quartier_recevoir'])):

                    flash('error-data-inscription', 'Vous devez renseigner le lieu ou le quartier de reception pour vos clients', 'uk-text-danger');
                    return tr_redirect()->toHome('/inscription/tree')->withFields($fields);

                endif;

            endif;

            $_SESSION['inscription']['tree'] = $fields;

            return tr_redirect()->toHome('/inscription/four')->withFields($fields);

        endif;

    }

    public function inscriptionTree(){

        if ( is_user_logged_in() ) {
            return tr_redirect()->toHome()->now();
        }

        if(!isset($_SESSION['inscription'])) return tr_redirect()->toHome()->now();

        return tr_view('inscription.tree')->setTitle('Devenir escorte chez charlie');
    }

    public function inscrireFour(){

        $validation = [
            'phone' => 'required'
        ];

        $fields = $this->request->getFields();

        $validator = tr_validator($validation, $fields);

        $validator->errorMessages = [
            'regex' => false,
            'messages' => array(
                'phone:required' => 'Le numéro de téléphone est obligatoire'
            )
        ];

        $validator->validate();

        if($validator->getErrors()):

            foreach ($validator->getErrors() as $error):
                flash('error-data-inscription', $error, 'uk-text-danger');
            endforeach;

            return tr_redirect()->toHome('/inscription/four')->withFields($fields);

        else:

            if(!isset($_SESSION['inscription']['four']['codeparrainnee'])):


                $query_whatsapp = tr_query()->table('wp_whatsapp')->where('codeactivation', '=', $_SESSION['inscription']['four']['codeconfirmation'])->first();

                if(!$query_whatsapp):
                    flash('error-data-inscription', 'Nous ne trouvons aucune demande de synchronisation correspondant à ce numéro. Envoyez le code ci-dessous par whatsapp.', 'uk-text-danger');
                    return tr_redirect()->toHome('/inscription/four')->withFields($fields);
                endif;

            else:
                // A appliquer uniquement pour les personnes qui s'incrivent avec
                $query_whatsapp = tr_query()->table('wp_whatsapp')->where('codeParrain', '=', $_SESSION['inscription']['four']['codeparrainnee'])->first();

            endif;

            $data_inscrit = $_SESSION['inscription'];

            // Creation du compte de l'utilisateur et de son mot de passe

            $password = random_password($data_inscrit['one']['name']);
            $insert = array(
                'user_login' => $data_inscrit['one']['pseudo'],
                'display_name' => $data_inscrit['one']['name'],
                'first_name' => $data_inscrit['one']['name'],
                'user_pass' => $password,
                'user_registered' => date('Y-m-d H:i:s')
            );

            $user = wp_insert_user_customs($insert);

            // Envoie du mot de passe par whatsapp et du message de bienvenue

            $api_whatsapp = new WhatsappController(new Request(), new Response());

            $string = "*Bienvenue dans notre communauté d'escort*\n\n";
            $string .= "Votre inscription s'est réalisée avec succès. Connectez-vous pour completer vos informations et activer votre compte.\n\n";
            $string .= "*NB* : \n";
            $string .= "Votre compte ne sera que valide que si vous soumettez au moins deux photos qui remplissent les conditions suivante :\n\n";
            $string .= "- La photo doit être claire.\n";
            $string .= "- La photo ne doit pas afficher votre nudité.(minimum en mailloy de bain)\n";
            $string .= "- La photo ne doit pas être pornographique.\n";
            $string .= "- La photo ne doit pas avoir de text, ni de détail.\n";
            $string .= "\nToutes ces exigences sont faite pour vous faire paraitre plus sérieuse et professionnelle afin d'inciter de la sensualité auprès de nos membres.";
            $api_whatsapp->sendMessageByPhone($query_whatsapp['numeroWhatsapp'], $string);

            $string = "*Comment gerer votre disponibilité*\n\n";
            $string .= "Notre plateforme vous permet de vous rendre disponible en fonction de votre temps libre ou du début de vos activités.\n";
            $string .= "Être disponible sur notre plateforme implique que votre profil sera visible par nos membres qui sollicitent des escorts dans les heures qui suivent.\n\n";
            $string .= "Envoyez ainsi le mot : \n";
            $string .= "- *DISPO* : pour être disponible \n";
            $string .= "- *INDISPO* : pour ne plus être disponible \n";

            $string .= "\n*NB* : \n";
            $string .= "Pendant votre disponibilité, vous avez l'obligation d'accepter les demandes de reservation que vous recevez. Au bout de 03 reservations sans reponse, votre profil sera indisponible automatiquement\n\n";
            $string .= "Vous ne disposez que de 10 minutes pour repondre favorable à une demande de reservation.\n\n";

            $string .= "Si vous avez des questions, envoyez le mot *Conseil* pour vous mettre en relation avec un téleconseiller.";

            $api_whatsapp->sendMessageByPhone($query_whatsapp['numeroWhatsapp'], $string);

            $string = "*Invitez vos connaissances et faites vous un peu plus de revenu*\n\n";
            $string .= "Si vous disposez d’un réseau de personne susceptible de faire partir de notre communauté d’escort, Nous vous invitons à les parrainer afin que vous puissiez gagner 20% de gain sur chaque mise en relation qui sera effectuée.\n";
            $string .= "De ce fait, si vous êtes interessés tapez *affiliation* pour avoir votre code secret.\n\n";
            $string .= "Si vous avez des questions, envoyez le mot *Conseil* pour vous mettre en relation avec un téleconseiller.";

            $api_whatsapp->sendMessageByPhone($query_whatsapp['numeroWhatsapp'], $string);

            
            $inscrit = new Inscrit;

            $inscrit->post_type = 'inscrit';
            $inscrit->post_title = $data_inscrit['one']['name'];
            $inscrit->post_status = 'publish';
            $inscrit->post_author = $user;
            $inscrit->user_id = $user;

            $inscrit->datenais = $data_inscrit['one']['datenais'];
            $inscrit->sexe = $data_inscrit['one']['sexe'];
            $inscrit->type_user = 'e';

            $inscrit->nationalite = $data_inscrit['two']['nationalite'];
            $inscrit->ville = $data_inscrit['two']['ville'];
            $inscrit->taille = $data_inscrit['two']['taille'];
            $inscrit->teint = $data_inscrit['two']['teint'];
            $inscrit->type_corps = $data_inscrit['two']['type_corps'];
            $inscrit->poids = $data_inscrit['two']['poids'];

            $inscrit->service_propose = $data_inscrit['tree']['service_propose'];
            $inscrit->service_offert = $data_inscrit['tree']['service_offert'];
            $inscrit->disponibilite = $data_inscrit['tree']['disponibilite'];
            $inscrit->service_price = serialize($data_inscrit['tree']['service_price']);
            $inscrit->quartier_recevoir = $data_inscrit['tree']['quartier_recevoir'];

            $inscrit->phone = $fields['phone'];
            $inscrit->phonewhatsapp = $query_whatsapp['numero'];

            $inscrit->save();

            // rensegnement des informations de la table whatsapp

            $whatsapp = (new Whatsapp)->findById($query_whatsapp['id']);
            $whatsapp->codeactivation = $password;
            $whatsapp->codeParrain = generateParrainCode(6);
            $whatsapp->numeroContact = $fields['phone'];
            $whatsapp->typeUser = 'e';
            $whatsapp->iduser = $user;
            $whatsapp->idpostuser =  $inscrit->ID;

            if(isset($_SESSION['inscription']['four']['codeparrain'])):
                $parent = (new Whatsapp)->where('codeParrain', '=', $_SESSION['inscription']['four']['codeparrain'])->first();
                $whatsapp->idparent =  $parent->id;
            endif;

            $whatsapp->save();

            unset($_SESSION['inscription']);

            flash('success-data-inscription', 'Votre inscription a été enregistré avec succès. Veuillez vous connecter pour ajouter des photos et activer votre compte.', 'uk-text-success');
            return tr_redirect()->toHome('/inscription/success')->now();

        endif;

    }

    public function inscriptionFour(){

        if ( is_user_logged_in() ) {
            return tr_redirect()->toHome()->now();
        }

        if(!isset($_SESSION['inscription'])) return tr_redirect()->toHome()->now();

        $activa_prefix = tr_options_field('options.activa_prefix');

        if(!isset($_SESSION['inscription']['four'])):
            $_SESSION['inscription']['four']['codeconfirmation'] = strtoupper($activa_prefix).''.generateParrainCode(6);
        endif;

        if(isset($_GET['generate']) && isset($_SESSION['inscription']['four'])):
            $_SESSION['inscription']['four']['codeconfirmation'] = strtoupper($activa_prefix).''.generateParrainCode(6);
            return tr_redirect()->toHome('/inscription/four');
        endif;

        return tr_view('inscription.four')->setTitle('Devenir escorte chez charlie');
    }

    public function inscriptionSuccess(){
        return tr_view('inscription.succes')->setTitle('Devenir escorte chez charlie');
    }

    public function checkWhatsappNumber($number){
        $exist = (new Whatsapp())->where('numero', '=', $number);
        return $exist->first();
    }
    
    public function LoginSendPassword($pseudo, $number = false){

        $ligneWhatsapp = null;

        $_SESSION['login'] = $pseudo;

        if($number):
            $ligneWhatsapp = $this->checkWhatsappNumber($pseudo);

            $user = get_user_by('ID', $ligneWhatsapp->iduser);
            $_SESSION['login'] = $user->user_login;

        else:

            $user = get_user_by('login', $pseudo);

        endif;

        $args = array(
            'post_type' => 'inscrit'
        );

        $args['meta_query'] = array(
            array(
                'key' => 'user_id',
                'value' => $user->ID,
                'compare' => '='
            )
        );

        $post = query_posts($args);


        if(tr_posts_field('type_user', $post[0]->ID) === 'e'):

            // Modification du mot de passe
            $password = random_password($user->display_name);
            wp_set_password( $password, $user->ID);

            // Recherche du numero de telephone de l'user
            $phonewhatsapp = $pseudo;

            if(!$number):

                $phonewhatsapp = get_post_meta($post[0]->ID, 'phonewhatsapp', true);

            endif;

            // Envoie du mot de passe par whatsapp

            $api_whatsapp = new WhatsappController(new Request(), new Response());

            $string = "*Mot de passe de connexion*\n\n";
            $string .= "Connectez-vous avec ce mot de passe *".$password."*";

            $current_whatsapp = (new Whatsapp())->where('numero', '=', $phonewhatsapp)->first();
            $api_whatsapp->sendMessageByPhone($current_whatsapp->numeroWhatsapp, $string);

            // Enregistrement du nouveau mot de passe envoyé a l'utilisateur

            if(!$number):
                $ligneWhatsapp = (new Whatsapp())->where('iduser', '=', $user->ID)->first();
            endif;

            $update_data = array(
                'codeactivation' => $password
            );

            $update = (new Whatsapp())->findById($ligneWhatsapp->id);
            $update->update($update_data);

            return true;

        else:

            return false;

        endif;
        
    }

    public function updateOne(){

        $validation = [
            'pseudo' => 'required',
            'name' => 'required',
            'sexe' => 'required',
            'datenais' => 'required',
            'nationalite' => 'required',
            'ville' => 'required',
            'taille' => 'required',
            'poids' => 'required',
            'teint' => 'required',
            'type_corps' => 'required'
        ];

        $fields = $this->request->getFields();

        $validator = tr_validator($validation, $fields);

        $validator->errorMessages = [
            'regex' => false,
            'messages' => array(
                'pseudo:required' => 'Le pseudo est obligatoire',
                'name:required' => 'Le nom complet est obligatoire',
                'sexe:required' => 'Le choix du sexe est obligatoire',
                'datenais:required' => 'La date de naissance est obligatoire',
                'nationalite:required' => 'Le choix de la nationalité est obligatoire',
                'ville:required' => 'Le choix de la ville est obligatoire',
                'taille:required' => 'La taille est obligatoire',
                'teint:required' => 'Le choix du teint est obligatoire',
                'type_corps:required' => 'Le choix du type de corps est obligatoire',
                'poids:required' => 'Le poids est obligatoire'
            )
        ];

        $validator->validate();

        if($validator->getErrors()):

            foreach ($validator->getErrors() as $error):
                flash('error-data-update', $error, 'uk-text-danger');
            endforeach;

            return tr_redirect()->back()->withFields($fields)->now();

        else:

            $current_user = _wp_get_current_user();

            $insert = array(
                'ID' => $current_user->ID,
                'display_name' => $fields['name'],
                'first_name' => $fields['name'],
            );

            wp_update_user($insert);

            $postInfo = array(
                'ID' => $fields['post_id'],
                'post_content' => $fields['post_content']
            );
            wp_update_post($postInfo);

            $inscrit = $this->model->findById($fields['post_id']);
            $inscrit->update($fields);

            flash('success-data-update', 'Modification effectuée avec succès', 'uk-text-success');
            return tr_redirect()->back()->now();

        endif;
    }
    
    public function updateTwo(){

        $validation = [

            'disponibilite' => 'required',
            'service_offert' => 'required',
            'service_propose' => 'required'
        ];

        $fields = $this->request->getFields();

        if($fields['disponibilite'] === 'in' || $fields['disponibilite'] === 'both'):
            $validation['quartier_recevoir'] = 'required';
        endif;

        $validator = tr_validator($validation, $fields);

        $errorMessages = [
            'regex' => false,
            'messages' => array(
                'service_propose:required' => 'Choisissez au moin un service à proposer',
                'service_offert:required' => 'Le choix du genre est obligatoire',
                'disponibilite:required' => 'Le choix de la disponibilité est obligatoire'
            )
        ];

        if($fields['disponibilite'] === 'in' || $fields['disponibilite'] === 'both'):
            $errorMessages['messages']['quartier_recevoir:required'] = 'Vous devez renseigner le lieu ou le quartier de reception pour vos clients';
        endif;

        $validator->errorMessages = $errorMessages;

        $validator->validate();

        if($validator->getErrors()):

            foreach ($validator->getErrors() as $error):
                flash('error-data-update', $error, 'uk-text-danger');
            endforeach;

            return tr_redirect()->back()->withFields($fields)->now();

        else:

            $options = tr_options_field('options.insc_horaire') ? tr_options_field('options.insc_horaire') : [];

            if(!$options):
                flash('error-data-update', 'Impossible de faire des enregistrements sans definir un taux horaire', 'uk-text-danger');
                return tr_redirect()->back()->withFields($fields)->now();
            endif;

            $key = 1;
            $service_price = [];

            if(intval($fields[$key]['amount']) > 0 && $fields[$key]['actif'] && $fields[$key]['shot'] > 0):

                foreach ($options as $option):
                    if($option['name'] === $fields[$key]['name']):

                        if(intval($fields[$key]['amount']) > 0 && intval($fields[$key]['shot']) > 0):
                            $service_price[] = $fields[$key];
                        endif;

                        $key++;

                    endif;
                endforeach;

                $fields['service_price'] = $service_price;

            else:

                flash('error-data-update', 'Le montant ou le shot du taux horaire de '.$fields[$key]['name'].' doit être renseigné', 'uk-text-danger');
                return tr_redirect()->back()->withFields($fields)->now();

            endif;

            $inscrit = $this->model->findById($fields['post_id']);
            $inscrit->update($fields);

            flash('success-data-update', 'Modification effectuée avec succès', 'uk-text-success');
            return tr_redirect()->back()->now();

        endif;
    }

    public function updateTree(){

        $validation = [

            'photos' => 'required'
        ];

        $fields = $this->request->getFields();

        $validator = tr_validator($validation, $fields);

        $validator->errorMessages = [
            'regex' => false,
            'messages' => array(
                'photos:required' => 'Une photo est obligatoire'
            )
        ];

        $validator->validate();

        if($validator->getErrors()):

            foreach ($validator->getErrors() as $error):
                flash('error-data-update', $error, 'uk-text-danger');
            endforeach;

            return tr_redirect()->back()->withFields($fields)->now();

        else:



            $photo_valide = tr_posts_field('photos_valide', $fields['post_id']) ? tr_posts_field('photos_valide', $fields['post_id']) : [];

            if(!$photo_valide):

                $fields['active'] = false;

            else:

                $a_valider = false;
            
                foreach($fields['photos'] as $key => $valide):

                    if($valide['photo'] && !in_array($valide['photo'], (array)$photo_valide)):
                        $a_valider = true;
                    endif;

                    if(!$valide['photo']):
                        unset($fields['photos'][$key]);
                    endif;
                    
                endforeach;

                $fields['photos_a_valider'] = $a_valider;

            endif;

            $inscrit = (new Inscrit())->findById($fields['post_id']);
            $inscrit->update($fields);

            flash('success-data-update', 'Modification effectuée avec succès', 'uk-text-success');
            return tr_redirect()->back()->now();

        endif;


    }

    public function update($id = null)
    {
        $post = $this->model->findById( $id );
        $fields = $this->request->getFields();

        $photos = tr_posts_field('photos', $post->ID) ? tr_posts_field('photos', $post->ID) : [];

        if(isset($fields['valid_photo']) && $fields['valid_photo']):

            if($photos):
                
                foreach ($photos as $key => $photo):
                    $photos_valide = tr_posts_field('photos_valide', $post->ID) ? tr_posts_field('photos_valide', $post->ID) : [];
                    if(!search($fields['photos'], 'photo', $photo['photo'])
                        && !in_array($photo['photo'], $photos_valide)):

                        wp_delete_attachment($photo['photo']); // Supprimer les photos non autorisés lors de la validation
                        unset($photos[$key]);

                        // Envoyer un message a l'utilisateur de la suppression des dernieres photos qui ont ete soumis à validation

                    endif;
                endforeach;

            endif;

            $photos = $photos ? $photos : [];

            $photo_send = $fields['photos'] ? $fields['photos'] : [];

            $photo_merge = array_unique(array_merge($photo_send, $photos), SORT_REGULAR);

            $photoValid = tr_posts_field('photos_valide', $post->ID) ? tr_posts_field('photos_valide', $post->ID) : [];

            // Enregistrer les nouvelles photos validé dans le tableau des validations.
            if($photo_merge):
                foreach($photo_merge as $valide):
                    if($valide['photo'] && !in_array($valide['photo'], $photoValid)):
                        $photoValid[] = $valide['photo'];
                    endif;
                endforeach;

            else:
                $photo_merge = [];
            endif;

            $fields['photos_valide'] = $photoValid;
            $fields['photos'] = $photo_merge;
            $fields['photos_a_valider'] = '0';
            
        else:

            if(isset($fields['delete_photo']) && $fields['delete_photo']):

                $photoValid = tr_posts_field('photos_valide', $post->ID) ? tr_posts_field('photos_valide', $post->ID) : [];

                if($photos):

                    foreach ($photos as $key => $photo):

                        if(!search($fields['photos'], 'photo', $photo['photo'])):

                            unset($photos[$key]);

                            $key = array_keys($photoValid, $photo['photo']);
                            if($key >= 0):
                                unset($photoValid[$key]);
                            endif;

                        endif;

                    endforeach;

                endif;

                $photos = $photos ? $photos : [];

                $photo_send = $fields['photos'] ? $fields['photos'] : [];

                $photo_merge = array_unique(array_merge($photo_send, $photos), SORT_REGULAR);

                // Enregistrer les nouvelles photos validé dans le tableau des validations.
                if(!$photo_merge):
                    $photo_merge = [];
                endif;

                $fields['photos_valide'] = $photoValid;
                $fields['photos'] = $photo_merge;
                $fields['photos_a_valider'] = '0';

            else:

                $fields['photos'] = $photos;

            endif;

        endif;

        if(isset($fields['photos_valide']) && !$fields['photos'] && !$fields['photos_valide']):
            $fields['active'] = '0';
        endif;

        $post->update( $fields );
    }

    public function inscrireMembre(){

        $validation = [
            'pseudo' => 'required',
            'name' => 'required',
            'nationalite' => 'required',
            'datenais' => 'required'
        ];

        $fields = $this->request->getFields();

        $validator = tr_validator($validation, $fields);

        $validator->errorMessages = [
            'regex' => false,
            'messages' => array(
                'nationalite:required' => 'Le choix de la nationalité est obligatoire',
                'pseudo:required' => 'Le pseudo est obligatoire',
                'name:required' => 'Le nom complet est obligatoire',
                'datenais:required' => 'La date de naissance est obligatoire'
            )
        ];

        $validator->validate();

        if($validator->getErrors()):

            foreach ($validator->getErrors() as $error):
                flash('error-data-inscription-membre', $error, 'uk-text-danger');
            endforeach;

            return tr_redirect()->toHome('/inscription-membre/one')->withFields($fields);

        else:

            if(username_exists($fields['pseudo'])):

                flash('error-data-inscription-membre', 'Le pseudo '.$fields['pseudo'].' est déjà utilisé par un autre utilisateur', 'uk-text-danger');
                return tr_redirect()->toHome('/inscription-membre/one')->withFields($fields);

            else:

                $_SESSION['inscriptionMembre']['one'] = $fields;
                return tr_redirect()->toHome('/inscription-membre/two')->withFields($fields);

            endif;

        endif;

    }

    public function inscriptionMembreOne(){

        return tr_view('membre.one')->setTitle('Devenir membre chez charlie');
    }

    public function inscriptionMembre(){

        if(!isset($_SESSION['inscriptionMembre'])) return tr_redirect()->toHome()->now();

        $activa_prefix = tr_options_field('options.activa_prefix');

        if(!isset($_SESSION['inscriptionMembre']['two'])):
            $_SESSION['inscriptionMembre']['two']['codeconfirmation'] = strtoupper($activa_prefix).''.generateParrainCode(6);
        endif;

        if(isset($_GET['generate']) && isset($_SESSION['inscriptionMembre']['two'])):
            $_SESSION['inscriptionMembre']['two']['codeconfirmation'] = strtoupper($activa_prefix).''.generateParrainCode(6);
            return tr_redirect()->toHome('/inscription-membre/two');
        endif;

        return tr_view('membre.two')->setTitle('Devenir membre chez charlie');
    }

    public function inscrireMembreTwo(){

        $validation = [
            'phone' => 'required'
        ];

        $fields = $this->request->getFields();

        $validator = tr_validator($validation, $fields);

        $validator->errorMessages = [
            'regex' => false,
            'messages' => array(
                'phone:required' => 'Le numéro de téléphone est obligatoire'
            )
        ];

        $validator->validate();

        if($validator->getErrors()):

            foreach ($validator->getErrors() as $error):
                flash('error-data-inscription-membre', $error, 'uk-text-danger');
            endforeach;

            return tr_redirect()->toHome('/inscription-membre/two')->withFields($fields);

        else:

            if(!isset($_SESSION['inscriptionMembre']['two']['codeparrainnee'])):

                $query_whatsapp = tr_query()->table('wp_whatsapp')->where('codeactivation', '=', $_SESSION['inscriptionMembre']['two']['codeconfirmation'])->first();

                if(!$query_whatsapp):
                    flash('error-data-inscription-membre', 'Nous ne trouvons aucune demande de synchronisation correspondant à ce numéro. Envoyez le code ci-dessous par whatsapp.', 'uk-text-danger');
                    return tr_redirect()->toHome('/inscription-membre/two')->withFields($fields);
                endif;

            else:

                $query_whatsapp = tr_query()->table('wp_whatsapp')->where('codeParrain', '=', $_SESSION['inscriptionMembre']['two']['codeparrainnee'])->first();

            endif;

            $data_inscrit = $_SESSION['inscriptionMembre'];

            // Creation du compte de l'utilisateur et de son mot de passe

            $password = random_password($data_inscrit['one']['name']);
            $insert = array(
                'user_login' => $data_inscrit['one']['pseudo'],
                'display_name' => $data_inscrit['one']['name'],
                'first_name' => $data_inscrit['one']['name'],
                'user_pass' => $password,
                'user_registered' => date('Y-m-d H:i:s')
            );

            $user = wp_insert_user_customs($insert);

            // Envoie du mot de passe par whatsapp et du message de bienvenue
            $api_whatsapp = new WhatsappController(new Request(), new Response());

            $string = "*Bienvenue chez charlie et ses escorts*\n\n";
            $string .= "Votre inscription s'est réalisée avec succès. Rendez-vous au menu des reservations d'escort pour effectuer votre choix.\n\n";
            $api_whatsapp->sendMessageByPhone($query_whatsapp['numeroWhatsapp'], $string);

            $string = "*Invitez vos connaissances et faites vous un peu plus de revenu*\n\n";
            $string .= "Si vous disposez d’un réseau de personne susceptible de faire partir de notre communauté d’escort, Nous vous invitons à les parrainer afin que vous puissiez gagner 20% de gain sur chaque mise en relation qui sera effectuée.\n";
            $string .= "De ce fait, si vous êtes interessés tapez *affiliation* pour avoir votre code secret.\n\n";
            $string .= "Si vous avez des questions, envoyez le mot *Conseil* pour vous mettre en relation avec un téleconseiller.";

            $api_whatsapp->sendMessageByPhone($query_whatsapp['numeroWhatsapp'], $string);

            // Creation du custom post inscrit
            $inscrit = new Inscrit;

            $inscrit->post_title = $data_inscrit['one']['name'];
            $inscrit->post_type = 'inscrit';
            $inscrit->post_status = 'publish';
            $inscrit->post_author = $user;

            $inscrit->datenais = $data_inscrit['one']['datenais'];
            $inscrit->type_user = 'm';

            $inscrit->nationalite = $data_inscrit['one']['nationalite'];

            $inscrit->phone = $fields['phone'];
            $inscrit->phonewhatsapp = $query_whatsapp['numeroWhatsapp'];
            $inscrit->user_id = $user;

            $inscrit->save();

            // rensegnement des informations de la table whatsapp

            $whatsapp = (new Whatsapp())->findById($query_whatsapp['id']);
            $whatsapp->codeactivation = $password;
            $whatsapp->codeParrain = generateParrainCode(6);
            $whatsapp->numeroContact = $fields['phone'];
            $whatsapp->typeUser = 'm';
            $whatsapp->iduser = $user;
            $whatsapp->idpostuser =  $inscrit->ID;
            $whatsapp->save();

            unset($_SESSION['inscriptionMembre']);

            flash('success-data-inscription-membre', 'Votre inscription a été enregistre avec succès. Vous pouvez effectuer les reservations avec succès sur notre plateforme.', 'uk-text-success');
            return tr_redirect()->toHome('/inscription-membre/success')->now();

        endif;
    }

    public function inscrireMembreSuccess(){
        return tr_view('membre.succes')->setTitle('Devenir membre chez charlie');
    }

    public function redirectInscription($numero){

        $whatsapp = (new Whatsapp())->where('numero', '=', $numero)->first();

        $api_message = new WhatsappController(new Request(), new Response());

        if($whatsapp):
            if($whatsapp->iduser){

                $type = $whatsapp->typeUser === 'm' ? 'Membre' : 'Escort';

                $string = "*Ce numero est déja inscrit*\n\n";
                $string .= "Ce numero est deja inscrit en tant que ".$type." \n";

                if($whatsapp->typeUser === 'e'):
                    $string .= "Connectez-vous pour gerer vos informations et activez votre compte.\n";
                    $string .= "".get_the_permalink(tr_options_field('options.page_connexion'))."";
                else:
                    $string .= "Rendez-vous dans notre menu de reservation d'escort pour solliciter les escortes de votre choix.";
                endif;

                $api_message->sendMessageByPhone($whatsapp->numeroWhatsapp, $string);

            }else{

                if($whatsapp->typeUser == 'm'){
                    // redirection ver le lien d'inscription des membres
                    $_SESSION['inscriptionMembre']['two']['codeparrainnee'] = $whatsapp->codeParrain;
                    return tr_redirect()->toUrl(get_the_permalink(tr_options_field('options.page_inscription_membre')));
                }else{
                    // Redirection ver le lien d'inscription des escortes
                    $_SESSION['inscription']['four']['codeparrainnee'] = $whatsapp->codeParrain;;
                    return tr_redirect()->toUrl(get_the_permalink(tr_options_field('options.page_inscription')));
                }

            }

        endif;
    }

    public function redirectErrorInscription($type, $codeactivation){

        if($type === 'escort'):
            unset($_SESSION['inscription']['four']['codeparrainnee']);
            unset($_SESSION['inscription']['four']['codeparrain']);

            $_SESSION['inscription']['four']['codeconfirmation'] = explode('/', $codeactivation)[0] ;
            $_SESSION['inscription']['four']['existCode'] = true;

            return tr_redirect()->toUrl(get_the_permalink(tr_options_field('options.page_inscription')));
        endif;

        if($type === 'membre'):
            unset($_SESSION['inscriptionMembre']['two']['codeparrainnee']);
            unset($_SESSION['inscription']['four']['codeparrain']);

            $_SESSION['inscriptionMembre']['two']['codeconfirmation'] = explode('/', $codeactivation)[0];
            $_SESSION['inscriptionMembre']['two']['existCode'] = true;

            return tr_redirect()->toUrl(get_the_permalink(tr_options_field('options.page_inscription_membre')));
        endif;

        if($type !== 'membre' || $type !== 'escort'):
            return tr_redirect()->toHome('/')->now();
        endif;

    }

    public function affiliation($codeparrain){

        $parent = (new Whatsapp())->where('codeParrain', '=', $codeparrain)->first();

        if($parent):

            $_SESSION['inscription']['four']['codeparrain'] = $parent->codeParrain;
            return tr_redirect()->toUrl(get_the_permalink(tr_options_field('options.page_inscription_membre')));

        else:

            return tr_redirect()->toHome('/')->now();

        endif;

    }

}
