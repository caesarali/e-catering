<form role="form" method="post" action="{{ route('food-menu.update', $menu->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="box-body">
        <div class="col-md-8">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter the name of new menu..." value="{{ $menu->name }}" required="required">
            </div>
            <div class="form-group">
                <label>Price</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        Rp.
                    </div>
                    <input type="text" name="price" class="form-control" placeholder="Enter price for this menu..." value="{{ $menu->price }}" required="required">
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Enter description about this menu..." required="required">{{ $menu->description }}</textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Min. Order</label>
                <div class="input-group">
                    <div class="input-group-btn">
                        <button class="btn btn-default btn-minOrder" type="button">
                            <i class="fa fa-minus"></i>
                        </button>
                        <script type="text/javascript">
                            $('.btn-minOrder').click(function(event) {
                                if (parseInt($('#min_order').val()) == 1) {
                                    return false;
                                }
                                var delMin = parseInt($('#min_order').val()) - 1;
                                $('#min_order').val(delMin);
                            });
                        </script>
                    </div>
                    <input id="min_order" type="text" name="min_order" class="form-control" value="{{ $menu->min_order }}" min="1" style="text-align: center;">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="document.getElementById('min_order').value = parseInt(document.getElementById('min_order').value) + 1">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Menu Picture</label>
                <img class="img-responsive" style="margin-bottom: 10px" src="{{ isset($menu->pict) ? asset('assets/pictures/menu/'.$menu->pict) : '' }}">
                <input type="file" name="pict" class="col-md-12" style="padding: 0;" @if(empty($menu->pict)) required="required" @endif>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right"><strong>Save changes</strong> <i class="fa fa-fw fa-check-square-o"></i></button>
    </div>
</form>