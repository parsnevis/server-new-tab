@extends('admin.layouts.backend')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->


                <div class="col-md-12">
                    <div class="card card-primary card-outline ">
                        <div class="card-body">
                            <div class="btn-group">
                            </div>
                            <a href="{{ url()->previous() }}" class="btn btn-warning float-right"><i class="fa fa-reply"></i></a>
                        </div>
                    </div>

                    <div class="card card-info card-outline shipment_information">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('lang.' . strtoupper('Role Information')) }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-angle-double-up"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.roles.store') }}" method="POST">
                                        @csrf


                                        <input type="hidden" name="id" value="0">
                                        <input type="hidden" name="permissions" value="">

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="name" class="control-label "><span class="req text-danger">* </span>{{ __('lang.' . strtoupper('english_name')) }}</label>
                                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 tree-aa"></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success float-right">{{ __('lang.' . strtoupper('Submit')) }}</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /.content -->

    <script type="text/javascript">
        let _url     = `/admin/load_permissions`;
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let _id = $('input[name=id]').val();

        $.ajax({
            url: _url,
            type: "GET",
            data: {
                id: _id,
                _token: _token
            },
            success: function(response) {
                var permissions = response.permissions;
                var selected = response.selected;
                console.log(permissions)
                console.log(selected)

                let tree = new Tree('.tree-aa', {
                    data: [{id: '0', text: '{{ __('lang.' . strtoupper('Select All')) }}', children: permissions}],
                    closeDepth: 10,
                    beforeLoad: function (){
                    },
                    loaded: function () {
                        var values = [];
                        $.each(permissions, function (index) {
                            if(this.children.length > 0)
                            {
                                $.each(this.children, function (index) {
                                    if(this.children.length > 0)
                                    {
                                        $.each(this.children, function (index) {
                                            if(this.children.length > 0)
                                            {
                                                $.each(this.children, function (index) {
                                                    if(this.children.length > 0)
                                                    {
                                                        $.each(this.children, function (index) {
                                                            if(this.children.length > 0)
                                                            {
                                                                $.each(this.children, function (index) {
                                                                    if(this.children.length > 0)
                                                                    {
                                                                        $.each(this.children, function (index) {
                                                                            if(selected.includes(this.text))
                                                                                values.push(this.id);
                                                                        })
                                                                    }
                                                                    else
                                                                    {
                                                                        if(selected.includes(this.text))
                                                                            values.push(this.id);
                                                                    }
                                                                })
                                                            }
                                                            else
                                                            {
                                                                if(selected.includes(this.text))
                                                                    values.push(this.id);
                                                            }
                                                        })
                                                    }
                                                    else
                                                    {
                                                        if(selected.includes(this.text))
                                                        {
                                                            values.push(this.id);
                                                        }
                                                    }
                                                })
                                            }
                                            else
                                            {
                                                if(selected.includes(this.text))
                                                    values.push(this.id);
                                            }
                                        })
                                    }
                                    else
                                    {
                                        if(selected.includes(this.text))
                                            values.push(this.id);
                                    }
                                })
                            }
                            else
                            {
                                if(selected.includes(this.text))
                                {
                                    values.push(this.id);
                                }
                            }

                        });
                        this.values = values;
                    },
                    onChange: function () {
                        var values = [];
                        $.each(this.selectedNodes, function (index) {
                            values.push(this.id);
                        });
                        $('input[name=permissions]').val(values);

                        // $('input[name=permissions]').val(this.values);
                    }
                });
            },
            error: function(response) {
            }
        });
    </script>
@endsection
