@extends(Theme::getThemeNamespace() . '::views.ecommerce.customers.master')

@section('content')
    @php Theme::set('pageName', __('My Addresses')) @endphp
    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h3>{{ __('My Addresses') }}</h3>
            </div>
            <div class="float-right">
                <a class="add-address btn btn-fill-out btn-sm" href="{{ route('customer.address.create') }}">
                    <span>{{ __('Add a new address') }}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{ __('Address') }}</th>
                        <th>{{ __('Is default?') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($addresses) > 0)
                        @foreach($addresses as $address)
                            <tr class="dashboard-address-item">
                                <td style="white-space: inherit;">
                                    <p>{{ $address->name }}, {{ $address->address }}, {{ $address->city }}, {{ $address->state }}@if (EcommerceHelper::isUsingInMultipleCountries()), {{ $address->country_name }} @endif @if (EcommerceHelper::isZipCodeEnabled()), {{ $address->zip_code }} @endif - {{ $address->phone }}</p>
                                </td>
                                <td style="width: 120px;">
                                    @if ($address->is_default) {{ __('Yes') }} @else {{ __('No') }} @endif
                                </td>
                                <td style="width: 100px;">
                                    <a class="btn btn-dark btn-sm" href="{{ route('customer.address.edit', $address->id) }}">{{ __('Edit') }}</a>
                                    <a class="btn btn-fill-out btn-sm btn-trigger-delete-address" href="#" data-url="{{ route('customer.address.destroy', $address->id) }}">{{ __('Remove') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">{{ __('No address!') }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-3 justify-content-center pagination_style1">
                {!! $addresses->links() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>{{ __('Confirm delete') }}</strong></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Do you really want to delete this address?') }}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark btn-sm" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button class="btn btn-fill-out btn-sm btn-confirm-delete" type="submit">{{ __('Delete') }}</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
@endsection
