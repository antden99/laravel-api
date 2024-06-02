<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {

        $projectList = Project::with('type','technologies')->paginate(6);  //per trasmettere, in modo automatico anche le relazioni a cui è collegato il modello Project, possiamo utilizzare with, mentre con paginate, aiutiamo il server, perchè mandiamo 6 istanze alla volta, per ogni pagina, per vedere le pagine che ci interessano, alla query dobbiamo aggiungere ?page=numero interessato
        return response()->json([
            "success" => true, //qui nella chiave success, mettiamo true, perchè così, dall'altra parte quando faremo la chiamata a questo endpoint, potremmo verificare il valore di success per sapere se è tutto ok
            "projects" => $projectList,
        ]);
    }
}
