@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        {{-- Page Header --}}
        <section class="content-header">
            <h1>Food Menu's</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Other</a></li>
                <li class="active">Food Menu</li>
            </ol>
        </section>

        {{-- Page Content --}}
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        @forelse($menus as $menu)
                            <div class="col-md-4">
                                <div class="box box-primary">
                                    <div class="box-header" style="padding: 0">
                                        <img class="img-responsive center-block" style="height: 150px;" src="{{ isset($menu->pict) ? asset('assets/pictures/menu/'.$menu->pict) : 'https://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20(43).jpg' }}">
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-xs btn-primary btn-edit" data-toggle="modal" data-target="#modal-edit" data-route="{{ route('food-menu.edit', $menu->id) }}">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-xs btn-delete" data-form="form-delete-{{ $menu->id }}">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <form id="form-delete-{{ $menu->id }}" action="{{ route('food-menu.destroy', $menu->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                            </form>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <h4 style="margin-top: 0;"><strong>{{ $menu->name }}</strong></h4>
                                        <p>
                                            <strong>Price :  </strong>  
                                            Rp. {{ number_format($menu->price,0,',','.') }},- / Porsi
                                        </p>
                                        <p>
                                            <strong>Minimal Order :  </strong>  
                                            {{ $menu->min_order }} Porsi
                                        </p>
                                        <p>
                                            <a href="javascript:void(0);" data-toggle="popover" title="Description" data-placement="bottom" data-content="{{ $menu->description }}">
                                                <strong>Read the description</strong>     
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="callout callout-info">
                                    <h4>No Data!</h4>
                                    <p>Menu list is empty...</p>
                                  </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="row text-center">
                        {{ $menus->links() }}
                    </div>
                </div>
                <div class="col-md-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                            {{ session('success') }}
                        </div>
                    @elseif (session('failed'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                            {{ session('failed') }}
                        </div>
                    @endif
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-fw fa-plus-square"></i> Add Menu</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <form role="form" method="post" action="{{ route('food-menu.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter the name of new menu..." required="required">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            Rp.
                                        </div>
                                        <input type="text" name="price" class="form-control" placeholder="Enter price for this menu..." required="required" data-mask="999.999.999" data-mask-reverse="true">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Enter description about this menu..." required="required"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Min. Order</label>
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default btn-delMin" type="button">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="min_order" class="form-control" value="1" min="1" style="text-align: center;" readonly="readonly">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default btn-addMin" type="button">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 hidden-xs" style="padding-top: 30px; padding-left: 0">
                                            <strong>Porsi</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Menu Picture</label>
                                    <input type="file" name="pict" required="required">
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right"><strong>Add to menu list</strong> <i class="fa fa-fw fa-check-square-o"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Modal --}}
            <div class="row">
                <div class="modal fade" id="modal-edit" style="display: none;">
                    <div class="modal-dialog">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title" align="center"><i class="fa fa-fw fa-pencil"></i> Edit this menu</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <form role="form" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter the name of new menu..." required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    Rp.
                                                </div>
                                                <input type="text" name="price" class="form-control" placeholder="Enter price for this menu...">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="3" placeholder="Enter description about this menu..." required="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Min. Order</label>
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default btn-delMin" type="button">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="min_order" class="form-control" value="1" min="1" style="text-align: center;" readonly="readonly">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default btn-addMin" type="button">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Menu Picture</label>
                                            <input type="file" name="pict" required="required" class="col-md-12" style="padding: 0;">
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right"><strong>Save changes</strong> <i class="fa fa-fw fa-check-square-o"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <!-- InputMask -->
    <script src="{{ asset('assets/jquery-mask/dist/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();

            $('.btn-addMin').click(function(event) {
                var addMin = parseInt($('input[name=min_order]').val()) + 1;
                $('input[name=min_order]').val(addMin);
            });

            $('.btn-delMin').click(function(event) {
                if (parseInt($('input[name=min_order]').val()) == 1) {
                    return false;
                }
                var delMin = parseInt($('input[name=min_order]').val()) - 1;
                $('input[name=min_order]').val(delMin);
            });

            $('.btn-edit').click(function(event) {
                $.get($(this).data('route'), function(data) {
                    $('#modal-edit form').remove();
                    $('#modal-edit .box-header').after(data);
                });
            });

            $('.btn-delete').click(function(event) {
                var r = confirm('Are you sure to remove this from menu list ?');
                if (r == true) {
                    document.getElementById($(this).data('form')).submit();
                }
            });
        });
    </script>
@endsection