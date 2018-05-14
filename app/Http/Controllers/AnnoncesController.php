<?php

namespace App\Http\Controllers;

use App\Annonce;
use App\AnnonceImage;
use App\Category;
use App\Note;
use App\Reservation;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AnnoncesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function AnnonceHotel(){

        $annonces = Annonce::where('categorie_id', 1)
            ->where('verified', 1)
            ->paginate(10);

        foreach ($annonces as $annonce){
            $annonce['strong_point'] = explode(',', $annonce->strong_point);
        }

        $number = Annonce::where('categorie_id', 1)->where('verified', 1)->get();

        $categories = Category::where('statut', 1)->get();

        $name = 'Hôtels';

        return view ('template.pages.annonces.list', compact('annonces', 'number', 'categories', 'name'));
    }

    public function AnnonceResto(){

        $annonces = Annonce::where('categorie_id', 2)
            ->where('verified', 1)
            ->paginate(8);

        foreach ($annonces as $annonce){
            $annonce['strong_point'] = explode(',', $annonce->strong_point);
        }

        $number = Annonce::where('categorie_id', 2)->where('verified', 1)->get();

        $categories = Category::where('statut', 1)->get();

        $name = 'Restaurants';

        return view ('template.pages.annonces.list', compact('annonces', 'number', 'categories', 'name'));
    }

    public function AnnonceMaqui(){

        $annonces = Annonce::where('categorie_id', 3)
            ->where('verified', 1)
            ->paginate(8);

        foreach ($annonces as $annonce){
            $annonce['strong_point'] = explode(',', $annonce->strong_point);
        }

        $number = Annonce::where('categorie_id', 3)->where('verified', 1)->get();

        $categories = Category::where('statut', 1)->get();

        $name = 'Maquis';

        return view ('template.pages.annonces.list', compact('annonces', 'number', 'categories', 'name'));
    }

    public function AnnonceBar(){

        $annonces = Annonce::where('categorie_id', 4)
            ->where('verified', 1)
            ->paginate(8);

        foreach ($annonces as $annonce){
            $annonce['strong_point'] = explode(',', $annonce->strong_point);
        }

        $number = Annonce::where('categorie_id', 4)->where('verified', 1)->get();

        $categories = Category::where('statut', 1)->get();

        $name = 'Bars';

        return view ('template.pages.annonces.list', compact('annonces', 'number', 'categories', 'name'));
    }

    public function AnnonceService(){

        $annonces = Annonce::where('categorie_id', 5)
            ->where('verified', 1)
            ->paginate(8);

        foreach ($annonces as $annonce){
            $annonce['strong_point'] = explode(',', $annonce->strong_point);
        }

        $number = Annonce::where('categorie_id', 5)->where('verified', 1)->get();

        $categories = Category::where('statut', 1)->get();

        $name = 'Services';

        return view ('template.pages.annonces.list', compact('annonces', 'number', 'categories', 'name'));
    }

    public function AnnonceByCategory(){

        $key = Category::find(Input::get('key'));

        $annonces = Annonce::where('categorie_id', $key->id)
            ->where('verified', 1)
            ->paginate(8);

        foreach ($annonces as $annonce){
            $annonce['strong_point'] = explode(',', $annonce->strong_point);
        }

        $number = Annonce::where('categorie_id', $key->id)->where('verified', 1)->get();

        $categories = Category::where('statut', 1)->get();

        $name = $key->libelle;

        return view ('template.pages.annonces.list', compact('annonces', 'number', 'categories', 'name'));
    }

    public function AnnonceAutre(){

        $annonces = Annonce::where('categorie_id', '<>', 1)
            ->where('categorie_id', '<>', 2)
            ->where('categorie_id', '<>', 3)
            ->where('categorie_id', '<>', 4)
            ->where('categorie_id', '<>', 5)
            ->where('verified', 1)
            ->paginate(8);

        foreach ($annonces as $annonce){
            $annonce['strong_point'] = explode(',', $annonce->strong_point);
        }

        $number = Annonce::where('categorie_id', '<>', 1)
            ->where('categorie_id', '<>', 2)
            ->where('categorie_id', '<>', 3)
            ->where('categorie_id', '<>', 4)
            ->where('categorie_id', '<>', 5)
            ->where('verified', 1)
            ->get();

        $categories = Category::where('statut', 1)->get();

        $name = 'Autres';

        return view ('template.pages.annonces.list', compact( 'annonces', 'number', 'categories', 'name'));
    }

    public function AnnonceSearch(Request $request){

        $annonces = Annonce::where('name', 'like', '%'.$request->input('name').'%')
            ->where('categorie_id', $request->input('categorie_id'))
            ->where('city', 'like', '%'.$request->input('city').'%')
            ->where('verified', 1)
            ->paginate(8);

        foreach ($annonces as $annonce){
            $annonce['strong_point'] = explode(',', $annonce->strong_point);
        }

//        $number = Annonce::where('categorie_id', 1)->where('verified', 1)->get();

        $categories = Category::where('statut', 1)->get();

        $name = 'annonces';

        return view ('template.pages.annonces.list', compact('annonces', 'number', 'categories', 'name'));

    }

    public function showAnnonce($slug){

        $data = Annonce::where('slug', $slug)->first();

        if (empty($data)){
            return redirect('/404');
        }

        $data->vues = $data->vues + 1;
        $data->save();

        $pictures = AnnonceImage::where('annonce_id', $data->id)->get();

        //note
        $notes = Note::where('annonce_id', $data->id)->get();

        if (!count($notes) > 0){
            $data['note'] = 0;
        }else{
            $noteSomme = 0;
            foreach ($notes as $value) {
                $noteSomme = $noteSomme + $value->note;
            }

            $data['note'] = ceil($noteSomme / count($notes));

            $data->note = $data['note'];
            $data->save();
        }

        $data['service'] = explode(',', $data->strong_point);

        return view('template.pages.annonces.show', compact('data', 'pictures', 'comments'));
    }

    public function NoteSave(Request $request, $id){

        Note::create([
            'note' => $request->input('note'),
            'remarque' => $request->input('remarque'),
            'annonce_id' => $id
        ]);

        return response()->json(['success' => 'ok']);
    }

    public function ReservationSave(Request $request, $id, Guard $auth){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        if ($validator->fails()){

            if ($request->ajax()) {
                return response()->json(['error' => 'Veuillez renseigner tous les champs']);
            }else{
                return back()->withErrors($validator)->withInput()->with('danger', 'Veuillez renseigner tous les champs');
            }
        }else{

            Reservation::create([
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'email' => $request->input('email'),
                'message' => $request->input('message'),
                'annonce_id' => $id
            ]);

            $annonce = Annonce::find($id);

            $annonce_mail_one = $annonce->email;
            $annonce_mail_two = $annonce->user->email;
            $name = $request->input('name');
            $mobile = $request->input('mobile');
            $email = $request->input('email');
            $user_message = $request->input('message');

            Mail::send('email.reservation',
                array(
                    'name' => $name,
                    'mobile' => $mobile,
                    'email' => $email,
                    'user_message' => $user_message
                ), function ($message) use ($email, $name, $annonce_mail_one, $annonce_mail_two) {
                    $message->from($email, $name);
                    $message->to($annonce_mail_one, 'Booming.ci')->subject('Message de '.$name);
                    $message->to($annonce_mail_two, 'Booming.ci')->subject('Message de '.$name);
                }
            );
        }

        if ($request->ajax()) {
            return response()->json(['success' => 'Votre message a été envoyé à l\'annonceur, il vous recontactera pour confirmation']);
        }else{
            return back()->with('success', 'Votre message a été envoyé à l\'annonceur, il vous recontactera pour confirmation');
        }
    }

    public function CategorieAnnonce(){

        $datas = Category::where('libelle', '<>', 'Autres')->where('statut', 1)->get();

        foreach ($datas as $data) {
            $data['number_annonce'] = count(Annonce::where('categorie_id', $data->id)->where('verified', 1)->get());
        }


        return view('template.pages.annonces.categorie', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {
        //
        // $annonce = Annonce::where('id', $annonce->id )->first();

        $annonce = Annonce::find($annonce->id);

        $annonce->vues++;
        $annonce->save();

        return view('pages.description', ["annonce" => $annonce ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        //
    }
}
