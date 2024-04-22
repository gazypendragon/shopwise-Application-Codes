@php Theme::set('pageName', __('Sign up')) @endphp

<div class="login_register_wrap section">
    <div class="container">
        {!!
            $form
                ->modify('submit', 'submit', [
                        'attr' => [
                            'class' => 'btn btn-fill-out btn-block',
                        ],
                    ])
                ->renderForm()
        !!}
    </div>
</div>
