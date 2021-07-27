<?php
namespace App\Controllers;

use App\Models\Reservation;
use TypeRocket\Controllers\WPPostController;
use TypeRocket\Http\Request;
use TypeRocket\Http\Response;

class ReservationController extends WPPostController
{
    protected $modelClass = Reservation::class;

    public function update($id = null)
    {

        $post = $this->model->findById( $id );
        $fields = $this->request->getFields();

        $post->post_title = $fields['post_title_old'];
        $post->save();

    }


    public function random($car) {
        $string = "";
        $chaine = "1234567890";
        srand((double)microtime()*1000000);
        for($i=0; $i<$car; $i++) {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }
}
