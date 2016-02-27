{% extends layout %}

{% block title %} Index title Override {% endblock %}

{% block styles %}
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
{% endblock %}

{% block javascript %}
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{% endblock %}

{% block content %}

<div class="container-fluid">

	<div class="text-center" style="padding:50px 0px">
		<img height="120px" src="{{ asset('PHPencil_logo.png') }}" />
	</div>
	
	<div class="row">
		<div class="col-sm-3">
		
			<div class="list-group">
			  <a class="list-group-item" href="#"><i class="fa fa-home fa-fw"></i>&nbsp; Home</a>
			  <a class="list-group-item" href="#"><i class="fa fa-book fa-fw"></i>&nbsp; Library</a>
			  <a class="list-group-item" href="#"><i class="fa fa-pencil fa-fw"></i>&nbsp; Applications</a>
			  <a class="list-group-item" href="#"><i class="fa fa-cog fa-fw"></i>&nbsp; Settings <span class="badge">4</span></a>
			</div>

		</div>
		<div class="col-sm-9">

			<div class="panel panel-default">
				<div class="panel-body">

					<h1 style="margin-top:0px">Index</h1>

					<p>This is a test template</p>
					{{ title }}
					<ul>
						{% for item in items %}
							<li>{{ item }}</li>
						{% else %}
							No item has been found.
						{% endfor %}
					</ul>

				</div>
			</div>

		</div>
	</div>

</div>
{% endblock %}