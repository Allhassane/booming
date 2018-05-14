<?php

namespace App\Http\Controllers;

use App\Annonce;
use App\AnnonceImage;
use App\AnnonceMedia;
use App\Category;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function UserAccount(){


        return view('user.profile');
    }

    public function UserAnnonce(Guard $auth){

        $id = Input::get('id');

        $categories = Category::OrderBy('libelle', 'asc')->get();

        $choices = Category::OrderBy('id', 'asc')->limit(6)->get();

        if (!empty($id)) {

            $data = Annonce::find($id);

            if (empty($data) OR $data->user_id != $auth->id()) {

                return redirect('/404');
            }

            $strongPoints[] = explode(',', $data->strong_point);

            $images = AnnonceImage::where('annonce_id', $data->id)->get();

            return view('template.user.annonces', compact('data', 'strongPoints', 'images', 'categories', 'choices', 'setting'));
        }else {

            return view('template.user.annonces', compact('categories', 'choices', 'setting'));
        }
    }

    public function UserAnnonceSave(Request $request, Guard $auth){

        $destination_path = public_path('assets/img/annonces');

        $extention = array(
            'jpg', 'JPG', 'png', 'PNG', 'JPEG', 'jpeg', 'GIF', 'gif'
        );

        $validator = Validator::make($request->all(), [
            'categorie_id' => 'required',
            'name' => 'required',
            'city' => 'required',
            'situation' => 'required',
            'mobile' => 'required',
            'content' => 'required',
            'vignette' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('danger', 'Veullez renseigner les champs importants');
        }else{

            $slug = Annonce::createSlug($request->input('name')).'-'.str_replace(':', '', date('H:i:s'));

            // si la categorie est une nouvel ou ancienne
            if ($request->input('categorie_id') == 4) {

                $data = Annonce::create([
                    'categorie_id' => $request->input('new_category_id'),
                    'name' => addslashes($request->input('name')),
                    'city' => addslashes($request->input('city')),
                    'situation' => addslashes($request->input('situation')),
                    'mobile' => $request->input('mobile'),
                    'fixe' => $request->input('fixe'),
                    'email' => $request->input('email'),
                    'strong_point' => addslashes($request->input('strong_point')),
                    'description' => addslashes($request->input('content')),
                    'user_id' => $auth->id(),
                    'slug' => $slug,
                    'vignette' => 'logo_annonce.gif'
                ]);

            }else{

                $data = Annonce::create([
                    'categorie_id' => $request->input('categorie_id'),
                    'name' => addslashes($request->input('name')),
                    'city' => addslashes($request->input('city')),
                    'situation' => addslashes($request->input('situation')),
                    'mobile' => $request->input('mobile'),
                    'fixe' => $request->input('fixe'),
                    'email' => $request->input('email'),
                    'strong_point' => addslashes($request->input('strong_point')),
                    'description' => addslashes($request->input('content')),
                    'user_id' => $auth->id(),
                    'slug' => $slug,
                    'vignette' => 'logo_annonce.gif'
                ]);

            }

            if (count($request->file('image')) > 0){

                foreach ($request->file('image') as $image){

                    if (in_array($image->getClientOriginalExtension(), $extention)) {

                        $imageName = rand(1000, 100000).'_booming.' . $image->getClientOriginalExtension();

                        $image->move($destination_path, $imageName);

                        AnnonceImage::create([
                            'picture' => $imageName,
                            'annonce_id' => $data->id
                        ]);
                    }

                }

            }

            if (!empty($request->file('vignette'))){

                if (in_array($request->file('vignette')->getClientOriginalExtension(), $extention)) {

                    $vignetteName = str_replace(':', '', date('H:i:s')).'_booming.' . $request->file('vignette')->getClientOriginalExtension();

                    $request->file('vignette')->move($destination_path, $vignetteName);

                    $value = Annonce::find($data->id);
                    $value->vignette = $vignetteName;
                    $value->save();
                }
            }else{
                $value = Annonce::find($data->id);
                $value->vignette = 'logo_annonce.gif';
                $value->save();
            }

            $user = User::find($auth->id());
            $user->role_id = 2;
            $user->save();

        }

        return redirect()->route('user.account.annonce.list')->with('success', 'Votre annonce est en cours de traitement, vous recevrais un email lorqu\'elle sera aprouvé');
    }

    public function UserAnnonceList(Guard $auth){

        $datas = Annonce::where('user_id', $auth->id())
            ->where('statut', 1)
            ->OrderBy('id', 'desc')
            ->get();

        $title = 'Mes Annonces';

        return view('template.user.list', compact('datas', 'title'));
    }

    public function UserAnnonceArchive(Guard $auth){

        $datas = Annonce::where('user_id', $auth->id())
            ->where('statut', 0)
            ->OrderBy('id', 'desc')
            ->get();

        $title = 'Mes annonces archivées';

        return view('template.user.list', compact('datas', 'title'));
    }

    public function UserSetting(Guard $auth){

        $user = User::find($auth->id());

        return view('template.user.setting', compact('user'));
    }

    public function UserSettingSave(Request $request, Guard $auth){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required'
        ]);

        if ($validator->fails()){
            return back()->withInput()->withErrors($validator)->with('danger', 'Veuillez renseigner les champs');
        }else{

            $user = User::find($auth->id());

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');

            $user->save();
        }

        return back()->with('success', 'Vous avez modifié votre profil avec succès');
    }

    public function UserAnnonceUpdate(Request $request, $id){

//        dd($request->all());

        $destination_path = public_path('assets/img/annonces');

        $extention = array(
            'jpg', 'JPG', 'png', 'PNG', 'JPEG', 'jpeg', 'GIF', 'gif'
        );

        $validator = Validator::make($request->all(), [
            'categorie_id' => 'required',
            'name' => 'required',
            'city' => 'required',
            'situation' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('danger', 'Veuillez renseigner les champs importants');
        }else{

            $data = Annonce::find($id);

            $slug = Annonce::createSlug($request->input('name')).'-'.str_replace(':', '', strtotime('H:i:s', $data->create_at));

            if ($request->input('categorie_id') == 4) {
                $data->categorie_id = $request->input('new_category_id');
            }else{
                $data->categorie_id = $request->input('categorie_id');
            }
            $data->name = addslashes($request->input('name'));
            $data->city = addslashes($request->input('city'));
            $data->situation = addslashes($request->input('situation'));
            $data->mobile = $request->input('mobile');
            $data->fixe = $request->input('fixe');
            $data->email = $request->input('email');
            $data->slug = $slug;

            if (!empty($request->input('strong_point'))){
                $data->strong_point = $data->strong_point .','. addslashes($request->input('strong_point'));
            }

            $data->description = $request->input('content');

            if ($request->file('vignette')) {

                if (in_array($request->file('vignette')->getClientOriginalExtension(), $extention)) {

                    $vignetteName = str_replace(':', '', date('H:i:s')) . '_booming.' . $request->file('vignette')->getClientOriginalExtension();

                    $request->file('vignette')->move($destination_path, $vignetteName);

                    $data->vignette = $vignetteName;
                }
            }

            $data->save();

            if (count($request->file('image')) > 0){

                foreach ($request->file('image') as $image){

                    if (in_array($image->getClientOriginalExtension(), $extention)) {

                        $imageName = rand(1000, 100000).'_booming.' . $image->getClientOriginalExtension();

                        $image->move($destination_path, $imageName);

                        AnnonceImage::create([
                            'picture' => $imageName,
                            'annonce_id' => $data->id
                        ]);
                    }

                }

            }

        }

        return redirect()->route('user.account.annonce.list')->with('success', 'Vous avez modifier une annonce avec succès');
    }

    public function UserAnnonceDisable(Request $request, $id, Guard $auth){

        $data = Annonce::find($id);

        if (empty($data) OR $data->user_id != $auth->id()){
            return redirect('/404');
        }else{

            $data->statut = 0;
            $data->save();

        }

        if ($request->ajax()){
            return response()->json(['success' => 'Vous avez désactivé une annonce avec succès']);
        }

        return back()->with('success', 'Vous avez désactivé une annonce avec succès');
    }

    public function UserAnnonceEnable(Request $request, $id, Guard $auth){

        $data = Annonce::find($id);

        if (empty($data) OR $data->user_id != $auth->id()){
            return redirect('/404');
        }else{

            $data->statut = 1;
            $data->save();

            if ($request->ajax()){
                return response()->json(['success' => 'Vous avez rétiré cette annonce de vos archives avec succès']);
            }

            return back()->with('success', 'Vous avez activé une annonce avec succès');
        }
    }

    public function UserAnnonceDelete(Request $request, $id, Guard $auth){

        $data = Annonce::find($id);

        if (empty($data) OR $data->user_id != $auth->id()){
            return redirect('/404');
        }else{

            $data->delete();

            if ($request->ajax()){
                return response()->json(['success' => 'Vous avez supprimé votre annonce avec succès']);
            }

            return back()->with('success', 'Vous avez supprimé une annonce avec succès');
        }
    }

    public function UserAnnonceStrongPointDelete(Guard $auth){

        $id = Input::get('annonce');
        $data = Annonce::find($id);
        $tag = Input::get('tag').',';
//        $tag = Input::get('tag');

        if ($data->user_id != $auth->id()){

            return response()->json(['danger' => 'Une erreure est survenue, veuillez réesayer']);
        }else{

            $newStrongPoint = str_replace($tag, '', $data->strong_point);

            $data->strong_point = $newStrongPoint;
            $data->save();

            return back();
        }
    }

    public function UserAnnonceImageDelete(Guard $auth){

        $id = Input::get('picture_id');
        $annonce = Input::get('annonce');

        $data = AnnonceImage::find($id);

        if ($data->annonce_id != $annonce){

            return response()->json(['danger' => 'Une erreure est survenue, veuillez réesayer']);
        }else{

            $data->delete();
            return back();
        }
    }

    public function UserAnnoncePricing($slug){

        $data = Annonce::where('slug', $slug)->first();

        $setting = Setting::first();

        return view('template.user.pricing', compact('data', 'setting'));
    }

    public function UserAnnoncePaymentMode($id, Guard $auth){

        $annonce = Annonce::find($id);

        if ($annonce->user->id != $auth->id()){
            return redirect('/404');
        }

        $setting = Setting::first();

        return view('template.user.mode', compact('annonce', 'setting'));
    }

    public function UserAnnoncePaymentModeVisa($id, Guard $auth){

        $annonce = Annonce::find($id);

        if ($annonce->user->id != $auth->id()){
            return redirect('/404');
        }

        $setting = Setting::first();

        return view('template.user.visa', compact('annonce', 'setting'));
    }
}
