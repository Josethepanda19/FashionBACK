<?php
		require('views/header.php');
		if(!isset($_SESSION))
		{session_start();}

?>

<div class="body">
	<div role="main" class="main">

		<section class="page-header page-header-classic page-header-sm">
			<div class="container">
				<div class="row">
					<div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                        <h1 data-title-border>Create a new Post</h1>
                    </div>
                    <div class="col-md-4 order-1 order-md-2 align-self-center">
                        <ul class="breadcrumb d-block text-md-right">
                            <li><a href="index.php">Home</a></li>
                            <li class="active">New Post</li>
                        </ul>
                    </div>
				</div>
			</div>
		</section>

		<div class="container py-2">

			<div class="row">

                <div class="col-lg-1"></div>
				<div class="col-lg-10 order-1 order-lg-2">

					<div class="offset-anchor" id="contact-sent"></div>

					<div class="overflow-hidden mb-1">
						<h2 class="font-weight-normal text-7 mb-0"><strong class="font-weight-extra-bold">Make a New Fashion Post</strong></h2>
					</div>
					<div class="overflow-hidden mb-4 pb-3">
						<p class="mb-0">Need advice? Don't know what to wear what with what?Feel free to ask for details, don't save any questions!</p>
					</div>
					<!-- Spits out error messages for the form -->
					<?php
						if($regErr){
						foreach($regErr as $msg){
							echo $msg;
						}
					}?>


<!---FORM Start-->
	<!-- <form id="contactFormAdvanced" action="<?//php echo basename($_SERVER['PHP_SELF']); ?>#contact-sent" method="POST" enctype="multipart/form-data"> -->
					<form id="contactFormAdvanced" action="." method="POST" enctype="multipart/form-data">
						<!--Sets Parameters-->
						<input type="hidden" name="ctlr" value= "home" />
						<input type="hidden" name="action" value="newPost" />
						<!-- Form Parameters -->
						<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />

						<!-- Form Start -->
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="required font-weight-bold text-dark">Title of Article</label>
								<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="articleTitle" id="name" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label class="font-weight-bold text-dark">Article of Clothing</label>
								<!--Look at radio buttons HAVE TO DO-->
								<select data-msg-required="Please select which article." class="form-control" name="articleClothing" id="subject" required>
									<option value="">Select</option>
									<option value="1">Top</option>
									<option value="2">Bottom</option>
									<option value="3">Shoes</option>
									<option value="4">Accessories</option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label class="font-weight-bold text-dark">Attachment <span class="font-weight-light text-dark">&nbsp (img, png, jpg files accepted)<span></label><br>
								<!-- FILE UPLOAD STUFF HERE-->


										<input type="file" name="article_image" /><br />
										<!-- <input type="submit" name="submit" value="Upload file" />  Don't need this cause form handles that for us-->

							</div>
							<?php
							// Inspect the values PHP retrieves in $_FILES
							// echo "<hr />";
							// var_dump($_FILES);
							// echo "<hr />";
							//
							// upload_file('clothing_image');

							?>
						</div>
						<!-- Message Box Area -->
						<div class="form-row">
							<div class="form-group col-md-12 mb-4">
								<label class="required font-weight-bold text-dark">Article Body Text</label>
								<textarea maxlength="5000" data-msg-required="Please enter your message." rows="6" class="form-control" name="body" id="message" required></textarea>
							</div>
						</div>
						<!-- Seperater Line COSMETIC -->
						<div class="form-row">
							<div class="form-group col-md-12">
								<hr>
							</div>
						</div>
						<!-- SUBMIT BUTTON -->
						<div class="form-row">
							<div class="form-group col-md-12 mb-5">
								<input type="submit" id="contactFormSubmit" value="Send Message" class="btn btn-primary btn-modern pull-right" data-loading-text="Loading...">
							</div>
						</div>
					</form>
<!--Form End-->
					<?php

					upload_file('clothing_image');

					?>
				</div>
			</div>

		</div>

	</div>
</div>
<?php require('views/footer.php');
