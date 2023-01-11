<div class="row">
    <div class="col-sm-12">
        <table class="widefat table table-striped text-center table-clients no-footer">
            <thead>
            <tr>
                <th class="id">{{ __('lang.' . strtoupper('#')) }}</th>
                <th class="name">{{ __('lang.' . strtoupper('name_or_company_name')) }}</th>
                <th class="email">{{ __('lang.' . strtoupper('email')) }}</th>
                <th class="phone">{{ __('lang.' . strtoupper('phone_number')) }}</th>
                <th class="group">{{ __('lang.' . strtoupper('activated')) }}</th>
                <th class="group">{{ __('lang.' . strtoupper('customer_group')) }}</th>
{{--                <th class="group">{{ __('lang.' . strtoupper('role')) }}</th>--}}
                <th class="group">{{ __('lang.' . strtoupper('subscription_code')) }}</th>
                <th class="operation">{{ __('lang.' . strtoupper('operations')) }}</th>
            </tr>
            </thead>

            <tbody>
            @if ($users && count($users) > 0)
                @foreach ($users as $key=>$user)
                    <tr>
                        <td><span class="persian-number">{{ ($key+1)+($page == 1 ? 0 : ($page-1)*15) }}</span></td>
                        <td>
                            @if(!in_array($user->roles->pluck('name')->first(), array('Super User', 'Management', 'Administrator'))
                            or (in_array($_auth->roles->pluck('name')->first(), array('Super User'))
                                and in_array($user->roles->pluck('name')->first(), array('Management', 'Administrator')))
                            or (in_array($_auth->roles->pluck('name')->first(), array('Management'))
                                and in_array($user->roles->pluck('name')->first(), array('Administrator')))
                            or ($user->id == $_auth->id))
                                <a href="{{ route('admin.users.edit', $user->id) }}"><strong>{{ $user->first_name . ' ' . $user->last_name }}</strong></a>
                            @else
                                <strong>{{ $user->first_name . ' ' . $user->last_name }}</strong>
                            @endif
                        </td>
                        <td class="email"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                            @if(!in_array($user->roles->pluck('name')->first(), array('Super User', 'Management', 'Administrator'))
                            or (in_array($_auth->roles->pluck('name')->first(), array('Super User'))
                                and in_array($user->roles->pluck('name')->first(), array('Management', 'Administrator')))
                            or (in_array($_auth->roles->pluck('name')->first(), array('Management'))
                                and in_array($user->roles->pluck('name')->first(), array('Administrator'))))

                                <div class="onoffswitch">
                                    <input type="checkbox" name="customer_status" class="onoffswitch-checkbox" id="customer-{{ $user->id }}" {{ $user->activated == 'Yes' ? 'checked' : '' }}>
                                    <label class="onoffswitch-label" for="customer-{{ $user->id }}"></label>
                                </div>

                            @endif
                        </td>
                        <td>
                            @if(empty($user->customer_group) || $user->customer_group == null)
                                <span class="label label-info mleft5 inline-block">{{ __('lang.' . strtoupper("doesn't_have")) }}</span>
                            @else
                                @foreach ($customer_groups as $customer_group)
                                    @if($customer_group->name_en == $user->customer_group)
                                        <span class="label label-info mleft5 inline-block">{{ __('lang.' . strtoupper(implode('_', explode(' ', $customer_group->name_en)))) }}</span>
                                    @endif
                                @endforeach
                            @endif
                        </td>
{{--                        <td><span class="label label-warning">{{ __('lang.' . strtoupper($user->roles->pluck('name')->first())) }}</span></td>--}}
                        <td><span>{{ $user->subscribtion_code }}</span></td>
                        <td>
                            <div>
                                <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
                                    <div class="btn-group">
                                        @if(!in_array($user->roles->pluck('name')->first(), array('Super User', 'Management', 'Administrator'))
                                        or (in_array($_auth->roles->pluck('name')->first(), array('Super User'))
                                            and in_array($user->roles->pluck('name')->first(), array('Management', 'Administrator')))
                                        or (in_array($_auth->roles->pluck('name')->first(), array('Management'))
                                            and in_array($user->roles->pluck('name')->first(), array('Administrator')))
                                        or ($user->id == $_auth->id))

                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('admin.users.reset', $user->id) }}" class="btn btn-warning"><i class="fas fa-user-edit"></i></a>
                                            <a href="{{ route('admin.users.login', $user->id) }}" target="_blank" class="btn btn-warning"><i class="fas fa-user-lock"></i></a>
                                        @endif

                                        @if(!in_array($user->roles->pluck('name')->first(), array('Super User', 'Management', 'Administrator'))
                                        or (in_array($_auth->roles->pluck('name')->first(), array('Super User'))
                                            and in_array($user->roles->pluck('name')->first(), array('Management', 'Administrator')))
                                        or (in_array($_auth->roles->pluck('name')->first(), array('Management'))
                                            and in_array($user->roles->pluck('name')->first(), array('Administrator'))))

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('آیا از حذف این آیتم مطمئن هستید؟');" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>

                                        @endif
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
                <th class="name">{{ __('lang.' . strtoupper('name_or_company_name')) }}</th>
                <th class="email">{{ __('lang.' . strtoupper('email')) }}</th>
                <th class="phone">{{ __('lang.' . strtoupper('phone_number')) }}</th>
                <th class="group">{{ __('lang.' . strtoupper('activated')) }}</th>
                <th class="group">{{ __('lang.' . strtoupper('customer_group')) }}</th>
{{--                <th class="group">{{ __('lang.' . strtoupper('role')) }}</th>--}}
                <th class="group">{{ __('lang.' . strtoupper('subscription_code')) }}</th>
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
