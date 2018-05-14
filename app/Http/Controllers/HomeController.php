<?php

namespace App\Http\Controllers;

use App\Annonce;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Models\Page;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //annonce recommandé
        $firsts = Annonce::FirstPromoted()->limit(4)->get();


        $seconds = Annonce::SecondPromoted()->limit(4)->get();

        //annonce recentes
        $recents = Annonce::RecentAnnonce()->limit(8)->get();

//        dd($recommandes);

        $categories = Category::CategoryWithoutAutre()->limit(8)->get();

        foreach ($categories as $category){
            $category['number_annonce'] = count(Annonce::where('categorie_id', $category->id)->where('verified', 1)->get());
        }

        //annonces les plus vues
        $vues = Annonce::OrderBy('vues', 'desc')
            ->where('verified', 1)
            ->limit(8)->get();

        //annonce les mieux noté
        $notees = Annonce::OrderBy('note', 'desc')
            ->where('verified', 1)
            ->limit(8)->get();

        $number = Annonce::where('verified', 1)->get();

        return view('template.home.index', compact('firsts', 'seconds', 'vues', 'notees', 'categories', 'recents', 'number', 'setting'));
    }


    public function confirmCode(Request $request){
        $data = User::find($request->input('id'));
        if (empty($data)){
            return redirect('/404');
        }

        if ($data->token != $request->input('code')){
            return back()->with('danger', 'le code ne coorespond pas');
        }

        $data->token = NULL;
        $data->verified = 1;
        $data->save();

        auth()->login($data);

        return view('auth.verified', compact('data'));
    }

    public function indexSearch(Request $request){

        $search = $request->input('q');

        $annonces = Annonce::where('name', 'like', '%'.$search.'%')
            ->orWhere('situation', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->orWhere('strong_point', 'like', '%'.$search.'%')
            ->orWhere('city', 'like', '%'.$search.'%')
            ->paginate(10);

        foreach ($annonces as $annonce){
            $annonce['strong_point'] = explode(',', $annonce->strong_point);
        }

        $number = Annonce::where('name', 'like', '%'.$search.'%')
            ->orWhere('situation', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->orWhere('strong_point', 'like', '%'.$search.'%')
            ->orWhere('city', 'like', '%'.$search.'%')
            ->where('verified', 1)
            ->paginate(8);

        $categories = Category::where('statut', 1)->get();

        $name = 'annonces';

        return view ('template.pages.annonces.list', compact('annonces', 'number', 'categories', 'name'));
    }
//
    public function newCategory($libelle){

        $data = Category::create([
            'libelle' => trim($libelle),
            'statut' => 0
        ]);

        return response()->json(['success' => 'ok', 'id' => $data->id, 'libelle' => $libelle]);
    }
//
    public function contacts(){

        return view('template.home.contacts');
    }
//
    public function contactSend(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        if($validator->fails()){

            return back()->withErrors($validator)->withInput()->with('danger', 'Veuillez reseigner tous les champs');
        }else {

            $email_user = $request->input('email');
            $name_user = $request->input('name');
            $message_user = $request->input('message');

            Mail::send('email.contacts',
                array(
                    'email' => $email_user,
                    'name' => $name_user,
                    'user_message' => $message_user
                ), function ($message) use ($email_user, $name_user) {
                    $message->from($email_user, $name_user);
                    $message->to('no-reply@booming.africa', 'Booming')->subject('Prise de contact');
                }
            );

        }

        return back()->with('success', 'Votre message a été envoyé avec success');
    }

    public function page($slug){

        $data = Page::where('slug', $slug)->first();

        return view('template.home.page', compact('data'));
    }

}
