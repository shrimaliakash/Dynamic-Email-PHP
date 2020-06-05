<?php
	include('config/database.php');
	$result = mysqli_query("select * from emails");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/favicon.png">
	<title>Send Mail</title>
	<link rel="stylesheet" href="dist/summernote-bs4.css">
	<link href="css/style.css" rel="stylesheet">
  	
	<style>
		.email-top {
			margin-top: 10px;
		}
		.page-height {
			height: 100% !important;
		}
	</style>
</head>

<script src="js/jquery.js"></script> <!-- 3.4.1 -->
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> <!-- 1.5.2 -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="dist/summernote-bs4.js"></script>
<script src="js/app.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script>
	$(function () {
		$('.summernote_body').summernote({
			height: 200,
			tabsize: 2,
			callbacks: {
				onImageUpload: function(image) {
					editor = $(this);
					uploadImageContent(image[0], editor);
				},
				onChange: function (contents, $editable) {
	                summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);
	                summernoteValidator.element(summernoteElement);
	            }
			}
		});
		summernoteElement = $(".summernote_body");
		var summernoteValidator =  $('#insertEmailForm').validate({
			rules: {
				subject: 'required',
				body: {
					required: true
				}
		    },
		    messages: {
		      subject: 'Subject cannot be blank.',
		      body: 'Body cannot be blank.',
		    },
		    ignore: ':hidden:not(#summernote_body),.note-editable.panel-body',
		    errorElement: 'em',
		    errorPlacement: function ( error, element ) {
		      error.addClass( 'invalid-feedback' );
		      if ( element.prop( 'type' ) === 'checkbox' ) {
		        error.insertAfter( element.parent( 'label' ) );
		      } else {
		        error.insertAfter( element );
		      }
		    },
		    highlight: function ( element, errorClass, validClass ) {
		      $( element ).addClass( 'is-invalid' ).removeClass( 'is-valid' );
		    },
		    unhighlight: function (element, errorClass, validClass) {
		      $( element ).addClass( 'is-valid' ).removeClass( 'is-invalid' );
		    }
		});
	});
	function uploadImageContent(image, editor) {
        var data = new FormData();
        data.append("action", "insert");
        data.append("image", image);
        var url = "image_upload.php";
        $.ajax({
            url: url,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            success: function(url) {
                var image = $("<img width='369px'>").attr("src", url);
                $(editor).summernote("insertNode", image[0]);
            },
            error: function(e) {
            	console.log("error");
            }
        });
    }
</script>

<body class="app email-top">
	<div class="app-body">
		<main class="main">
			<div class="container-fluid">
				<div class="animated fadeIn">
					<form id="insertEmailForm">
						<div class="row page-height">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<strong>Insert Email</strong>
									</div>
									<div class="card-body">
										<div class="row">
										<input type="hidden" class="form-control" id="action" name="action" value="insert">
											<div class="col-md-12">
													<div class="form-group">
														<div class="row">
															<div class="form-group col-md-6">
																<label class="col-form-label" for="subject">Email Subject</label>
																<input type="text" class="form-control" id="subject" name="subject">
															</div>
														</div>
														<div class="row">
										                    <div class="col-md-12">
										                    	<label class="col-form-label" for="body">Email Body</label>
										                        <textarea class="summernote_body" id="body" name="body"></textarea>
										                    </div>
										                </div>
													</div>
											</div>
										</div>
									</div>
									<div class="card-footer">
										<button type="submit" id="sendmail" class="btn btn-primary float-right">Insert Email</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</main>
	</div>
</body>
<script>
	$.validator.setDefaults( {
	    submitHandler: function () {
	    	var url = 'email_insert.php';
	        $.ajax({
	            url: url,
	            data: $("#insertEmailForm").serialize(),
	            dataType: "json",
	            type: "post",
	            success: function(url) {
	            	console.log("success");
	            	location.reload();
	            },
	            error: function(e) {
	            	console.log(e);
	            	console.log("error");
	            }
	        });
	    }
	  });
</script>
</html>
