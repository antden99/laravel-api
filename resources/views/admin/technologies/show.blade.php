@extends('layouts.admin')



@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0"><strong>Technology Name:</strong> {{ $technology->name }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <div class="fw-bold">Technology Slug :</div>
                            <div class="text-muted">{{ $technology->slug }}</div>
                        </div>

                        @if ($technology->description)
                            <div class="mb-3">
                                <div class="fw-bold">Technology Description :</div>
                                <div class="text-muted">{{ $technology->description }}</div>
                            </div>
                        @else
                            <div class="mb-3">
                                <div class="fw-bold">Technology Description :</div>
                                <div class="text-muted">Description not present</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endsection
