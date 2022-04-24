@switch(env('ICON_TYPE'))
    @case('fa'):
    <i class="fa fa-fw fa-trash"></i>
    @break
    @case('la')
    <i class="la la-trash"></i>
    @break
    @default
    <i class="la la-trash"></i>
    @break
@endswitch
