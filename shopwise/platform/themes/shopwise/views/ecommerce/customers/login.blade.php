@php Theme::set('pageName', __('Login')) @endphp

 <div class="login_register_wrap section">
     <div class="container">
         {!!
            $form
                ->modify('submit', 'submit', [
                        'attr' => [
                            'class' => 'btn btn-fill-out btn-block',
                        ],
                    ])
                ->modify('remember', 'html', ['html' => sprintf('<div class="chek-form col-6">
                     <div class="custome-checkbox">
                         <input class="form-check-input" type="checkbox" name="remember" id="remember-me" value="1">
                         <label class="form-check-label" for="remember-me"><span>%s</span></label>
                     </div>
                 </div>', __('Remember me'))], true)
                ->renderForm()
        !!}
     </div>
 </div>
