{% extends layout %}

{% block content %}
<style type="text/css">

  .file-item {
      width: 120px;
      height: 105px;
      text-align: center;
      padding: 12px;
      margin: 5px;
      overflow: hidden;
      float: left;
      /* no user select */
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
  }
  .file-item:hover {
      background: #eee;
      cursor: pointer;
  }
  .file-item.selected {
      background: #F1F1F1;
  }
  .file-item.selected p {
      background: #7585BB;
      color: white;
      border-radius: 4px;
  }
  .file-item i {
      font-size: 40px;
      margin-bottom: 10px;
  }
  .file-item i.fa-file-pdf-o {
      color: #CE5353;
  }
  .file-item i.fa-file-excel-o {
      color: #44C14A;
  }
  .file-item i.fa-file-code-o {
      color: #4AC3BA;
  }
  .file-item i.fa-file-photo-o {
      color: #F98E00;
  }
  .file-item i.fa-file-word-o {
      color: #537CCE;
  }
  .file-item i.fa-file-zip-o {
      color: #C7BF40;
  }

  .folders-sidebar {
    border-right: 1px solid #e6e6e6;
    background: #f8f8f8;
    width: 200px;
    position: absolute;
    padding: 15px 20px 0 20px;
  }

  ul.folders-ct {
    list-style-type: none;
    margin-left: 0px;
    padding: 0px;
  }
  .folders-ct i {
    margin-right: 10px;
    color: #FFB500;
    font-size: 16px;
  }
  .folders-ct li.add-folder-item,
  .folders-ct i.fa-plus {
    color: #3CBB3C;
  }
  .folders-ct li {
    margin-top: 5px;
  }
  .folders-ct li.folder-item:hover,
  .folders-ct li.add-folder-item:hover
  {
    text-decoration: underline;
    cursor: pointer;
  }
  .navbar {
    border-radius: 0px;
    margin-bottom: 0px;
  }

  .files-main-content {
    position: absolute;
    margin-left: 200px;
  }

  .upload-file-btn {
    margin-bottom: 10px;
    width: 100%;
  }

</style>

<div class="viewport">

    <nav class="navbar navbar-default">
      <div class="container-fluid">

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#"><i class="fa fa-th"></i></a></li>
            <li><a href="#"><i class="fa fa-list"></i></a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>


    <div class="folders-sidebar">
      <button class="btn btn-primary upload-file-btn">Upload File</button>
      <ul class="folders-ct"></ul>
    </div>
    <div class="files-main-content"><div class="files-ct"></div></div>
</div>


{% endblock %}


{% block javascript %}
  {{ parent() }}

  <script type="text/javascript">

    $(document).ready(function() {
      
        var folders = [
          { name: 'My Documents' },
          { name: 'Important' },
          { name: 'More Garbage' },
          { name: 'Cat Videos' },
          { name: 'Trash' }
        ];

        var files = [
          { name: 'controller.php', type: 'code' },
          { name: 'memo.pdf', type: 'pdf' },
          { name: 'document.doc', type: 'word' },
          { name: 'sheet.xls', type: 'excel' },
          { name: 'image.jpeg', type: 'photo' },
          { name: 'somefile.zip', type: 'zip' },
          { name: 'controller.php', type: 'code' },
          { name: 'memo.pdf', type: 'pdf' },
          { name: 'document.doc', type: 'word' },
          { name: 'sheet.xls', type: 'excel' },
          { name: 'image.jpeg', type: 'photo' },
          { name: 'somefile.zip', type: 'zip' },
          { name: 'controller.php', type: 'code' },
          { name: 'memo.pdf', type: 'pdf' },
          { name: 'document.doc', type: 'word' },
          { name: 'sheet.xls', type: 'excel' },
          { name: 'image.jpeg', type: 'photo' },
          { name: 'somefile.zip', type: 'zip' },
          { name: 'controller.php', type: 'code' },
          { name: 'memo.pdf', type: 'pdf' },
          { name: 'document.doc', type: 'word' },
          { name: 'sheet.xls', type: 'excel' },
          { name: 'image.jpeg', type: 'photo' },
          { name: 'somefile.zip', type: 'zip' }
        ];

        $.each(files, function(i, file) {
            $('.files-ct').append(
                  '<div class="file-item">'
                +   '<i class="fa fa-file-' + file.type + '-o"></i><br/>'
                +   '<p>' + file.name + '</p>'
                + '</div>');
        });

        $.each(folders, function(i, file) {
            $('.folders-ct').append(
                  '<li class="folder-item">'
                +   '<i class="fa fa-folder"></i>'
                +   '<span>' + file.name + '</span>'
                + '</li>');
        });
        $('.folders-ct').append(
                  '<li class="add-folder-item">'
                +   '<i class="fa fa-plus"></i>'
                +   '<span>' + 'Create New Folder' + '</span>'
                + '</li>');



        $('.file-item').click(function(){
            $('.file-item').removeClass('selected');
            $(this).addClass('selected');
        });

        $('.folder-item').click(function(){
            $('.folder-item i').removeClass('fa-folder-open').addClass('fa-folder');
            $(this).children('i').removeClass('fa-folder').addClass('fa-folder-open');
        });

        $(window).resize(function(){ 
          var newHeight = ($(window).height() < $('.files-main-content').height())?
                          $('.files-main-content').height():
                          $(window).height();
          $('.folders-sidebar').height(newHeight);
        });
        $(window).resize();

    });

  </script>


{% endblock %}
