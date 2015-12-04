<link rel="stylesheet" href="main.css">

<h1>Index</h1>

<p>This is a test template</p>

{{ title }}

<ul>
{% for item in items %}
  <li>{{ item }}</li>
{% else %}
  No item has been found.
{% endfor %}
</ul>
