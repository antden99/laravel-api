@extends('layouts.admin')


@section('content')
    <div class="container p-4">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            <!--Non ti dimenticare di aggiungere enctype se devi permettere il caricamento dell'immagine nel form-->
            @csrf


            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelpId" placeholder="Add name project" value="{{ old('name') }}" />
                <small id="nameHelpId" class="form-text text-muted">Type a name for this project</small>
                @error('name')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover_image</label>
                <input type="file" name="cover_image" id="cover_imageHelpId">
                <small id="cover_imageHelpId" class="form-text text-muted">Type a cover_image for this project</small>
                @error('cover_image')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="4" aria-describedby="descriptionHelpId"
                    placeholder="Add project description">{{ old('description') }}</textarea>
                <small id="descriptionHelpId" class="form-text text-muted">Type a description for this project</small>
                @error('description')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select form-select-lg" name="type_id" id="type_id">
                    <option selected disabled>Select a type</option>
                    <!--ricorda di aggiungere disabled perchè altrimenti i type potranno avere un valore non consentito e cradrai in errore!!-->
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                        <!--Ricordati, che per recuperare il vecchio valore inserito in caso di errore nell'invio del form
                            devi utilizzare 'selected', che in Bootstrap viene utilizzato per selezionare un valore di defoult. Inoltre ricorda di fare il confronto con == e non con === perchè il campo $type->id è numerico e non una stringa-->
                    @endforeach
                </select>
            </div>

            <div class="d-flex gap-3">
                @foreach ($techList as $tech)
                    <div class="form-check text-center ">

                        <!--Stai attento a techList[] deve essere un array, perchè deve contenere più di un possibile valore selezionato dall'utente-->
                        <input name="technologiesList[]" class="form-check-input " type="checkbox" value="{{ $tech->id }}" 
                            id="tech-{{ $tech->id }}" {{ in_array($tech->id, old('technologiesList', [])) ? 'checked' : '' }} /> <!--controlla se tech->id è presente nell'array, in caso di errore fai check della cella, in modo tale da recuperare gli ultimi valori inseriti, vuole come secondo argomento un [] vuoto, perchè al caricamento della pagina, technologiesList, ancora non c'è-->
                        <label class="form-check-label" for="tech-{{ $tech->id }}">{{ $tech->name }} </label>

                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                    id="start_date" aria-describedby="startDateHelpId" value="{{ old('start_date') }}" />
                <small id="startDateHelpId" class="form-text text-muted">Select the start date for this project</small>
                @error('start_date')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                    id="end_date" aria-describedby="endDateHelpId" value="{{ old('end_date') }}" />
                <small id="endDateHelpId" class="form-text text-muted">Select the end date for this project</small>
                @error('end_date')
                    <div class="text-danger py-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>



            <button type="submit" class="btn btn-primary">Create Project</button>
        </form>
    </div>
@endsection
