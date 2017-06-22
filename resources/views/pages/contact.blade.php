@extends('pages.master')
@section('content')

			<div class="container-fluid title">
				<div class="row">
					<div class="col-sm-12">
						<h2>Contact us</h2>
					</div>
				</div>
			</div>

			<div class="container-fluid contact product">
				<div class="row">
					<div class="col-xs-12 col-sm-4">
						<address>
							<p>Take me to your leader! Morbo can't understand his teleprompter because he forgot how you say that letter that's shaped like a man wearing a hat.</p>
							<br><strong>Stella Shop</strong><br>
							72 State Road 88<br>
							City, State 248139<br>
							(123) 256 - 7690<br>
							contact@company.com
						</address>
					</div>
					<div class="col-xs-12 col-sm-8">

						<form action="contact.html" class="myform" method="post" novalidate id="mycomment">
							<div class="row clearfix">
								<div class="col-xs-12 col-sm-6">
									<div class="form-group">
										<label class="control-label">Name</label>
										<div class="controls">
											<input name="contactName" placeholder="Your name" class="form-control input-lg requiredField" type="text" data-error-empty="Enter name">
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6">
									<div class="form-group">
										<label class="control-label">Email</label>
										<div class=" controls">
											<input name="email" placeholder="Your email" class="form-control input-lg requiredField" type="email" data-error-invalid="Invalid email address" data-error-empty="Enter email">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label">Message</label>
								<div class="controls">
									<textarea name="comments" placeholder="Your message" class="form-control input-lg requiredField" rows="5" data-error-empty="Enter message"></textarea>
								</div>
							</div>
							<p><button name="submit" type="submit" class="btn btn-store btn-block" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Email Sent">Send Message</button></p>
							<input type="hidden" name="submitted" id="submitted3" value="true">
						</form>
					</div>

				</div>
			</div>

			<div id="gmap" style="height:300px;"></div>
	@endsection
	@section('script')
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">
		/* google map ======================================= */
			$(document).ready(function() {
				function initializeGoogleMap() {
					var myLatlng = new google.maps.LatLng(51.47900,-0.06204);
					var myOptions = {
						center: myLatlng,
						zoom: 16,
						mapTypeControl: false,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						panControl: false,
						zoomControl: false,
						scaleControl: false,
						streetViewControl: false,
						scrollwheel: false
				};
				var styles = [{
					stylers: [
						{ hue: "#9245DC" },
						{ saturation: -20 }
					]},{
					featureType: "road",
					elementType: "geometry",
					stylers: [
						{ lightness: 100 },
						{ visibility: "simplified" }
					]
				}];

				var map = new google.maps.Map(document.getElementById("gmap"), myOptions);
				map.setOptions({styles: styles});


				var marker = new google.maps.Marker({
					position: myLatlng,
					center: myLatlng
				});


				google.maps.event.addDomListener(window, "resize", function() {
					map.setCenter(myLatlng);
				});

				marker.setMap(map);
				}

				initializeGoogleMap();
			});
		</script>

@endsection
