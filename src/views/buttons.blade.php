<div class="btn-group">
    <a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-cogs"></i>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ route("$name_route.show", array($item['id'])) }}">
                <i class="icon-info-sign"></i>&nbsp;Ver
            </a>
        </li>
        <li>
            <a href="{{ route("$name_route.edit", array($item['id'])) }}">
                <i class="fa fa-edit"></i>&nbsp;Editar
            </a>
        </li>
        <li>
            <a href="{{ route("$name_route.destroy", array($item['id'])) }}"
               data-method="delete"
               data-modal-text="eliminar este registro?">
                <i class="fa fa-trash"></i>&nbsp;Borrar
            </a>
        </li>
    </ul>
</div>