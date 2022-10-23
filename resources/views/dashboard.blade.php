@extends('layouts.app')

@section('content')
    <header class="container my-4">
        <div class="d-flex flex-wrap justify-content-between bg-light border border-2 shadow-sm p-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#createNote">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="createNote" tabindex="-1" aria-labelledby="createNoteLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createNoteLabel">Criar Anotação</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            @csrf
                            <div class="modal-body">
                                <label>Título:</label>
                                <input class="form-control" type="text" name="title">
                                <label>Conteúdo:</label>
                                <textarea class="form-control" name="content" cols="30" rows="10"></textarea>
                                <label>Cor:</label>
                                <input class="form-control" type="color" name="color">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-warning">Criar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
