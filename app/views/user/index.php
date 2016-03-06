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
			  		<i class="fa fa-home fa-fw"></i>&nbsp; User List
			  </a>
			  </a>
			</div>

		</div>
		<div class="col-sm-9">

			<div class="panel panel-default">
				<div class="panel-body">

					<h1 style="margin-top:0px">Users List</h1>

					<div style="margin:15px 0px">
						<button class="btn btn-success" data-toggle="modal" data-target="#user-form-modal">New User</button>
						<button id="delete-users-btn" class="btn btn-danger"><i class="fa fa-trash"></i></button>
					</div>
					<form id="user-list-form" method="POST">
						<table class="table table-striped">
							{% for user in users %}
								<tr>
									<td><input type="checkbox" name="user_ids[]" value="{{ user.id }}" /></td>
									<td>{{ user.username }}</td>
									<td>{{ user.email }}</td>
									<td>{{ user.password }}</td>
								</tr>
							{% else %}
								No User has been found.
							{% endfor %}
						</table>
					</form>

				</div>
			</div>

		</div>
	</div>

	<!-- /.modal-content -->
	<div id="user-form-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">New User</h4>
				</div>
				<div class="modal-body">
					{% include 'user/form.php' %}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="save-user-form-btn" type="button" class="btn btn-primary">Save</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

</div>
{% endblock %}

{% block javascript %}
	{{ parent() }}

	<script>
		$(document).ready(function() {

			// Save a new user
			var $userForm = $('#user-form');
			$('#save-user-form-btn').on('click', function(e) {
				e.preventDefault();
				// Here we change the form action to be 'user/create'
				$userForm.submit();
			});

			// With this we add the delete call to the backend
			var $listForm = $('#user-list-form');
			$('#delete-users-btn').on('click', function(e) {
				e.preventDefault();
				// Here we change the form action to be 'user/delete'
				$listForm.attr('action', "{{ link('user', 'delete') }}").submit();
			});
		});
	</script>

{% endblock %}
