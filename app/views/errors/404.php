{% block content %}

    <div class="container">

        <h1>404 - Damn! the page you requested was not found</h1>

        {% if error %}
            <div class="well">
                {{ error }}
            </div>
        {% endif %}

    </div>

{% endblock %}

{% block styles %}
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
{% endblock %}

{% block javascript %}
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
{% endblock %}
