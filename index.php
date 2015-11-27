<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Pross">

    <title>HTTP/2 Detection</title>

    <!-- Bootstrap core CSS -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="assets/sticky-footer.css" rel="stylesheet">
    
    <link rel="stylesheet" href="//simonwhitaker.github.io/github-fork-ribbon-css/gh-fork-ribbon.css">
    <!--[if lt IE 9]>
        <link rel="stylesheet" href="//simonwhitaker.github.io/github-fork-ribbon-css/gh-fork-ribbon.ie.css">
    <![endif]-->

  </head>

  <body>
    <div class="github-fork-ribbon-wrapper right">
    <div class="github-fork-ribbon">
        <a href="https://github.com/Pross/h2-check">Fork me on GitHub</a>
    </div>
  </div>
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>HTTP/2 Check</h1>
      </div>
      <p class="lead">Check your site for HTTP/2.</p>

			<div class="row">
			  <div class="col-lg-8">
			    <div class="input-group">
						<span class="input-group-addon" id="basic-addon3">https://</span>
			      <input type="text" class="form-control url" placeholder="example.com" />
			      <span class="input-group-btn">
			        <button id="urlsubmit" class="btn btn-default" type="button">Go!</button>
			      </span>			
			    </div><!-- /input-group -->
					<div class="msg"></div>
			  </div><!-- /.col-lg-8 -->
			</div><!-- /.row -->
			
			<div class="row">
			  <div class="col-lg-8">
					<div class="output hidden">
					</div>
				</div>
			</div>
			
			
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted">HTTP/2 Detection.</p>
      </div>
    </footer>


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/ie10-viewport-bug-workaround.js"></script>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="check.js"></script>
  </body>
</html>
