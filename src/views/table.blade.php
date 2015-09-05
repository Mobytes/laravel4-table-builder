<div class="wrapper wrapper-content animated fadeInUp">
    <div class="ibox">
        <div class="ibox-title">
            <h5>{{$title}}</h5>

            <div class="ibox-tools">
                <a href="{{route('landpage.noticias.create')}}" class="btn btn-primary btn-xs">{{$name_btn}}</a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="row m-b-sm m-t-sm">
                <div class="col-md-1">
                    <a type="button" id="loading-example-btn" class="btn btn-white btn-sm"
                       href="{{route('landpage.noticias')}}"><i class="fa fa-refresh"></i> Refresh</a>
                </div>
                <div class="col-md-11">
                    <form>
                        <div class="input-group">
                            <input type="text" name="search" autofocus placeholder="Search"
                                   class="input-sm form-control" value="{{Input::get("search")}}">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-sm btn-primary"> Buscar!</button>
                                        </span>
                        </div>
                    </form>

                </div>
            </div>
            <div class="project-list">
                <table class="table table-hover">
                    {{ $thead }}
                    <tbody>
                    {{$tbody}}
                    </tbody>
                </table>
                {{$paginator->appends(["search" => Input::get('search')])->links()}}
            </div>
        </div>
    </div>
</div>