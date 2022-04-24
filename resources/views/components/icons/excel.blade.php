@switch(env('ICON_TYPE'))
    @case('fa'):
    <i class="fa fa-excel"></i>
    @break
    @case('la')
    <i class="la la-file-excel-o"></i>
    @break
    @default
    <i class="la la-trash"></i>
    @break
@endswitch
