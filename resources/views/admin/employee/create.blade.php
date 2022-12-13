@extends('admin.layout.master')

@section('page-title')
Create Employee
@endsection

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Create Employee
    <small>All * field required</small>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    
    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->
    <form name="formAdd" id="formAdd" method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <!-- row start -->
          <div class="row">
            <div class="col-xs-6">
              <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
                <label for="employee_id">Employee ID <span class="text text-red">*</span></label>
                <input type="text" readonly value="<?php echo $empployeeid+1 ?>" name="employee_id" class="form-control" id="employee_id" required>
                <span class="text-danger">{{-- {{ $errors->first('employee_id') }} --}}</span>
              </div>
              <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
                <label for="name">Full Name <span class="text text-red">*</span></label>
                <input type="text" name="name" class="form-control" id="name" placeholder="full name" required>  
                <span class="text-danger">{{-- {{ $errors->first('name') }} --}}</span>
              </div>
              <div class="form-group {{ $errors->has('dob') ? 'has-error' : null }}">
                <label for="dob">Date of birth: <span class="text text-red">*</span></label>
                <input type="date" name="dob" class="form-control" id="dob" placeholder="Date of Birth" required>
                <span class="text-danger">{{-- {{ $errors->first('dob') }} --}}</span>
              </div>
              
              <div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
                <label for="email">Email <span class="text text-red">*</span></label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                <span class="text-danger">{{-- {{ $errors->first('email') }} --}}</span>
              </div>

              <div class="form-group {{ $errors->has('facebook_id') ? 'has-error' : null }}">
                <label for="facebook_id">Facebook ID</label>
                <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID" required>
              </div>
              
              <div class="form-group {{ $errors->has('linkedin_id') ? 'has-error' : null }}">
                <label for="linkedin_id">LinkedIn ID</label>
                <input type="text" name="linkedin_id" class="form-control" id="linkedin_id" placeholder="LinkedIn ID" required>
              </div>

              <div class="form-group {{ $errors->has('country') ? 'has-error' : null }}">
                <label>Country <span class="text text-red">*</span></label>
                  <select name="country" id="country" class="form-control select2" style="width: 100%;" required>
                    <option value="none">-- Select Country --</option>
                    <option value="Afganistan">Afghanistan</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bonaire">Bonaire</option>
                    <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                    <option value="Brunei">Brunei</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Canary Islands">Canary Islands</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Channel Islands">Channel Islands</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos Island">Cocos Island</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cote DIvoire">Cote DIvoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Curaco">Curacao</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="East Timor">East Timor</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="Falkland Islands">Falkland Islands</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Ter">French Southern Ter</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia">Gambia</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Great Britain">Great Britain</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Hawaii">Hawaii</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong">Hong Kong</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="India">India</option>
                    <option value="Iran">Iran</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Isle of Man">Isle of Man</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea North">Korea North</option>
                    <option value="Korea Sout">Korea South</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Laos">Laos</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libya">Libya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macau">Macau</option>
                    <option value="Macedonia">Macedonia</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Midway Islands">Midway Islands</option>
                    <option value="Moldova">Moldova</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar">Myanmar</option>
                    <option value="Nambia">Nambia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherland Antilles">Netherland Antilles</option>
                    <option value="Netherlands">Netherlands (Holland, Europe)</option>
                    <option value="Nevis">Nevis</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau Island">Palau Island</option>
                    <option value="Palestine">Palestine</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Phillipines">Philippines</option>
                    <option value="Pitcairn Island">Pitcairn Island</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Republic of Montenegro">Republic of Montenegro</option>
                    <option value="Republic of Serbia">Republic of Serbia</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russia">Russia</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="St Barthelemy">St Barthelemy</option>
                    <option value="St Eustatius">St Eustatius</option>
                    <option value="St Helena">St Helena</option>
                    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                    <option value="St Lucia">St Lucia</option>
                    <option value="St Maarten">St Maarten</option>
                    <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                    <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                    <option value="Saipan">Saipan</option>
                    <option value="Samoa">Samoa</option>
                    <option value="Samoa American">Samoa American</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syria">Syria</option>
                    <option value="Tahiti">Tahiti</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania">Tanzania</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Erimates">United Arab Emirates</option>
                    <option value="United States of America">United States of America</option>
                    <option value="Uraguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Vatican City State">Vatican City State</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                    <option value="Wake Island">Wake Island</option>
                    <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zaire">Zaire</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                  </select>
              </div>
              <div class="form-group  {{ $errors->has('phone') ? 'has-error' : null }}">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required>
              </div>
              
              <div class="form-group  {{ $errors->has('address') ? 'has-error' : null }}">
                <label>Address</label>
                <textarea name="address" id="address" class="form-control" rows="5" placeholder="Enter ..." required></textarea>
              </div>


              
              
            </div>
            
            <div class="col-xs-6">
              <div class="form-group {{ $errors->has('joining_date') ? 'has-error' : null }}">
                <label for="joining_date">Joining Date <span class="text text-red">*</span></label>
                <input type="date" name="joining_date" class="form-control" id="joining_date" placeholder="joining date" required>
                <span class="text-danger">{{-- {{ $errors->first('joining_date') }} --}}</span>
              </div>
              <div class="form-group {{ $errors->has('time_schedule') ? 'has-error' : null }}">
                <label>Time Schedule <span class="text text-red">*</span></label>
                <select name="time_schedule" id="time_schedule" class="form-control select2" style="width: 100%;" required>
                  <option value="none">-- Select Time Schedule --</option>
                  @foreach($timeSchedules as $timeSchedule)
                  <option value="{{ $timeSchedule->time_schedule }}">{{$timeSchedule->time_schedule}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group {{ $errors->has('departments') ? 'has-error' : null }}">
                <label>Department <span class="text text-red">*</span></label>
                <select name="departments" id="departments" class="form-control select2" style="width: 100%;" required>
                  <option value="none">-- Select Department --</option>
                  @foreach($departments as $department)
                  <option value="{{ $department->departments }}">{{$department->departments}}</option>
                  @endforeach
                </select>

              </div>
              <div class="form-group {{ $errors->has('shift') ? 'has-error' : null }}">
                <label>Shifts <span class="text text-red">*</span></label>
                <select name="shift" id="shift" class="form-control select2" style="width: 100%;" required>
                  <option value="none">-- Select Shift --</option>
                  @foreach($shiftss as $shift)
                  <option value="{{ $shift->shifts }}">{{$shift->shifts}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group {{ $errors->has('gender') ? 'has-error' : null }}">
                <label>Gender <span class="text text-red">*</span></label>
                <select name="gender" id="gender" class="form-control select2" style="width: 100%;" required>
                  <option value="none">-- Select Gender --</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
              <div class="form-group {{ $errors->has('merital') ? 'has-error' : null }}">
                <label>Marital Status <span class="text text-red">*</span></label>
                <select name="merital" id="merital" class="form-control select2" style="width: 100%;" required>
                  <option value="none">-- Select Merital Status --</option>
                  <option value="married">Married</option>
                  <option value="single">Single</option>
                </select>

              </div>
              
              
              <div class="form-group {{ $errors->has('employee_img') ? 'has-error' : null }}">
                <label for="employee_img">Employee Image <span class="text text-red">*</span></label>
                <input type="file" name="employee_img" class="form-control" id="employee_img" multiple required>
                <span class="text-danger">{{ $errors->first('employee_img') }}</span>
              </div>
              <div class="form-group  {{ $errors->has('salary') ? 'has-error' : null }}">
                <label for="salary">Salary</label>
                <input type="text" name="salary" class="form-control" id="salary" placeholder="Salary" required>
              </div>
              

              <div class="form-group {{ $errors->has('admin') ? 'has-error' : null }}">
                <label>Admin</label>
                <select name="admin" id="admin" class="form-control select2" style="width: 100%;" required>
                  <option value="0">NO</option>
                  <option value="1">YES</option>
                </select>
              </div>
              <div class="form-group {{ $errors->has('role') ? 'has-error' : null }}">
                <label>Role</label>
                <select name="role" id="role" class="form-control select3" style="width: 100%;" required>
                  <option>:: Select Role ::</option>
                  <option value="Admin">Admin</option>
                  <option value="Project Manager">Project Manager</option>
                  <option value="Internal Project Manager">Internal Project Manager</option>
                  <option value="Team Lead">Team Lead</option>
                  <option value="Employee">Employee</option>
                </select>
              </div>

              <div class="form-group  {{ $errors->has('password') ? 'has-error' : null }}">
                <label for="password">Password</label>
                <input type="text" name="password" class="form-control" id="password" placeholder="Password" required>
              </div>
              
              
              {{-- <div class="form-group">
                <label>Author Feature</label>
                <select name="author_feature" id="author_feature" class="form-control select2" style="width: 100%;">
                  <option value="no">NO</option>
                  <option value="yes">Yes</option>
                </select>
              </div> --}}
            </div>
          </div>
          
          <!-- row end -->
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-danger">Cancel</button>
        </div>
      </div>

    </form>
    <!-- /.box -->
    
    <!-- form end -->
    
  </section>
  @endsection