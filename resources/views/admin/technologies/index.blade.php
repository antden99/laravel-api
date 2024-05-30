@extends('layouts.admin')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">

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


                    <form action="{{ route('admin.technologies.store') }}" method="POST">
                        <!--Non ti dimenticare di aggiungere enctype se devi permettere il caricamento dell'immagine nel form-->
                        @csrf


                        <div class="mb-3">
                            <label for="name" class="form-label">Name Technology</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" aria-describedby="nameHelpId" placeholder="Add name technology"
                                value="{{ old('name') }}" />
                            <small id="nameHelpId" class="form-text text-muted">Type a name for this technology</small>
                            @error('name')
                                <div class="text-danger py-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4" aria-describedby="descriptionHelpId"
                                placeholder="Add technology description">{{ old('description') }}</textarea>
                            <small id="descriptionHelpId" class="form-text text-muted">Type a description for this
                                technology</small>
                            @error('description')
                                <div class="text-danger py-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create New Technologies</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TECHNOLOGY NAME</th>
                            <th>TECHNOLOGY-SLUG</th>
                            <th>NUMBER OF PROJECTS</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($techList as $tech)
                            <tr>
                                <form action="{{ route('admin.technologies.update', $tech) }}" method="post">
                                    @csrf
                                    @method('PATCH')

                                    <td>{{ $tech->id }}</td>
                                    <td><input type="text" value="{{ $tech->name }}" name="name"></td>
                                    <td>{{ $tech->slug }}</td>
                                </form>
                                <td>{{ $tech->projects()->count() }}</td>
                                <td>
                                    <a href="{{ route('admin.technologies.show', $tech) }}" class="btn btn-dark">
                                        <i class="fa-regular fa-eye"></i></a>
                                </td>
                                <td>
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                        data-bs-target="#modalId-{{ $tech->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modalId-{{ $tech->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId">
                                                        Be careful, you are eliminating the technology from your list!!
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">You are deleting the technology {{ $tech->name }}
                                                    permanently!</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Cancel <!--Annulla la modale-->
                                                    </button>
                                                    <form action="{{ route('admin.technologies.destroy', $tech) }}"
                                                        method="post">
                                                        @csrf <!--ricorda di aggiungere sempre il token univoco-->
                                                        @method('DELETE')
                                                        <!--aggiungi sempre method 'delete' per indicare che questo form post è di tipo delete-->
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
            </div>
        </div>
    </div>



@endsection
