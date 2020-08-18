@extends(config('cw_user.layout'))
@section('title', __('user::titles.users'))
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2 offset-10 mb-3 text-right">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                    Novo Usuário
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @include(config('cw_user.views') . 'users.partials.list')
            </div>
        </div>
    </div>
@endsection
