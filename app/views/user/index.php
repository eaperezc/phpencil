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
			  <a class="list-group-item" href="{{ link('user', 'index') }}">
			  		<i class="fa fa-home fa-fw"></i>&nbsp; List (index)
			  </a>
			  </a>
			</div>

		</div>
		<div class="col-sm-9">

			<div class="panel panel-default">
				<div class="panel-body">

					<h1 style="margin-top:0px">Users List</h1>

					<div style="margin:15px 0px">
						<button class="btn btn-success">New User</button>
						<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
					</div>

					<table class="table table-striped">
						{% for user in users %}
							<tr>
								<td><input type="checkbox" /></td>
								<td>{{ user.username }}</td>
								<td>{{ user.email }}</td>
								<td>{{ user.password }}</td>
							</tr>
						{% else %}
							No User has been found.
						{% endfor %}
					</table>

				</div>
			</div>

		</div>
	</div>

</div>
{% endblock %}
