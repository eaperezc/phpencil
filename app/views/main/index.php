{% extends layout %}

{% block title %} {{ title }} {% endblock %}

{% block content %}

<div class="container-fluid">

	<div class="text-center" style="padding:50px 0px">
		<img height="120px" src="{{ asset('logo.png') }}" />
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

					<h1 style="margin-top:0px">Index</h1>

					<div style="margin:15px 0px">
						<button class="btn btn-success">Add New Item</button>
						<button class="btn btn-info">Edit Something</button>
						<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
					</div>

					<table class="table table-striped">
						{% for item in items %}
							<tr>
								<td>{{ item.name }}</td>
								<td>{{ item.date }}</td>
								<td><span class="label label-warning">{{ item.status }}</span></td>
							</tr>
						{% else %}
							No item has been found.
						{% endfor %}
					</table>

				</div>
			</div>

		</div>
	</div>

</div>
{% endblock %}
