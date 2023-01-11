<div class="row">
    <div class="col-sm-12">
        <table class="widefat table table-striped text-center table-clients no-footer">
            <thead>
            <tr>
                <th class="id">{{ __('lang.' . strtoupper('#')) }}</th>
                <th class="name">{{ __('lang.' . strtoupper('name')) }}</th>
                <th class="email">{{ __('lang.' . strtoupper('email')) }}</th>
                <th class="phone">{{ __('lang.' . strtoupper('mobile')) }}</th>
                <th class="phone">{{ __('lang.' . strtoupper('phone_number')) }}</th>
                <th class="phone">{{ __('lang.' . strtoupper('activated')) }}</th>
                <th class="operation">{{ __('lang.' . strtoupper('operations')) }}</th>
            </tr>
            </thead>

            <tbody>
            @if ($users && count($users) > 0)
                @foreach ($users as $key=>$user)
                    <tr>
                        <td><span class="persian-number">{{ ($key+1)+($page == 1 ? 0 : ($page-1)*15) }}</span></td>
                        <td>
                            <a href="{{ route('reseller.users.edit', $user->id) }}"><strong>{{ $user->first_name . ' ' . $user->last_name }}</strong></a>
                        </td>
                        <td class="email"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        <td>{{ $user->mobile }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                            <div class="onoffswitch">
                                <input type="checkbox" name="user_status" class="onoffswitch-checkbox" id="user-{{ $user->id }}" {{ $user->activated_at != null ? 'checked' : '' }}>
                                <label class="onoffswitch-label" for="customer-{{ $user->id }}"></label>
                            </div>
                        </td>

                        <td>
                            <div>
                                <form action="{{ route('reseller.users.destroy',$user->id) }}" method="POST">
                                    <div class="btn-group">

                                            <a href="{{ route('reseller.users.edit', $user->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
{{--                                            <a href="{{ route('reseller.users.reset', $user->id) }}" class="btn btn-warning"><i class="fas fa-user-edit"></i></a>--}}
{{--                                            <a href="{{ route('reseller.users.login', $user->id) }}" target="_blank" class="btn btn-warning"><i class="fas fa-user-lock"></i></a>--}}

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('آیا از حذف این آیتم مطمئن هستید؟');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>

                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>

            <tfoot>
            <tr>
                <th class="id">{{ __('lang.' . strtoupper('#')) }}</th>
                <th class="name">{{ __('lang.' . strtoupper('name')) }}</th>
                <th class="email">{{ __('lang.' . strtoupper('email')) }}</th>
                <th class="phone">{{ __('lang.' . strtoupper('mobile')) }}</th>
                <th class="phone">{{ __('lang.' . strtoupper('phone_number')) }}</th>
                <th class="phone">{{ __('lang.' . strtoupper('activated')) }}</th>
                <th class="operation">{{ __('lang.' . strtoupper('operations')) }}</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        {{ $users->links() }}
    </div>
</div>
