(function ($) {
    'use strict';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.botbleCookieNewsletter = (() => {

        const COOKIE_VALUE = 1;
        const COOKIE_NAME = 'botble_cookie_newsletter';
        const COOKIE_DOMAIN = $('div[data-session-domain]').data('session-domain');
        const COOKIE_MODAL = $('#newsletter-modal');
        const COOKIE_MODAL_TIME = COOKIE_MODAL.data('time');

        function newsletterWithCookies(expirationInDays) {
            setCookie(COOKIE_NAME, COOKIE_VALUE, expirationInDays);
        }

        function cookieExists(name) {
            return document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1;
        }

        function hideCookieDialog() {
            COOKIE_MODAL.modal('hide', {}, 500);
        }

        function setCookie(name, value, expirationInDays) {
            const date = new Date();
            date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
            document.cookie = name + '=' + value
                + ';expires=' + date.toUTCString()
                + ';domain=' + COOKIE_DOMAIN
                + ';path=/';
        }

        if (!cookieExists(COOKIE_NAME)) {
            setTimeout(() => {
                COOKIE_MODAL.modal('show', {}, 500);
            }, COOKIE_MODAL_TIME);
        }

        COOKIE_MODAL.on('hidden.bs.modal', () => {
            if (!cookieExists(COOKIE_NAME) && $('#dont_show_again').is(':checked')) {
                newsletterWithCookies(3);
            } else {
                newsletterWithCookies(1/24);
            }
        });

        return {
            newsletterWithCookies: newsletterWithCookies,
            hideCookieDialog: hideCookieDialog
        };
    })();

    let showError = message => {
        window.showAlert('alert-danger', message);
    }

    let showSuccess = message => {
        window.showAlert('alert-success', message);
    }

    let handleError = data => {
        if (typeof (data.errors) !== 'undefined' && data.errors.length) {
            handleValidationError(data.errors);
        } else if (typeof (data.responseJSON) !== 'undefined') {
            if (typeof (data.responseJSON.errors) !== 'undefined') {
                if (data.status === 422) {
                    handleValidationError(data.responseJSON.errors);
                }
            } else if (typeof (data.responseJSON.message) !== 'undefined') {
                showError(data.responseJSON.message);
            } else {
                $.each(data.responseJSON, (index, el) => {
                    $.each(el, (key, item) => {
                        showError(item);
                    });
                });
            }
        } else {
            showError(data.statusText);
        }
    }

    let handleValidationError = errors => {
        let message = '';
        $.each(errors, (index, item) => {
            if (message !== '') {
                message += '<br />';
            }
            message += item;
        });
        showError(message);
    }

    window.showAlert = (messageType, message) => {
        if (messageType && message !== '') {
            if (messageType === 'alert-success') {
                Theme.showSuccess(message);
            } else {
                Theme.showError(message);
            }
        }
    }

    $(document).ready(function () {

        if (jQuery().mCustomScrollbar) {
            $('.ps-custom-scrollbar').mCustomScrollbar({
                theme: 'dark',
                scrollInertia: 0
            });
        }

        $(document).on('click', '.newsletter-form button[type=submit]', function (event) {
            event.preventDefault();
            event.stopPropagation();

            let _self = $(this);

            _self.addClass('button-loading');
            $('.newsletter-success-message').html('').hide();
            $('.newsletter-error-message').html('').hide();

            $.ajax({
                type: 'POST',
                cache: false,
                url: _self.closest('form').prop('action'),
                data: new FormData(_self.closest('form')[0]),
                contentType: false,
                processData: false,
                success: res => {
                    _self.removeClass('button-loading');

                    if (typeof refreshRecaptcha !== 'undefined') {
                        refreshRecaptcha();
                    }

                    if (!res.error) {
                        window.botbleCookieNewsletter.newsletterWithCookies(30);
                        _self.closest('form').find('input[type=email]').val('');
                        showSuccess(res.message);
                        setTimeout(() => {
                            _self.closest('.modal-body').find('button[data-dismiss="modal"]').trigger('click');
                        }, 2000);
                    } else {
                        showError(res.message);
                    }
                },
                error: res => {
                    if (typeof refreshRecaptcha !== 'undefined') {
                        refreshRecaptcha();
                    }
                    _self.removeClass('button-loading');
                    Theme.handleError(res);
                }
            });
        });
    });

    $(document).ready(function () {
        $(document).on('change', '.switch-currency', function () {
            $(this).closest('form').submit();
        });

        $(document).on('change', '.section .sidebar .widget .product-filter-item', function () {
            $(this).closest('form').submit();
        });

        $(document).on('click', '.js-add-to-wishlist-button', function (event) {
            event.preventDefault();
            let _self = $(this);

            _self.addClass('button-loading');

            $.ajax({
                url: _self.data('url'),
                method: 'POST',
                success: res => {

                    if (res.error) {
                        _self.removeClass('button-loading');
                        showError(res.message);
                        return false;
                    }

                    showSuccess(res.message);

                    $('.btn-wishlist span').text(res.data.count);

                    _self.removeClass('button-loading').removeClass('js-add-to-wishlist-button').addClass('js-remove-from-wishlist-button active');
                },
                error: () => {
                    _self.removeClass('button-loading');
                }
            });
        });


        $(document).on('click', '.js-remove-from-wishlist-button', function (event) {
            event.preventDefault();
            let _self = $(this);

            _self.addClass('button-loading');

            $.ajax({
                url: _self.data('url'),
                method: 'DELETE',
                success: res => {

                    if (res.error) {
                        _self.removeClass('button-loading');
                        showError(res.message);
                        return false;
                    }

                    showSuccess(res.message);

                    $('.btn-wishlist span').text(res.data.count);

                    _self.closest('tr').remove();
                    _self.removeClass('button-loading').removeClass('js-remove-from-wishlist-button active').addClass('js-add-to-wishlist-button');
                },
                error: () => {
                    _self.removeClass('button-loading');
                }
            });
        });

        $(document).on('click', '.add-to-cart-button', function (event) {
            event.preventDefault();
            let _self = $(this);

            _self.prop('disabled', true).addClass('button-loading');

            $.ajax({
                url: _self.data('url'),
                method: 'POST',
                data: {
                    id: _self.data('id')
                },
                dataType: 'json',
                success: res => {
                    _self.prop('disabled', false).removeClass('button-loading').addClass('active');

                    if (res.error) {
                        showError(res.message);

                        if (res.data.next_url !== undefined) {
                            window.location.href = res.data.next_url;
                        }

                        return false;
                    }

                    showSuccess(res.message);

                    if (res.data.next_url !== undefined) {
                        window.location.href = res.data.next_url;
                    } else {
                        $.ajax({
                            url: window.siteUrl + '/ajax/cart',
                            method: 'GET',
                            success: response => {
                                if (!response.error) {
                                    $('.cart_box').html(response.data.html);
                                    $('.btn-shopping-cart span').text(response.data.count);
                                }
                            }
                        });
                    }
                },
                error: () => {
                    _self.prop('disabled', false).removeClass('button-loading');
                }
            });
        });

        $(document).on('click', '.remove-cart-button', function (event) {
            event.preventDefault();

            $('.confirm-remove-item-cart').data('url', $(this).prop('href'));
            $('#remove-item-modal').modal('show');
        });


        $(document).on('click', '.confirm-remove-item-cart', function (event) {
            event.preventDefault();
            let _self = $(this);

            _self.prop('disabled', true).addClass('button-loading');

            $.ajax({
                url: _self.data('url'),
                method: 'GET',
                success: res => {
                    _self.prop('disabled', false).removeClass('button-loading');

                    if (res.error) {
                        return false;
                    }

                    _self.closest('.modal').modal('hide');

                    if ($('.form--shopping-cart').length) {
                        $('.form--shopping-cart').load(window.location.href + ' .form--shopping-cart > *');
                    }

                    $.ajax({
                        url: window.siteUrl + '/ajax/cart',
                        method: 'GET',
                        success: response => {
                            if (!response.error) {
                                $('.cart_box').html(response.data.html);
                                $('.btn-shopping-cart span').text(response.data.count);
                            }
                        }
                    });
                },
                error: () => {
                    _self.prop('disabled', false).removeClass('button-loading');
                }
            });
        });

        window.onBeforeChangeSwatches = function (data) {
            $('.add-to-cart-form .error-message').hide();
            $('.add-to-cart-form .success-message').hide();
            $('.number-items-available').html('').hide();

            if (data && data.attributes) {
                $('.add-to-cart-form button[type=submit]').prop('disabled', true).addClass('btn-disabled');
            }
        }

        window.onChangeSwatchesSuccess = function (res) {
            $('.add-to-cart-form .error-message').hide();
            $('.add-to-cart-form .success-message').hide();

            if (res) {
                let buttonSubmit = $('.add-to-cart-form button[type=submit]');
                if (res.error) {
                    buttonSubmit.prop('disabled', true).addClass('btn-disabled');
                    $('.number-items-available').html('<span class="text-danger">(' + res.message + ')</span>').show();
                    $('#hidden-product-id').val('');
                } else {
                    $('.add-to-cart-form').find('.error-message').hide();
                    $('.product_price .product-sale-price-text').text(res.data.display_sale_price);
                    if (res.data.sale_price !== res.data.price) {
                        $('.product_price .product-price-text').text(res.data.display_price).show();
                        $('.product_price .on_sale .on_sale_percentage_text').text(res.data.sale_percentage).show();
                        $('.product_price .show').hide();
                    } else {
                        $('.product_price .product-price-text').text(res.data.sale_percentage).hide();
                        $('.product_price .on_sale .on_sale_percentage_text').text(res.data.sale_percentage).hide();
                        $('.product_price .on_sale').hide();
                    }

                    if (res.data.sku) {
                        $('.product_description #product-sku span').text(res.data.sku);
                        $('.product_description #product-sku').show();
                    } else {
                        $('.product_description #product-sku').hide();
                    }

                    $('#hidden-product-id').val(res.data.id);
                    buttonSubmit.prop('disabled', false).removeClass('btn-disabled');

                    if (res.data.error_message) {
                        buttonSubmit.prop('disabled', true).addClass('btn-disabled');
                        $('.number-items-available').html('<span class="text-danger">(' + res.data.error_message + ')</span>').show();
                    } else if (res.data.success_message) {
                        $('.number-items-available').html('<span class="text-success">(' + res.data.success_message + ')</span>').show();
                    } else {
                        $('.number-items-available').html('').hide();
                    }

                    const unavailableAttributeIds = res.data.unavailable_attribute_ids || [];
                    $('.attribute-swatch-item').removeClass('pe-none');
                    $('.product-filter-item option').prop('disabled', false);
                    if (unavailableAttributeIds && unavailableAttributeIds.length) {
                        unavailableAttributeIds.map(function (id) {
                            let $item = $('.attribute-swatch-item[data-id="' + id + '"]');
                            if ($item.length) {
                                $item.addClass('pe-none');
                                $item.find('input').prop('checked', false);
                            } else {
                                $item = $('.product-filter-item option[data-id="' + id + '"]');
                                if ($item.length) {
                                    $item.prop('disabled', 'disabled').prop('selected', false);
                                }
                            }
                        });
                    }

                    let thumbHtml = '';
                    res.data.image_with_sizes.thumb.forEach(function (item, index) {
                        thumbHtml += '<div class="item"><a href="#" class="product_gallery_item ' + (index === 0 ? 'active' : '') + '" data-image="' + res.data.image_with_sizes.origin[index] + '" data-zoom-image="' + res.data.image_with_sizes.origin[index] + '"><img src="' + item + '" alt="image" loading="lazy" /></a></div>'
                    });

                    let slider = $('.slick_slider');

                    slider.slick('unslick');

                    slider.html(thumbHtml);

                    slider.slick({
                        rtl: $('body').prop('dir') === 'rtl',
                        arrows: slider.data('arrows'),
                        dots: slider.data('dots'),
                        infinite: slider.data('infinite'),
                        centerMode: slider.data('center-mode'),
                        vertical: slider.data('vertical'),
                        fade: slider.data('fade'),
                        cssEase: slider.data('css-ease'),
                        autoplay: slider.data('autoplay'),
                        verticalSwiping: slider.data('vertical-swiping'),
                        autoplaySpeed: slider.data('autoplay-speed'),
                        speed: slider.data('speed'),
                        pauseOnHover: slider.data('pause-on-hover'),
                        draggable: slider.data('draggable'),
                        slidesToShow: slider.data('slides-to-show'),
                        slidesToScroll: slider.data('slides-to-scroll'),
                        asNavFor: slider.data('as-nav-for'),
                        focusOnSelect: slider.data('focus-on-select'),
                        responsive: slider.data('responsive')
                    });

                    $(window).trigger('resize');

                    let image = $('#product_img');
                    image.prop('src', res.data.image_with_sizes.origin[0]).data('zoom-image', res.data.image_with_sizes.origin[0]);

                    let zoomActive = false;

                    zoomActive = !zoomActive;
                    if (zoomActive) {
                        if (image.length > 0) {
                            image.elevateZoom({
                                cursor: 'crosshair',
                                easing: true,
                                gallery: 'pr_item_gallery',
                                zoomType: 'inner',
                                galleryActiveClass: 'active'
                            });
                        }
                    } else {
                        $.removeData(image, 'elevateZoom');//remove zoom instance from image
                        $('.zoomContainer:last-child').remove();// remove zoom container from DOM
                    }
                }
            }
        };

        $(document).on('click', '.add-to-cart-form button[type=submit]', function (event) {
            event.preventDefault();
            event.stopPropagation();

            let _self = $(this);

            if (!$('#hidden-product-id').val()) {
                _self.prop('disabled', true).addClass('btn-disabled');
                return;
            }

            _self.prop('disabled', true).addClass('btn-disabled').addClass('button-loading');

            let $form = _self.closest('form');

            $form.find('.error-message').hide();
            $form.find('.success-message').hide();

            let data = $form.serializeArray();
            data.push({name: 'checkout', value: _self.prop('name') === 'checkout' ? 1 : 0});

            $.ajax({
                type: 'POST',
                url: $form.prop('action'),
                data: $.param(data),
                success: res => {
                    _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');

                    if (res.error) {
                        $form.find('.error-message').html(res.message).show();

                        if (res.data.next_url !== undefined) {
                            window.location.href = res.data.next_url;
                        }

                        return false;
                    }

                    $form.find('.success-message').html(res.message).show();

                    if (res.data.next_url !== undefined) {
                        window.location.href = res.data.next_url;
                    } else {
                        $.ajax({
                            url: window.siteUrl + '/ajax/cart',
                            method: 'GET',
                            success: function (response) {
                                if (!response.error) {
                                    $('.cart_box').html(response.data.html);
                                    $('.btn-shopping-cart span').text(response.data.count);
                                }
                            }
                        });
                    }
                },
                error: res => {
                    _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
                    Theme.handleError(res, $form);
                }
            });
        });

        $(document).on('change', '.submit-form-on-change', function () {
            $(this).closest('form').submit();
        });

        let imagesReviewBuffer = [];
        let setImagesFormReview = function (input) {
            const dT = new ClipboardEvent('').clipboardData || // Firefox < 62 workaround exploiting https://bugzilla.mozilla.org/show_bug.cgi?id=1422655
                new DataTransfer(); // specs compliant (as of March 2018 only Chrome)
            for (let file of imagesReviewBuffer) {
                dT.items.add(file);
            }
            input.files = dT.files;
            loadPreviewImage(input);
        }

        let loadPreviewImage = function (input) {
            let $uploadText = $('.image-upload__text');
            const maxFiles = $(input).data('max-files');
            let filesAmount = input.files.length;

            if (maxFiles) {
                if (filesAmount >= maxFiles) {
                    $uploadText.closest('.image-upload__uploader-container').addClass('d-none');
                } else {
                    $uploadText.closest('.image-upload__uploader-container').removeClass('d-none');
                }
                $uploadText.text(filesAmount + '/' + maxFiles);
            } else {
                $uploadText.text(filesAmount);
            }
            const viewerList = $('.image-viewer__list');
            const $template = $('#review-image-template').html();

            viewerList.addClass('is-loading');
            viewerList.find('.image-viewer__item').remove();

            if (filesAmount) {
                for (let i = filesAmount - 1; i >= 0; i--) {
                    viewerList.prepend($template.replace('__id__', i));
                }
                for (let j = filesAmount - 1; j >= 0; j--) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        viewerList
                            .find('.image-viewer__item[data-id=' + j + ']')
                            .find('img')
                            .attr('src', event.target.result);
                    }
                    reader.readAsDataURL(input.files[j]);
                }
            }
            viewerList.removeClass('is-loading')
        }

        $(document).on('change', '.form-review-product input[type=file]', function (event) {
            event.preventDefault();
            let input = this;
            let $input = $(input);
            let maxSize = $input.data('max-size');
            Object.keys(input.files).map(function(i) {
                if (maxSize && (input.files[i].size / 1024) > maxSize) {
                    let message = $input.data('max-size-message')
                        .replace('__attribute__', input.files[i].name)
                        .replace('__max__', maxSize)
                    window.showAlert('alert-danger', message);
                } else {
                    imagesReviewBuffer.push(input.files[i]);
                }
            });

            let filesAmount = imagesReviewBuffer.length;
            const maxFiles = $input.data('max-files');
            if (maxFiles && filesAmount > maxFiles) {
                imagesReviewBuffer.splice(filesAmount - maxFiles - 1, filesAmount - maxFiles);
            }

            setImagesFormReview(input);
        });

        $(document).on('click', '.form-review-product .image-viewer__icon-remove', function (event) {
            event.preventDefault();
            const $this = $(event.currentTarget);
            let id = $this.closest('.image-viewer__item').data('id');
            imagesReviewBuffer.splice(id, 1);

            let input = $('.form-review-product input[type=file]')[0];
            setImagesFormReview(input);
        });

        if (sessionStorage.reloadReviewsTab) {
            $('.nav-tabs li a[href="#reviews"]').trigger('click');
            sessionStorage.reloadReviewsTab = false;
        }

        $(document).on('click', '.form-review-product button[type=submit]', function (event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).prop('disabled', true).addClass('btn-disabled').addClass('button-loading');

            const $form = $(this).closest('form');
            $.ajax({
                type: 'POST',
                cache: false,
                url: $form.prop('action'),
                data: new FormData($form[0]),
                contentType: false,
                processData: false,
                success: res => {
                    if (!res.error) {
                        $form.find('select').val(0);
                        $form.find('textarea').val('');

                        showSuccess(res.message);

                        setTimeout(function () {
                            sessionStorage.reloadReviewsTab = true;
                            window.location.reload();
                        }, 1500);
                    } else {
                        showError(res.message);
                    }

                    $(this).prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
                },
                error: res => {
                    $(this).prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
                    Theme.handleError(res, $form);
                }
            });
        });

    });

    $('.form-coupon-wrapper .coupon-code').keypress(event => {
        if (event.keyCode === 13) {
            $('.apply-coupon-code').trigger('click');
            event.preventDefault();
            event.stopPropagation();
            return false;
        }
    });

    $(document).on('click', '.btn-apply-coupon-code', event => {
        event.preventDefault();
        let _self = $(event.currentTarget);
        _self.prop('disabled', true).addClass('btn-disabled').addClass('button-loading');

        $.ajax({
            url: _self.data('url'),
            type: 'POST',
            data: {
                coupon_code: _self.closest('.form-coupon-wrapper').find('.coupon-code').val(),
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: res => {
                if (!res.error) {
                    $('.form--shopping-cart').load(window.location.href + '?applied_coupon=1 .form--shopping-cart > *', function () {
                        _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
                    });
                } else {
                    $('.coupon-error-msg .text-danger').text(res.message);
                    _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
                }
            },
            error: data => {
                if (typeof (data.responseJSON) !== 'undefined') {
                    if (data.responseJSON.errors !== 'undefined') {
                        $.each(data.responseJSON.errors, (index, el) => {
                            $.each(el, (key, item) => {
                                $('.coupon-error-msg .text-danger').text(item);
                            });
                        });
                    } else if (typeof (data.responseJSON.message) !== 'undefined') {
                        $('.coupon-error-msg .text-danger').text(data.responseJSON.message);
                    }
                } else {
                    $('.coupon-error-msg .text-danger').text(data.status.text);
                }
                _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
            }
        });
    });

    $(document).on('click', '.btn-remove-coupon-code', event => {
        event.preventDefault();
        let _self = $(event.currentTarget);
        _self.prop('disabled', true).addClass('btn-disabled').addClass('button-loading');

        $.ajax({
            url: _self.data('url'),
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: res => {
                if (!res.error) {
                    $('.form--shopping-cart').load(window.location.href + ' .form--shopping-cart > *', function () {
                        _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
                    });
                } else {
                    $('.coupon-error-msg .text-danger').text(res.message);
                    _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
                }
            },
            error: data => {
                if (typeof (data.responseJSON) !== 'undefined') {
                    if (data.responseJSON.errors !== 'undefined') {
                        $.each(data.responseJSON.errors, (index, el) => {
                            $.each(el, (key, item) => {
                                $('.coupon-error-msg .text-danger').text(item);
                            });
                        });
                    } else if (typeof (data.responseJSON.message) !== 'undefined') {
                        $('.coupon-error-msg .text-danger').text(data.responseJSON.message);
                    }
                } else {
                    $('.coupon-error-msg .text-danger').text(data.status.text);
                }
                _self.prop('disabled', false).removeClass('btn-disabled').removeClass('button-loading');
            }
        });
    });

    $(document).on('click', '.js-add-to-compare-button', function (event) {
        event.preventDefault();
        let _self = $(this);

        _self.addClass('button-loading');

        $.ajax({
            url: _self.data('url'),
            method: 'POST',
            success: res => {

                if (res.error) {
                    _self.removeClass('button-loading');
                    showError(res.message);
                    return false;
                }

                showSuccess(res.message);

                _self.removeClass('button-loading');
            },
            error: res => {
                _self.removeClass('button-loading');
                showError(res.message);
            }
        });
    });

    $(document).on('click', '.js-remove-from-compare-button', function (event) {
        event.preventDefault();
        let _self = $(this);
        let buttonHtml = _self.html();

        _self.html(buttonHtml + '...');

        $.ajax({
            url: _self.data('url'),
            method: 'DELETE',
            success: res => {

                if (res.error) {
                    _self.text(buttonHtml);
                    showError(res.message);
                    return false;
                }

                $('.compare_box').load(window.location.href + ' .compare_box > *', function () {
                    showSuccess(res.message);

                    _self.html(buttonHtml);
                });
            },
            error: res => {
                _self.removeClass('button-loading');
                showError(res.message);
            }
        });
    });

    $(document).on('click', '.quantity .plus', function (event) {
        event.preventDefault();
        event.stopPropagation();
        let currentVal = parseInt($(this).prev('.qty').val(), 10);
        $(this).prev('.qty').val(currentVal + 1);

        if ($(this).closest('.form--shopping-cart').length) {
            ajaxUpdateCart($(this));
        }
    });

    $(document).on('click', '.quantity .minus', function (event) {
        event.preventDefault();
        event.stopPropagation();
        let currentVal = parseInt($(this).next('.qty').val(), 10);
        if (currentVal > 0) {
            $(this).next('.qty').val(currentVal - 1);
        }

        if (currentVal >= 0) {
            if ($(this).closest('.form--shopping-cart').length) {
                ajaxUpdateCart($(this));
            }
        }
    });

    $(document).on('change', '.quantity .qty', function (event) {
        event.preventDefault();
        event.stopPropagation();
        let currentVal = parseInt($(this).val(), 10);
        if (currentVal > 0) {
            $(this).val(currentVal);
        }

        if (currentVal >= 0) {
            if ($(this).closest('.form--shopping-cart').length) {
                ajaxUpdateCart($(this).closest('.quantity'));
            }
        }
    });

    function ajaxUpdateCart(_self) {
        _self.closest('.shop_cart_table').addClass('content-loading');

        $.ajax({
            type: 'POST',
            cache: false,
            url: _self.closest('form').prop('action'),
            data: new FormData(_self.closest('form')[0]),
            contentType: false,
            processData: false,
            success: res => {
                if (res.error) {
                    _self.closest('.shop_cart_table').removeClass('content-loading');
                    window.showAlert('alert-danger', res.message);
                    _self.prev('.qty').val(res.data.count);
                    return false;
                }

                $('.form--shopping-cart').load(window.location.href + ' .form--shopping-cart > *', function () {
                    _self.closest('.shop_cart_table').removeClass('content-loading');
                    window.showAlert('alert-success', res.message);
                });

                $.ajax({
                    url: window.siteUrl + '/ajax/cart',
                    method: 'GET',
                    success: response => {
                        if (!response.error) {
                            $('.cart_box').html(response.data.html);
                            $('.btn-shopping-cart span').text(response.data.count);
                        }
                    }
                });
            },
            error: res => {
                _self.closest('.shop_cart_table').removeClass('content-loading');
                window.showAlert('alert-danger', res.message);
            }
        });
    }

    require('../../../../../platform/plugins/language/resources/js/language-public');

    const quickSearchProducts = function () {
        const quickSearch = '.product_search_form';
        const $quickSearch = $('.product_search_form');
        $('body').on('click', function(e) {
            if (!$(e.target).closest(quickSearch).length) {
                $('.panel--search-result').removeClass('active');
            }
        });

        let currentRequest = null;
        $quickSearch.on('keyup', '.input-search-product', function () {
            const $form = $(this).closest('form');
            ajaxSearchProduct($form);
        });

        $quickSearch.on('change', '.product-category-select', function () {
            const $form = $(this).closest('form');
            ajaxSearchProduct($form);
        });

        function ajaxSearchProduct($form, url = null) {
            const $panel = $form.find('.panel--search-result');
            const k = $form.find('.input-search-product').val();
            if (!k) {
                $panel.html('').removeClass('active');
                return;
            }

            $quickSearch.find('.input-search-product').val(k); // update all inputs

            const $button = $form.find('button[type=submit]');
            currentRequest = $.ajax({
                type: 'GET',
                url: url || $form.data('ajax-url'),
                dataType: 'json',
                data: url ? [] : $form.serialize(),
                beforeSend : function() {
                    $button.addClass('loading');

                    if (currentRequest != null) {
                        currentRequest.abort();
                    }
                },
                success: res => {
                    if (!res.error) {
                        if (url) {
                            const $content = $('<div>' + res.data + '</div>');
                            $panel.find('.panel__content').append($content.find('.panel__content').contents());
                        } else {
                            $panel.html(res.data).addClass('active');
                        }
                    } else {
                        $panel.html('').removeClass('active');
                    }
                },
                error: () => {},
                complete: () => {
                    $button.removeClass('loading');
                }
            });
        }
    }
    quickSearchProducts();

})(jQuery);
