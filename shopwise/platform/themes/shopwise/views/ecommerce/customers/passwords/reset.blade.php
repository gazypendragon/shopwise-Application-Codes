@php Theme::set('pageName', __('Reset Password')) @endphp

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
