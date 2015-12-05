
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