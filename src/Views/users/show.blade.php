@extends(config('cw_user.layout'))
@section('title', __('user::views.users'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ $user->name }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <img src="{{ $user->avatar() }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                    <div class="card-body">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="card-link">Editar</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>

            </div>
            <div class="col-9">
                dd
            </div>
        </div>
    </div>
@endsection
