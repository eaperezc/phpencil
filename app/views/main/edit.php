{% extends layout %}

{% block content %}

<div class="container-fluid">

    <div class="text-center" style="padding:50px 0px">
        <img height="120px" src="{{ asset('PHPencil_logo.png') }}" />
    </div>

    <div class="row">
        <div class="col-sm-3">
        
            <div class="list-group">
              <a class="list-group-item" href="{{ link('main', 'index') }}">
                    <i class="fa fa-home fa-fw"></i>&nbsp; List (index)
              </a>
              <a class="list-group-item" href="{{ link('main', 'view') }}">
                    <i class="fa fa-book fa-fw"></i>&nbsp; View
              </a>
              <a class="list-group-item" href="{{ link('main', 'edit') }}">
                    <i class="fa fa-pencil fa-fw"></i>&nbsp; Edit
              </a>
              <a class="list-group-item" href="{{ link('main', 'index') }}">
                    <i class="fa fa-cog fa-fw"></i>&nbsp; Settings <span class="badge">4</span>
              </a>
            </div>

        </div>
        <div class="col-sm-9">

            <div class="panel panel-default">
                <div class="panel-body">

                    <h1 style="margin-top:0px">Edit</h1>

                </div>
            </div>

        </div>
    </div>

</div>
{% endblock %}