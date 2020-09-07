<div class="row">
    <div class="col-8">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">
                        {{ __('user::views.name') }}
                        <span class="required"> * </span>
                    </label>
                    {!! Form::text('name', isset($user->name) ? $user->name : null, ['class' => 'form-control', 'placeholder' => __('user::views.name')]) !!}
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">
                        {{ __('user::views.email') }}
                        <span class="required"> * </span>
                    </label>
                    {!! Form::text('email', isset($user->email) ? $user->email : null, ['class' => 'form-control', 'placeholder' => __('user::views.email')]) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">
                        {{ __('user::views.password') }}
                        <span class="required"> * </span>
                    </label>
                    {!! Form::password('password', ['autocomplete' => 'false', 'class' => 'form-control', 'placeholder' => __('user::views.password')]) !!}
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">
                        {{ __('user::views.password_confirmation') }}
                        <span class="required"> *</span>
                    </label>
                    {!! Form::password('password_confirmation', ['autocomplete' => 'false', 'class' => 'form-control', 'placeholder' => __('user::views.password_confirmation')]) !!}
                </div>
            </div>
        </div>
        <div class="row">
            @if (config('cw_user.options'))
                @foreach (config('cw_user.options') as $option)
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">{{ __($option['label']) }}</label>
                            {!! form_option($option, $user?? NULL, $user->options?? NULL, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-4">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">
                        {{ __('user::views.roles') }}
                        <span class="required"> * </span>
                    </label>
                    {{ Form::select('sync[roles][]', $roles, isset($user) ? $user->roles()->pluck('id') : null, ['class' => 'form-control', 'multiple' => true]) }}
                </div>
            </div>
        </div>
    </div>
</div>