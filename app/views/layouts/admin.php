<!DOCTYPE html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> 
    <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="cleartype" content="on">

        <title>{% block title %}Page Title{% endblock %}</title>

        <!-- Browser favicon -->
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

        {% block styles %}
            <link rel="stylesheet" href="{{ asset('styles/admin.css') }}">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        {% endblock %}

    </head>
    <body>

        <div class="viewport">
            
            {% include 'partials/side-menu.php' %}

            <div class="center-content">

                <!-- Here we will display the whole tpl content -->
                {% block content %}
                {% endblock %}
            </div>
        </div>
    
        {% block javascript %}
            <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        {% endblock %}

    </body>
</html>