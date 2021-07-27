<?php
/*
|--------------------------------------------------------------------------
| TypeRocket Routes
|--------------------------------------------------------------------------
|
| Manage your web routes here.
|
*/

tr_route()->post()->match('/webhook/notification')->do('botMessage@Whatsapp');

tr_route()->post()->match('/inscrire/one')->do('inscrireOne@Inscrit');
tr_route()->post()->match('/inscrire/two')->do('inscrireTwo@Inscrit');
tr_route()->post()->match('/inscrire/tree')->do('inscrireTree@Inscrit');
tr_route()->post()->match('/inscrire/four')->do('inscrireFour@Inscrit');


tr_route()->get()->match('/inscription/one')->do('inscriptionOne@Inscrit');
tr_route()->get()->match('/inscription/two')->do('inscriptionTwo@Inscrit');
tr_route()->get()->match('/inscription/tree')->do('inscriptionTree@Inscrit');
tr_route()->get()->match('/inscription/four')->do('inscriptionFour@Inscrit');
tr_route()->get()->match('/inscription/success')->do('inscriptionSuccess@Inscrit');


tr_route()->post()->match('/connect/one')->do('connectOne@Inscrit');
tr_route()->post()->match('/connect/two')->do('connectTwo@Inscrit');

tr_route()->get()->match('/connexion/two')->do('connexionTwo@Inscrit');


tr_route()->post()->match('/update/one')->do('updateOne@Inscrit');
tr_route()->post()->match('/update/two')->do('updateTwo@Inscrit');
tr_route()->post()->match('/update/tree')->do('updateTree@Inscrit');

//
tr_route()->post()->match('/membre/inscrire')->do('inscrireMembre@Inscrit');
tr_route()->post()->match('/membre/inscrire/two')->do('inscrireMembreTwo@Inscrit');


tr_route()->get()->match('/inscription-membre/one')->do('inscriptionMembreOne@Inscrit');
tr_route()->get()->match('/inscription-membre/two')->do('inscriptionMembre@Inscrit');
tr_route()->get()->match('/inscription-membre/success')->do('inscrireMembreSuccess@Inscrit');


tr_route()->get()->match('/start/(.+)', ['numero'])->do('redirectInscription@Inscrit');
tr_route()->get()->match('/affiliation/(.+)', ['codeparrain'])->do('affiliation@Inscrit');
tr_route()->get()->match('/register/(.+)/(.+)', ['type', 'codeactivation'])->do('redirectErrorInscription@Inscrit');

