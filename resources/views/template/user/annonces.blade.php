@extends('template.layout.layout')

@section('title')
    @if(!empty($data))
        Modifier mon annonce [{{ stripslashes($data->name) }}] | booming
    @else
        Ajouter une nouvelle annonce | booming
    @endif
@endsection

@section('css')
    <link rel="stylesheet" href="/assets/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <style>
        #new-category-area{
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 15px;
            margin: 15px 0;
            display: none;
        }
        .new-category-form{
            display: none;
        }
    </style>
@endsection

@section('content')


    <!--inner heading start-->
    <div class="inner-heading">
        <div class="container">
            @if(!empty($data))
                <h1>Modifier mon annonce [{{ stripslashes($data->name) }}]</h1>
            @else
                <h1>Ajouter une nouvelle annonce</h1>
            @endif
        </div>
    </div>
    <!--inner heading end-->

    <!--ad post start-->
    <div class="inner-wrap listing">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('template.user.partials.user_information')
                </div>
                <div class="col-sm-9">
                    <div class="login">
                        <div class="contctxt">Veuillez renseigner tous les champs</div>
                        <div class="formint conForm">
                            @if(!empty($data))


                                {!! Form::open(['route' => ['user.account.annonce.update', $data->id], 'enctype' => 'multipart/form-data']) !!}

                                <div class="row input-wrap">
                                    <!-- Visa Card -->
                                    @foreach($choices as $choice)
                                        <div class="col-sm-2">
                                            <label class="">
                                                @if($data->categorie->id == $choice->id)
                                                    <input class="categorie_id" type="radio" value="{{ $choice->id }}" name="categorie_id" checked> {{ $choice->libelle }}
                                                @else
                                                    <input class="categorie_id" type="radio" value="{{ $choice->id }}" name="categorie_id"> {{ $choice->libelle }}
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                {{--<div class="row input-wrap">--}}
                                    {{--<!-- Visa Card -->--}}
                                    {{--<div class="col-sm-2">--}}
                                        {{--<label class="">--}}
                                            {{--@if($data->categorie_id == 1)--}}
                                                {{--<input class="categorie_id" type="radio" value="1" name="categorie_id" checked> {{ trans('word.categorie_one') }}--}}
                                            {{--@else--}}
                                                {{--<input class="categorie_id" type="radio" value="1" name="categorie_id"> {{ trans('word.categorie_one') }}--}}
                                            {{--@endif--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-2">--}}
                                        {{--<label class="">--}}
                                            {{--@if($data->categorie_id == 2)--}}
                                            {{--<input class="categorie_id" type="radio" value="2" name="categorie_id" checked> {{ trans('word.categorie_two') }}--}}
                                            {{--@else--}}
                                            {{--<input class="categorie_id" type="radio" value="2" name="categorie_id"> {{ trans('word.categorie_two') }}--}}
                                            {{--@endif--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-2">--}}
                                        {{--<label class="">--}}
                                            {{--@if($data->categorie_id == 3)--}}
                                            {{--<input class="categorie_id" type="radio" value="3" name="categorie_id" checked> {{ trans('word.categorie_three') }}--}}
                                            {{--@else--}}
                                            {{--<input class="categorie_id" type="radio" value="3" name="categorie_id"> {{ trans('word.categorie_three') }}--}}
                                            {{--@endif--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-2">--}}
                                        {{--<label class="">--}}
                                            {{--@if($data->categorie_id != 1 AND $data->categorie_id != 2 AND $data->categorie_id != 3)--}}
                                            {{--<input class="categorie_id" type="radio" value="4" name="categorie_id" checked> {{ trans('word.categorie_four') }}--}}
                                            {{--@else--}}
                                            {{--<input class="categorie_id" type="radio" value="4" name="categorie_id"> {{ trans('word.categorie_four') }}--}}
                                            {{--@endif--}}
                                        {{--</label>--}}
                                    {{--</div>--}}

                                {{--</div>--}}

                                @if($data->categorie_id != 1 AND $data->categorie_id != 2 AND $data->categorie_id != 3 AND $data->categorie_id != 4 AND $data->categorie_id != 5)
                                    <style>
                                        #new-category-area{
                                            display: block;
                                        }
                                    </style>
                                @endif

                                <div id="new-category-area">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="input-wrap">
                                                <select name="new_category_id" id="" class="form-control select-new-category">
                                                    <option value="">Sélectionnez une autre catégorie</option>
                                                    @php($exist = array(1,2,3,4,5))
                                                    @foreach($categories as $category)
                                                        @if(!in_array($category->id, $exist))
                                                            @if($data->categorie_id == $category->id)
                                                                <option value="{{ $category->id }}" selected>{{ $category->libelle }}</option>
                                                            @else
                                                                <option value="{{ $category->id }}">{{ $category->libelle }}</option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="input-wrap">
                                                <a href="" class="btn btn-success show-new-category-form">Nouvelle catégorie</a>
                                                <a href="" class="btn btn-danger hide-new-category-form">Fermer</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row new-category-form">
                                        <div class="col-sm-8">
                                            <div class="input-wrap">
                                                <label for="">Nom de votre catégorie</label>
                                                <input type="text" name="new_category" class="form-control libelle-new-category">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="input-wrap">
                                                <br>
                                                <a href="" class="btn btn-success submit-new-category">VALIDER</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="input-wrap">

                                            <label for="">{{ trans('word.annonce_name') }}</label>
                                            <input id="inputGroup1_3" class="form-control" name="name" value="{{ $data->name }}" type="text" placeholder="">
                                            @if ($errors->has('name'))
                                                <div class="field_required">
                                                    Le nom de l'établisement est obligatoire
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="input-wrap">
                                            <label for="city">Ville / Commune</label>
                                            <input id="inputGroup1_3" class="form-control" name="city" value="{{ $data->city }}" type="text" placeholder="ex: Abidjan">
                                            @if ($errors->has('city'))
                                                <div class="field_required">
                                                    La ville ou commune est obligatoire
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="input-wrap">
                                            <label for="">Situation géographique</label>
                                            <input id="inputGroup1_3" class="form-control" name="situation" value="{{ $data->situation }}" type="text" placeholder="ex: Marcory face Cap Sud">
                                            @if ($errors->has('situation'))
                                                <div class="field_required">
                                                    La situation géographique est obligatoire
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="input-wrap">
                                            <label for="">Numéro mobile</label>
                                            <input id="inputGroup1_3" class="form-control" name="mobile" type="text" value="{{ $data->mobile }}" placeholder="ex: +225 XX XX XX XX">

                                            @if ($errors->has('mobile'))
                                                <div class="field_required">
                                                    Le numéro de téléphone est obligatoire
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="input-wrap">
                                            <label for="">Fixe ou mobile n°2</label>
                                            <input id="" class="form-control" name="fixe" type="text" value="{{ $data->fixe }}" placeholder="ex: +225 XX XX XX XX">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="input-wrap">
                                            <label for="">Adresse E-mail</label>
                                            <input id="inputGroup1_3" class="form-control" name="email" type="email" value="{{ $data->email }}" placeholder="ex: exemple@exemple.com">
                                            @if ($errors->has('email'))
                                                <div class="field_required">
                                                    L'adresse E-mail est obligatoire
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="input-wrap">
                                            <label for="">Ajoutez les points forts de votre etablissement</label>

                                            <!-- cookies -->
                                            <div id="TutoStrongPoint" class="alert alert-info">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                Vous devez taper sur la touche entrer du clavier lorsque vous finissez de renseigner un point fort</p>
                                            </div>



                                            @if(count($strongPoints) > 0)

                                                <div class="widget">
                                                    <ul class="tags">
                                                        @for($i=0; $i<sizeof($strongPoints[0]); $i++)
                                                            <li><a class="DeleteStrongPoint" href="{{ route('user.account.annonce.strong.point.delete', ['annonce' => $data->id, 'tag' => $strongPoints[0][$i]]) }}">{{ $strongPoints[0][$i] }}</a></li>
                                                        @endfor
                                                    </ul>
                                                </div>

                                            @endif

                                            <input id="strongPoint" class="" name="strong_point" type="text" placeholder="ex: Connexion WI-FI">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="input-wrap">
                                            <label for="">Description détaillé de votre etablissement</label>
                                            <textarea id="" rows="10" class="form-control" name="content">{{ $data->description }}</textarea>
                                            @if ($errors->has('content'))
                                                <div class="field_required">
                                                    La description de l'établissement est obligatoire
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="input-wrap">
                                            <label for="">Ajouter une image (vignette)</label>

                                            <!-- cookies -->
                                            <div id="TutoImage" class="alert alert-info">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                Cette image sera celle que les utilisateurs verons avant les autres</p>
                                            </div>
                                            <!-- end cookie -->

                                            @if(isset($data->vignette))
                                                <div class="row">
                                                    <div class="col-sm-3 text-center" style="margin-bottom: 5px;">
                                                        <img src="/assets/img/annonces/{{ $data->vignette }}" style="width: 100%;" alt="">
                                                    </div>
                                                </div>
                                            @endif

                                            <input id="input-id" type="file" class="form-control file" name="vignette" data-preview-file-type="text">
                                            @if ($errors->has('vignette'))
                                                <div class="field_required">
                                                    Une image en vignette est obligatoire
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-sm-12" id="edit-image">
                                        <div class="input-wrap">
                                            <label for="">Ajouter des images de votre établisement</label>

                                            <!-- cookies -->
                                            <div id="TutoImage" class="alert alert-info" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <p>Pour un meilleur affichage de votre annonce veuillez utiliser des images de même taille</p>
                                            </div>
                                            <!-- cookies -->
                                            <div id="TutoImage" class="alert alert-warning" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <p>Veuillez supprimer une image avant de la remplacer</p>
                                            </div>
                                        </div>

                                        @if(count($images) > 0)
                                            @foreach($images as $image)
                                                <div class="col-sm-6 text-center">
                                                    <img src="/assets/img/annonces/{{ $image->picture }}" style="width: 90%; height: 150px;" alt="">
                                                    <a href="{{ route('user.account.annonce.image.delete', ['picture_id' => $image->id, 'annonce' => $data->id]) }}" class="DeleteImage btn u-btn-red btn-md text-danger"><i class="fa fa-trash-o"></i></a>
                                                    {{--<input id="input-id" type="file" class="form-control file" name="image[]" data-preview-file-type="text">--}}
                                                    <br><br>
                                                </div>
                                            @endforeach
                                        @endif

                                        @if(count($images) == 0)
                                            @for($i=0; $i<4; $i++)
                                                <div class="col-sm-6 text-center">
                                                    <input id="input-id" type="file" class="form-control file" name="image[]" data-preview-file-type="text">
                                                    <br><br>
                                                </div>
                                            @endfor
                                        @endif

                                        @if(count($images) == 1)
                                            @for($i=0; $i<3; $i++)
                                                <div class="col-sm-6 text-center">
                                                    <input id="input-id" type="file" class="form-control file" name="image[]" data-preview-file-type="text">
                                                    <br><br>
                                                </div>
                                            @endfor
                                        @endif

                                        @if(count($images) == 2)
                                            @for($i=0; $i<2; $i++)
                                                <div class="col-sm-6 text-center">
                                                    <input id="input-id" type="file" class="form-control file" name="image[]" data-preview-file-type="text">
                                                    <br><br>
                                                </div>
                                            @endfor
                                        @endif

                                        @if(count($images) == 3)
                                            @for($i=0; $i<1; $i++)
                                                <div class="col-sm-6 text-center">
                                                    <input id="input-id" type="file" class="form-control file" name="image[]" data-preview-file-type="text">
                                                    <br><br>
                                                </div>
                                            @endfor
                                        @endif

                                    </div>

                                </div>

                                <hr>

                                <div class="input-wrap text-right">
                                    <button type="reset" class="btn btn-danger">Réinitialiser</button>
                                    {!! Form::submit('Modifier', ['class' => 'btn btn-primary']) !!}
                                </div>

                                {{--<div class="sub-btn">--}}
                                {{--<input type="submit" class="sbutn" value="Submit Now">--}}
                                {{--</div>--}}
                                {!! Form::close() !!}

                            @else

                                {!! Form::open(['route' => 'user.account.annonce.save', 'enctype' => 'multipart/form-data']) !!}

                                {{--<div class="row input-wrap">--}}
                                    {{--<!-- Visa Card -->--}}
                                    {{--<div class="col-sm-3">--}}
                                        {{--<label class="">--}}
                                            {{--<input class="categorie_id" type="radio" value="1" name="categorie_id" checked> {{ trans('word.categorie_one') }}--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-3">--}}
                                        {{--<label class="">--}}
                                            {{--<input class="categorie_id" type="radio" value="2" name="categorie_id"> {{ trans('word.categorie_two') }}--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-3">--}}
                                        {{--<label class="">--}}
                                            {{--<input class="categorie_id" type="radio" value="3" name="categorie_id"> {{ trans('word.categorie_three') }}--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-3">--}}
                                        {{--<label class="">--}}
                                            {{--<input class="categorie_id" type="radio" value="4" name="categorie_id"> {{ trans('word.categorie_four') }}--}}
                                        {{--</label>--}}
                                    {{--</div>--}}

                                {{--</div>--}}

                                <div class="row input-wrap">
                                    <!-- Visa Card -->
                                    @foreach($choices as $choice)
                                        <div class="col-sm-2">
                                            <label class="">
                                                @if($choice->id == 1)
                                                    <input class="categorie_id" type="radio" value="{{ $choice->id }}" name="categorie_id" checked> {{ $choice->libelle }}
                                                @else
                                                    <input class="categorie_id" type="radio" value="{{ $choice->id }}" name="categorie_id"> {{ $choice->libelle }}
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                            <div id="new-category-area">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="input-wrap">
                                            <select name="new_category_id" id="" class="form-control select-new-category">
                                                <option value="">Selectionnez une autre catégorie</option>
                                                @php($exist = array(1,2,3,4,5))
                                                @foreach($categories as $category)
                                                    @if(!in_array($category->id, $exist))
                                                        <option value="{{ $category->id }}">{{ $category->libelle }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-wrap">
                                            <a href="" class="btn btn-success show-new-category-form">Nouvelle catégorie</a>
                                            <a href="" class="btn btn-danger hide-new-category-form">Fermer</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row new-category-form">
                                    <div class="col-sm-8">
                                        <div class="input-wrap">
                                            <label for="" class="obligatoire">Nom de votre catégorie</label>
                                            <input type="text" name="new_category" class="form-control libelle-new-category">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-wrap">
                                            <br>
                                            <a href="" class="btn btn-success submit-new-category">VALIDER</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="input-wrap">

                                            <label for="" class="obligatoire">{{ trans('word.annonce_name') }}</label>
                                            <input id="inputGroup1_3" class="form-control" name="name" type="text" placeholder="">
                                            @if ($errors->has('name'))
                                                <div class="field_required">
                                                    Le nom de l'établisement est obligatoire
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="input-wrap">
                                            <label for="city" class="obligatoire">Ville / Commune</label>
                                            <input id="inputGroup1_3" class="form-control" name="city" type="text" placeholder="ex: Abidjan">
                                            @if ($errors->has('city'))
                                                <div class="field_required">
                                                    La ville ou commune est obligatoire
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="input-wrap">
                                            <label for="" class="obligatoire">Situation géographique</label>
                                            <input id="inputGroup1_3" class="form-control" name="situation" type="text" placeholder="ex: Marcory face Cap Sud">
                                            @if ($errors->has('situation'))
                                                <div class="field_required">
                                                    La situation géographique est obligatoire
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-sm-4">
                                        <div class="input-wrap">
                                            <label for="" class="obligatoire">Numéro mobile</label>
                                            <input id="inputGroup1_3" class="form-control" name="mobile" type="text" placeholder="ex: +225 XX XX XX XX">

                                            @if ($errors->has('mobile'))
                                                <div class="field_required">
                                                    Le numéro de téléphone est obligatoire
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="input-wrap">
                                            <label for="">Fixe ou mobile n°2</label>
                                            <input id="" class="form-control" name="fixe" type="text" placeholder="ex: +225 XX XX XX XX">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="input-wrap">
                                            <label for="" class="obligatoire">Adresse E-mail</label>
                                            <input id="inputGroup1_3" class="form-control" name="email" type="email" placeholder="ex: exemple@exemple.com">
                                            @if ($errors->has('email'))
                                                <div class="field_required">
                                                    L'adresse E-mail est obligatoire
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="input-wrap">
                                            <label for="">Ajoutez les points forts de votre etablissement</label>

                                            <!-- cookies -->
                                            <div id="TutoStrongPoint" class="alert alert-info">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                Vous devez taper sur la touche entrer du clavier lorsque vous finissez de renseigner un point fort</p>
                                            </div>

                                            <input id="strongPoint" class="" name="strong_point" type="text" placeholder="ex: Connexion WI-FI">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="input-wrap">
                                            <label for="" class="obligatoire">Description détaillé de votre etablissement</label>
                                            <textarea id="" rows="10" class="form-control" name="content"></textarea>
                                            @if ($errors->has('content'))
                                                <div class="field_required">
                                                    La description de l'établissement est obligatoire
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="input-wrap">
                                            <label for="" class="obligatoire">Ajouter une image (vignette)</label>

                                            <!-- cookies -->
                                            <div id="TutoImage" class="alert alert-info">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                Cette image sera celle que les utilisateurs verons avant les autres</p>
                                            </div>
                                            <!-- end cookie -->

                                            <input id="input-id" type="file" class="form-control file" name="vignette" data-preview-file-type="text">
                                            @if ($errors->has('vignette'))
                                                <div class="field_required">
                                                    Une image en vignette est obligatoire
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- cookies -->
                                        <div id="TutoImage" class="alert alert-info" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            Pour un meilleur affichage de votre annonce veuillez utiliser des images de même taille</p>
                                        </div>
                                        <label for="" class="obligatoire">Ajouter des images de votre établisement</label>
                                        <br><br>
                                    </div>

                                    <div class="col-sm-6">

                                        <div class="input-wrap">
                                            <label for="">Image n°1</label>

                                            <input id="input-id" type="file" class="form-control file" name="image[]" data-preview-file-type="text">
                                        </div>

                                    </div>
                                    <div class="col-sm-6">

                                        <div class="input-wrap">
                                            <label for="">Image n°2</label>

                                            <input id="input-id" type="file" class="form-control file" name="image[]" data-preview-file-type="text">
                                        </div>

                                    </div>
                                    <div class="col-sm-6">

                                        <div class="input-wrap">
                                            <label for="">Image n°3</label>

                                            <input id="input-id" type="file" class="form-control file" name="image[]" data-preview-file-type="text">
                                        </div>

                                    </div>
                                    <div class="col-sm-6">

                                        <div class="input-wrap">
                                            <label for="">Image n°4</label>

                                            <input id="input-id" type="file" class="form-control file" name="image[]" data-preview-file-type="text">
                                        </div>

                                    </div>

                                    {{--<div class="col-sm-12">--}}
                                        {{--<div class="input-wrap">--}}
                                            {{--<label for="">Ajouter des images de votre établisement</label>--}}

                                            {{--<!-- cookies -->--}}
                                            {{--<div id="TutoImage" class="alert alert-info" role="alert">--}}
                                                {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
                                                    {{--<span aria-hidden="true">&times;</span>--}}
                                                {{--</button>--}}
                                                {{--Pour un meilleur affichage de votre annonce veuillez utiliser des images de même taille</p>--}}
                                            {{--</div>--}}

                                            {{--<input id="input-id" type="file" class="form-control file" name="image[]" data-preview-file-type="text" multiple>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                </div>

                                <hr>

                                <div class="input-wrap text-right">
                                    <button type="reset" class="btn btn-danger">Réinitialiser</button>
                                    {!! Form::submit('Publier mon établissement', ['class' => 'btn btn-primary']) !!}
                                </div>

                                    {{--<div class="sub-btn">--}}
                                        {{--<input type="submit" class="sbutn" value="Submit Now">--}}
                                    {{--</div>--}}
                                {!! Form::close() !!}


                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--ad post end-->


@endsection


@section('js')

    <script src="/assets/js/custom.js"></script>
    <script src="/template/js/selectize.min.js"></script>
    <script src="/template/js/plugin.js"></script>


    <!-- js upload plugin -->
    <!-- link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
    {{--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>--}}
    <!-- piexif.min.js is only needed for restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/piexif.min.js" type="text/javascript"></script>
    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
        This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/sortable.min.js" type="text/javascript"></script>
    <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for
        HTML files. This must be loaded before fileinput.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/purify.min.js" type="text/javascript"></script>
    <!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js
       3.3.x versions without popper.min.js. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
        dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions the main fileinput plugin file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>
    <!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/themes/fa/theme.js"></script>
    <!-- optionally if you need translation for your language then include  locale file as mentioned below -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/locales/fr.min.js"></script>


    <script>
        $('#strongPoint').selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input
                }
            }
        });

        CKEDITOR.replace( 'content' );

        $("#input-id").fileinput({'showUpload':false, 'previewFileType':'any'});

        $('.categorie_id').on('change', function(){

            if($(this).val() == 6) {
                $('#new-category-area').fadeIn(500)
            }else{
                $('#new-category-area').fadeOut(500)

            }
        });
        $('.show-new-category-form').on('click', function(e){
            e.preventDefault();

            $('.new-category-form').fadeIn(500)
        });

        $('.hide-new-category-form').on('click', function(e){
            e.preventDefault();

            $('.new-category-form').fadeOut(500)
        });

        $('.submit-new-category').on('click', function(e){
            e.preventDefault();

            if($('.libelle-new-category').val() == ''){
                $('.libelle-new-category').css('border-color', 'red');
            }else{
                var url='/add-new-user-category/'+$('.libelle-new-category').val();

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response){
                        if(response.success){
                            $('.new-category-form').html('<div class="col-sm-12"><div class="alert alert-success">Votre nouvelle catégorie a bien été enregistré, elle sera examiné et validé ou réjété</div></div>');

                            $('.select-new-category')
                                .append('<option value="'+ response.id +'" selected>' + response.libelle + '</option>');
                        }
                    }
                })
            }


        })
    </script>
@endsection


@section('js')
    <script>
        $(function(){
            $('body').removeClass('stop-scrolling');
        })
    </script>
@endsection