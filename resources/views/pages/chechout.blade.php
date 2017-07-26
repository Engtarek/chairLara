@extends('pages.master')
@section('content')

			<div class="container-fluid title">
				<div class="row">
					<div class="col-sm-12">
						<h2>{{trans('keys.Checkout')}} / {{trans('keys.Step')}} 1 {{trans('keys.of')}} 2</h2>
					</div>
				</div>
			</div>

			<div class="container-fluid cart-list">
				<div class="row">
					<div class="col-sm-6 col-xs-12 @if(App::isLocale('ar')) pull-right @endif">
						<form action="{{url('/checkout')}}" method="post" id="order-form" class="myform">
							<h3 class="text-center">{{trans('keys.Delivery address')}}</h3>
              <input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="row">
								<div class="col-sm-6 col-xs-12  @if(App::isLocale('ar')) pull-right @endif">
									<div class="form-group">
										<label class="control-label">{{trans('keys.First name')}}</label>
										<input name="first_name" placeholder="{{trans('keys.First name')}}" class="form-control" type="text" required>
									</div>
								</div>
								<div class="col-sm-6 col-xs-12  @if(App::isLocale('ar')) pull-right @endif">
									<div class="form-group">
										<label class="control-label">{{trans('keys.Last Name')}}</label>
										<input name="last_name" placeholder="{{trans('keys.Last Name')}}" class="form-control" type="text" required>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label">{{trans('keys.Email')}}</label>
								<input name="email" placeholder="{{trans('keys.Email')}}" class="form-control" type="email" required>
							</div>
							<div class="form-group">
								<label class="control-label">{{trans('keys.Company')}}</label>
								<input name="Company" placeholder="{{trans('keys.Company')}}" class="form-control" type="text">
							</div>
							<div class="form-group">
								<label class="control-label">{{trans('keys.Address')}}</label>
								<input name="address1" placeholder="{{trans('keys.Address')}}" class="form-control" type="text" required>
							</div>
							<div class="form-group">
								<label class="control-label">{{trans('keys.Address2')}}</label>
								<input name="address2" placeholder="{{trans('keys.Address2')}}" class="form-control" type="text">
							</div>
							<div class="form-group">
								<label class="control-label">{{trans('keys.City')}}</label>
								<input name="city" placeholder="{{trans('keys.City')}}" class="form-control" type="text" required>
							</div>
							<div class="form-group">
								<label class="control-label">{{trans('keys.Postal/ZIP Code')}}</label>
								<input name="zip" placeholder="{{trans('keys.Postal/ZIP Code')}}" class="form-control" type="text">
							</div>
							<div class="form-group">
								<label class="control-label">{{trans('keys.Country')}}</label>
								<!-- <input name="country" placeholder="Country" class="form-control" type="text"> -->
								<select id="country" name="country" class="form-control" tabindex="9" required>
                  <option disabled="disabled" selected="selected" value="">{{trans('keys.Country')}}</option>
                  <option value="Afganistan">{{trans('country.Afghanistan')}}</option>
                  <option value="Albania">{{trans('country.Albania')}}</option>
                  <option value="Algeria">{{trans('country.Algeria')}}</option>
                  <option value="American Samoa">{{trans('country.American Samoa')}}</option>
                  <option value="Andorra">{{trans('country.Andorra')}}</option>
                  <option value="Angola">{{trans('country.Angola')}}</option>
                  <option value="Anguilla">{{trans('country.Anguilla')}}</option>
                  <option value="Antigua &amp; Barbuda">{{trans('country.Antigua Barbuda')}}</option>
                  <option value="Argentina">{{trans('country.Argentina')}}</option>
                  <option value="Armenia">{{trans('country.Armenia')}}</option>
                  <option value="Aruba">{{trans('country.Aruba')}}</option>
                  <option value="Australia">{{trans('country.Australia')}}</option>
                  <option value="Austria">{{trans('country.Austria')}}</option>
                  <option value="Azerbaijan">{{trans('country.Azerbaijan')}}</option>
                  <option value="Bahamas">{{trans('country.Bahamas')}}</option>
                  <option value="Bahrain">{{trans('country.Bahrain')}}</option>
                  <option value="Bangladesh">{{trans('country.Bangladesh')}}</option>
                  <option value="Barbados">{{trans('country.Barbados')}}</option>
                  <option value="Belarus">{{trans('country.Belarus')}}</option>
                  <option value="Belgium">{{trans('country.Belgium')}}</option>
                  <option value="Belize">{{trans('country.Belize')}}</option>
                  <option value="Benin">{{trans('country.Benin')}}</option>
                  <option value="Bermuda">{{trans('country.Bermuda')}}</option>
                  <option value="Bhutan">{{trans('country.Bhutan')}}</option>
                  <option value="Bolivia">{{trans('country.Bolivia')}}</option>
                  <option value="Bonaire">{{trans('country.Bonaire')}}</option>
                  <option value="Bosnia &amp; Herzegovina">{{trans('country.Bosnia Herzegovina')}}</option>
                  <option value="Botswana">{{trans('country.Botswana')}}</option>
                  <option value="Brazil">{{trans('country.Brazil')}}</option>
                  <option value="British Indian Ocean Ter">{{trans('country.British Indian Ocean Ter')}}</option>
                  <option value="Brunei">{{trans('country.Brunei')}}</option>
                  <option value="Bulgaria">{{trans('country.Bulgaria')}}</option>
                  <option value="Burkina Faso">{{trans('country.Burkina Faso')}}</option>
                  <option value="Burundi">{{trans('country.Burundi')}}</option>
                  <option value="Cambodia">{{trans('country.Cambodia')}}</option>
                  <option value="Cameroon">{{trans('country.Cameroon')}}</option>
                  <option value="Canada">{{trans('country.Canada')}}</option>
                  <option value="Canary Islands">{{trans('country.Canary Islands')}}</option>
                  <option value="Cape Verde">{{trans('country.Cape Verde')}}</option>
                  <option value="Cayman Islands">{{trans('country.Cayman Islands')}}</option>
                  <option value="Central African Republic">{{trans('country.Central African Republic')}}</option>
                  <option value="Chad">{{trans('country.Chad')}}</option>
                  <option value="Channel Islands">{{trans('country.Channel Islands')}}</option>
                  <option value="Chile">{{trans('country.Chile')}}</option>
                  <option value="China">{{trans('country.China')}}</option>
                  <option value="Christmas Island">{{trans('country.Christmas Island')}}</option>
                  <option value="Cocos Island">{{trans('country.Cocos Island')}}</option>
                  <option value="Colombia">{{trans('country.Colombia')}}</option>
                  <option value="Comoros">{{trans('country.Comoros')}}</option>
                  <option value="Congo">{{trans('country.Congo')}}</option>
                  <option value="Cook Islands">{{trans('country.Cook Islands')}}</option>
                  <option value="Costa Rica">{{trans('country.Costa Rica')}}</option>
                  <option value="Cote DIvoire">{{trans('country.Cote D\'Ivoire')}}</option>
                  <option value="Croatia">{{trans('country.Croatia')}}</option>
                  <option value="Cuba">{{trans('country.Cuba')}}</option>
                  <option value="Curaco">{{trans('country.Curacao')}}</option>
                  <option value="Cyprus">{{trans('country.Cyprus')}}</option>
                  <option value="Czech Republic">{{trans('country.Czech Republic')}}</option>
                  <option value="Denmark">{{trans('country.Denmark')}}</option>
                  <option value="Djibouti">{{trans('country.Djibouti')}}</option>
                  <option value="Dominica">{{trans('country.Dominica')}}</option>
                  <option value="Dominican Republic">{{trans('country.Dominican Republic')}}</option>
                  <option value="East Timor">{{trans('country.East Timor')}}</option>
                  <option value="Ecuador">{{trans('country.Ecuador')}}</option>
                  <option value="Egypt">{{trans('country.Egypt')}}</option>
                  <option value="El Salvador">{{trans('country.El Salvador')}}</option>
                  <option value="Equatorial Guinea">{{trans('country.Equatorial Guinea')}}</option>
                  <option value="Eritrea">{{trans('country.Eritrea')}}</option>
                  <option value="Estonia">{{trans('country.Estonia')}}</option>
                  <option value="Ethiopia">{{trans('country.Ethiopia')}}</option>
                  <option value="Falkland Islands">{{trans('country.Falkland Islands')}}</option>
                  <option value="Faroe Islands">{{trans('country.Faroe Islands')}}</option>
                  <option value="Fiji">{{trans('country.Fiji')}}</option>
                  <option value="Finland">{{trans('country.Finland')}}</option>
                  <option value="France">{{trans('country.France')}}</option>
                  <option value="French Guiana">{{trans('country.French Guiana')}}</option>
                  <option value="French Polynesia">{{trans('country.French Polynesia')}}</option>
                  <option value="French Southern Ter">{{trans('country.French Southern Ter')}}</option>
                  <option value="Gabon">{{trans('country.Gabon')}}</option>
                  <option value="Gambia">{{trans('country.Gambia')}}</option>
                  <option value="Georgia">{{trans('country.Georgia')}}</option>
                  <option value="Germany">{{trans('country.Germany')}}</option>
                  <option value="Ghana">{{trans('country.Ghana')}}</option>
                  <option value="Gibraltar">{{trans('country.Gibraltar')}}</option>
                  <option value="Great Britain">{{trans('country.Great Britain')}}</option>
                  <option value="Greece">{{trans('country.Greece')}}</option>
                  <option value="Greenland">{{trans('country.Greenland')}}</option>
                  <option value="Grenada">{{trans('country.Grenada')}}</option>
                  <option value="Guadeloupe">{{trans('country.Guadeloupe')}}</option>
                  <option value="Guam">{{trans('country.Guam')}}</option>
                  <option value="Guatemala">{{trans('country.Guatemala')}}</option>
                  <option value="Guinea">{{trans('country.Guinea')}}</option>
                  <option value="Guyana">{{trans('country.Guyana')}}</option>
                  <option value="Haiti">{{trans('country.Haiti')}}</option>
                  <option value="Hawaii">{{trans('country.Hawaii')}}</option>
                  <option value="Honduras">{{trans('country.Honduras')}}</option>
                  <option value="Hong Kong">{{trans('country.Hong Kong')}}</option>
                  <option value="Hungary">{{trans('country.Hungary')}}</option>
                  <option value="Iceland">{{trans('country.Iceland')}}</option>
                  <option value="India">{{trans('country.India')}}</option>
                  <option value="Indonesia">{{trans('country.Indonesia')}}</option>
                  <option value="Iran">{{trans('country.Iran')}}</option>
                  <option value="Iraq">{{trans('country.Iraq')}}</option>
                  <option value="Ireland">{{trans('country.Ireland')}}</option>
                  <option value="Isle of Man">{{trans('country.Isle of Man')}}</option>
                  <option value="Israel">{{trans('country.Israel')}}</option>
                  <option value="Italy">{{trans('country.Italy')}}</option>
                  <option value="Jamaica">{{trans('country.Jamaica')}}</option>
                  <option value="Japan">{{trans('country.Japan')}}</option>
                  <option value="Jordan">{{trans('country.Jordan')}}</option>
                  <option value="Kazakhstan">{{trans('country.Kazakhstan')}}</option>
                  <option value="Kenya">{{trans('country.Kenya')}}</option>
                  <option value="Kiribati">{{trans('country.Kiribati')}}</option>
                  <option value="Korea North">{{trans('country.Korea North')}}</option>
                  <option value="Korea Sout">{{trans('country.Korea South')}}</option>
                  <option value="Kuwait">{{trans('country.Kuwait')}}</option>
                  <option value="Kyrgyzstan">{{trans('country.Kyrgyzstan')}}</option>
                  <option value="Laos">{{trans('country.Laos')}}</option>
                  <option value="Latvia">{{trans('country.Latvia')}}</option>
                  <option value="Lebanon">{{trans('country.Lebanon')}}</option>
                  <option value="Lesotho">{{trans('country.Lesotho')}}</option>
                  <option value="Liberia">{{trans('country.Liberia')}}</option>
                  <option value="Libya">{{trans('country.Libya')}}</option>
                  <option value="Liechtenstein">{{trans('country.Liechtenstein')}}</option>
                  <option value="Lithuania">{{trans('country.Lithuania')}}</option>
                  <option value="Luxembourg">{{trans('country.Luxembourg')}}</option>
                  <option value="Macau">{{trans('country.Macau')}}</option>
                  <option value="Macedonia">{{trans('country.Macedonia')}}</option>
                  <option value="Madagascar">{{trans('country.Madagascar')}}</option>
                  <option value="Malaysia">{{trans('country.Malaysia')}}</option>
                  <option value="Malawi">{{trans('country.Malawi')}}</option>
                  <option value="Maldives">{{trans('country.Maldives')}}</option>
                  <option value="Mali">{{trans('country.Mali')}}</option>
                  <option value="Malta">{{trans('country.Malta')}}</option>
                  <option value="Marshall Islands">{{trans('country.Marshall Islands')}}</option>
                  <option value="Martinique">{{trans('country.Martinique')}}</option>
                  <option value="Mauritania">{{trans('country.Mauritania')}}</option>
                  <option value="Mauritius">{{trans('country.Mauritius')}}</option>
                  <option value="Mayotte">{{trans('country.Mayotte')}}</option>
                  <option value="Mexico">{{trans('country.Mexico')}}</option>
                  <option value="Midway Islands">{{trans('country.Midway Islands')}}</option>
                  <option value="Moldova">{{trans('country.Moldova')}}</option>
                  <option value="Monaco">{{trans('country.Monaco')}}</option>
                  <option value="Mongolia">{{trans('country.Mongolia')}}</option>
                  <option value="Montserrat">{{trans('country.Montserrat')}}</option>
                  <option value="Morocco">{{trans('country.Morocco')}}</option>
                  <option value="Mozambique">{{trans('country.Mozambique')}}</option>
                  <option value="Myanmar">{{trans('country.Myanmar')}}</option>
                  <option value="Nambia">{{trans('country.Nambia')}}</option>
                  <option value="Nauru">{{trans('country.Nauru')}}</option>
                  <option value="Nepal">{{trans('country.Nepal')}}</option>
                  <option value="Netherland Antilles">{{trans('country.Netherland Antilles')}}</option>
                  <option value="Netherlands">{{trans('country.Netherlands (Holland, Europe)')}}</option>
                  <option value="Nevis">{{trans('country.Nevis')}}</option>
                  <option value="New Caledonia">{{trans('country.New Caledonia')}}</option>
                  <option value="New Zealand">{{trans('country.New Zealand')}}</option>
                  <option value="Nicaragua">{{trans('country.Nicaragua')}}</option>
                  <option value="Niger">{{trans('country.Niger')}}</option>
                  <option value="Nigeria">{{trans('country.Nigeria')}}</option>
                  <option value="Niue">{{trans('country.Niue')}}</option>
                  <option value="Norfolk Island">{{trans('country.Norfolk Island')}}</option>
                  <option value="Norway">{{trans('country.Norway')}}</option>
                  <option value="Oman">{{trans('country.Oman')}}</option>
                  <option value="Pakistan">{{trans('country.Pakistan')}}</option>
                  <option value="Palau Island">{{trans('country.Palau Island')}}</option>
                  <option value="Palestine">{{trans('country.Palestine')}}</option>
                  <option value="Panama">{{trans('country.Panama')}}</option>
                  <option value="Papua New Guinea">{{trans('country.Papua New Guinea')}}</option>
                  <option value="Paraguay">{{trans('country.Paraguay')}}</option>
                  <option value="Peru">{{trans('country.Peru')}}</option>
                  <option value="Phillipines">{{trans('country.Philippines')}}</option>
                  <option value="Pitcairn Island">{{trans('country.Pitcairn Island')}}</option>
                  <option value="Poland">{{trans('country.Poland')}}</option>
                  <option value="Portugal">{{trans('country.Portugal')}}</option>
                  <option value="Puerto Rico">{{trans('country.Puerto Rico')}}</option>
                  <option value="Qatar">{{trans('country.Qatar')}}</option>
                  <option value="Republic of Montenegro">{{trans('country.Republic of Montenegro')}}</option>
                  <option value="Republic of Serbia">{{trans('country.Republic of Serbia')}}</option>
                  <option value="Reunion">{{trans('country.Reunion')}}</option>
                  <option value="Romania">{{trans('country.Romania')}}</option>
                  <option value="Russia">{{trans('country.Russia')}}</option>
                  <option value="Rwanda">{{trans('country.Rwanda')}}</option>
                  <option value="St Barthelemy">{{trans('country.St Barthelemy')}}</option>
                  <option value="St Eustatius">{{trans('country.St Eustatius')}}</option>
                  <option value="St Helena">{{trans('country.St Helena')}}</option>
                  <option value="St Kitts-Nevis">{{trans('country.St Kitts-Nevis')}}</option>
                  <option value="St Lucia">{{trans('country.St Lucia')}}</option>
                  <option value="St Maarten">{{trans('country.St Maarten')}}</option>
                  <option value="St Pierre &amp; Miquelon">{{trans('country.St Pierre  Miquelon')}}</option>
                  <option value="St Vincent &amp; Grenadines">{{trans('country.St Vincent Grenadines')}}</option>
                  <option value="Saipan">{{trans('country.Saipan')}}</option>
                  <option value="Samoa">{{trans('country.Samoa')}}</option>
                  <option value="Samoa American">{{trans('country.Samoa American')}}</option>
                  <option value="San Marino">{{trans('country.San Marino')}}</option>
                  <option value="Sao Tome &amp; Principe">{{trans('country.Sao Tome Principe')}}</option>
                  <option value="Saudi Arabia">{{trans('country.Saudi Arabia')}}</option>
                  <option value="Senegal">{{trans('country.Senegal')}}</option>
                  <option value="Serbia">{{trans('country.Serbia')}}</option>
                  <option value="Seychelles">{{trans('country.Seychelles')}}</option>
                  <option value="Sierra Leone">{{trans('country.Sierra Leone')}}</option>
                  <option value="Singapore">{{trans('country.Singapore')}}</option>
                  <option value="Slovakia">{{trans('country.Slovakia')}}</option>
                  <option value="Slovenia">{{trans('country.Slovenia')}}</option>
                  <option value="Solomon Islands">{{trans('country.Solomon Islands')}}</option>
                  <option value="Somalia">{{trans('country.Somalia')}}</option>
                  <option value="South Africa">{{trans('country.South Africa')}}</option>
                  <option value="Spain">{{trans('country.Spain')}}</option>
                  <option value="Sri Lanka">{{trans('country.Sri Lanka')}}</option>
                  <option value="Sudan">{{trans('country.Sudan')}}</option>
                  <option value="Suriname">{{trans('country.Suriname')}}</option>
                  <option value="Swaziland">{{trans('country.Swaziland')}}</option>
                  <option value="Sweden">{{trans('country.Sweden')}}</option>
                  <option value="Switzerland">{{trans('country.Switzerland')}}</option>
                  <option value="Syria">{{trans('country.Syria')}}</option>
                  <option value="Tahiti">{{trans('country.Tahiti')}}</option>
                  <option value="Taiwan">{{trans('country.Taiwan')}}</option>
                  <option value="Tajikistan">{{trans('country.Tajikistan')}}</option>
                  <option value="Tanzania">{{trans('country.Tanzania')}}</option>
                  <option value="Thailand">{{trans('country.Thailand')}}</option>
                  <option value="Togo">{{trans('country.Togo')}}</option>
                  <option value="Tokelau">{{trans('country.Tokelau')}}</option>
                  <option value="Tonga">{{trans('country.Tonga')}}</option>
                  <option value="Trinidad &amp; Tobago">{{trans('country.Trinidad  Tobago')}}</option>
                  <option value="Tunisia">{{trans('country.Tunisia')}}</option>
                  <option value="Turkey">{{trans('country.Turkey')}}</option>
                  <option value="Turkmenistan">{{trans('country.Turkmenistan')}}</option>
                  <option value="Turks &amp; Caicos Is">{{trans('country.Turks Caicos Is')}}</option>
                  <option value="Tuvalu">{{trans('country.Tuvalu')}}</option>
                  <option value="Uganda">{{trans('country.Uganda')}}</option>
                  <option value="Ukraine">{{trans('country.Ukraine')}}</option>
                  <option value="United Arab Erimates">{{trans('country.United Arab Emirates')}}</option>
                  <option value="United Kingdom">{{trans('country.United Kingdom')}}</option>
                  <option value="United States of America">{{trans('country.United States of America')}}</option>
                  <option value="Uraguay">{{trans('country.Uruguay')}}</option>
                  <option value="Uzbekistan">{{trans('country.Uzbekistan')}}</option>
                  <option value="Vanuatu">{{trans('country.Vanuatu')}}</option>
                  <option value="Vatican City State">{{trans('country.Vatican City State')}}</option>
                  <option value="Venezuela">{{trans('country.Venezuela')}}</option>
                  <option value="Vietnam">{{trans('country.Vietnam')}}</option>
                  <option value="Virgin Islands (Brit)">{{trans('country.Virgin Islands (Brit)')}}</option>
                  <option value="Virgin Islands (USA)">{{trans('country.Virgin Islands (USA)')}}</option>
                  <option value="Wake Island">{{trans('country.Wake Island')}}</option>
                  <option value="Wallis &amp; Futana Is">{{trans('country.Wallis Futana Is')}}</option>
                  <option value="Yemen">{{trans('country.Yemen')}}</option>
                  <option value="Zaire">{{trans('country.Zaire')}}</option>
                  <option value="Zambia">{{trans('country.Zambia')}}</option>
                  <option value="Zimbabwe">{{trans('country.Zimbabwe')}}</option>
              </select>

							</div>
							<div class="form-group">
								<label class="control-label">{{trans('keys.State')}}</label>
								<input name="state" placeholder="{{trans('keys.State')}}" class="form-control" type="text">
							</div>
							<div class="form-group">
								<label class="control-label">{{trans('keys.Phone')}}</label>
								<input name="phone" placeholder="{{trans('keys.Phone')}}" class="form-control" type="text">
							</div>
					</div>
					<div class="col-sm-6 col-xs-12 @if(App::isLocale('ar')) pull-left @endif">
							<table class="table">
							  <thead>
								<tr>
								  <th colspan="3" class="text-center">{{trans('keys.You\'re purchasing this')}}…</th>
								</tr>
							  </thead>

							  <tbody>
                  @foreach($cart as $data)
								<tr>
								  <td class="vert-align">@if(App::isLocale('ar')) {{$data->name['name_ar']}} @else {{$data->name['name_en']}} @endif </td>
								  <td class="vert-align">{{$data->quantity}}x</td>
								  <td class="vert-align text-right">{{$data->price * $data->quantity}}</td>
								</tr>
                @endforeach
								<tr>
								  <td class="vert-align"><b>{{trans('keys.Sub total')}}</b></td>
								  <td class="vert-align"></td>
								  <td class="vert-align text-right"><b>{{Cart::getTotal()}}</b></td>
								</tr>
								<tr>
								  <td class="vert-align">{{trans('keys.Shipping cost')}}:</td>
								  <td class="vert-align"></td>
								  <td class="vert-align text-right">0</td>
								</tr>
								<tr>
								  <td class="vert-align">{{trans('keys.total')}}:</td>
								  <td class="vert-align"></td>
								  <td class="vert-align text-right" id="total">{{Cart::getTotal() + 0}}</td>
								</tr>
							  </tbody>
							</table>

							<button type="submit" class="btn btn-right">{{trans('keys.Continue to next step')}}</button>
              </form>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 text-center show-more">
						<a href="{{url('/')}}" class="btn btn-outline">{{trans('keys.Cancel and return to store')}}</a>
					</div>
				</div>

			</div>

		@endsection
