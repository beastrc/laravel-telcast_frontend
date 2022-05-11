@extends('layouts.advertiser.campaign.app')
@section('content')
 
<div class="container">
    <div class="tab-content">
        <form method="post" action="{{ url('savecampaign') }}" enctype="multipart/form-data">
            @csrf
            <div class="tab-pane container active" id="step1" style="display:block;">
                <h4 class="text-center mb-4 beast_subtitle" >Let's create your video ad</h4>
                <div class="row">
                    <div class="col-7">
                        <fieldset class="mb-4">
                            <label class="font-weight-bold text-white">Campaign Title</label>
                            <input type="text" class="form-control h-auto text-black beast_input" id="title" name="title" placeholder="Enter title for ad campaign" required>
                            <div class="alert alert-secondary" style="display:none;" id="alert_name">
                                <i class='fas fa-exclamation'></i>&nbsp;&nbsp; Type Your Name.
                            </div>
                        </fieldset>
                        <!-- <fieldset class="mb-4">
                            <label class="font-weight-bold text-black">Ad Video</label>
                            <select class="custom-select custom-select-lg select-select2 video" name="video"></select>
                        </fieldset> -->
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="ishave" name="darkmode" value="yes" >
                            <label class="form-check-label text-white" for="ishave">Do you have your Telcast Video?</label>
                        </div>
                        <div>
                            <div id="no" style="display:block;">
                                <fieldset class="mb-4">
                                    <label class="font-weight-bold text-white">
                                        How do you want your ad to show on Telcast?
                                    </label>
                                    <div class="custom-control custom-radio mb-3">
                                        <div class="d-flex ">
                                            <div class="col-12 col-md-5">
                                                <div class="uploader" >
                                                    <img id="uploadimg" src="{{ asset('images/upload.png') }}" style="display:block; width: 50%; height:auto;" onclick="openfile()"></img>
                                                    <input required type="file" id="video" name="video" accept="video/*,image/*" onchange="onChangePostFile(event)" hidden/>
                                                    <img id="preview_image" style="display: none;" />
                                                    <video preload="true" id="preview_video" width="320" height="240" style="display: none;" controls></video>
                                                </div>
                                            </div>
                                            <div class="alert alert-secondary" style="display:none;" id="alert_video">
                                                <i class='fas fa-exclamation'></i>&nbsp;&nbsp; Upload Your Video.
                                            </div>                                            
                                        </div>
                                        <br>
                                        <input type="radio" id="format-1" name="format" value="1" class="custom-control-input">
                                        <label class="custom-control-label text-white" for="format-1">
                                            Automatically played before, during or after other Telcast videos
                                            <div class="text-muted text-white">Best for driving traffic to an external website </div>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="format-2" name="format" value="2" class="custom-control-input disabled" >
                                        <label class="custom-control-label text-white" for="format-2">
                                            Placed as a thumbnail next to related videos
                                            <div class="text-muted text-white">Best for driving traffic to the ad's video page </div>
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                            <div id="yes" style="display:none;">
                                <fieldset class="mb-4">
                                    <label class="font-weight-bold text-white">After viewers click your ad, where do you want to send them?</label>
                                    <input type="url" id="videourl" class="form-control h-auto text-white" name="url" placeholder="Enter url of the landing page starting with http:// or https://">
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <label class="font-weight-bold text-white">Ad Preview</label>
                        <div class="rounded overflow-hidden" style="height: 400px; background-color: #404040; ">
                            <ul class="nav nav-tabs m-0" id="preview-responsive">
                                <li class="nav-item">
                                    <a class="nav-link active beast_tab" id="mobile-tab" data-toggle="tab" href="#mobile">Mobile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link beast_tab" id="desktop-tab" data-toggle="tab"
                                       href="#desktop">Desktop</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade px-5 py-3 show active" id="mobile">
                                    <div class="preview-format-1" style="display: none;">
                                        <div></div>
                                        <main class="border border-secondary" style="height: 400px;border-top-left-radius: 50px;border-top-right-radius: 50px;">
                                            <div class="bg-white d-flex justify-content-center align-items-center w-100" style="height: 50px;border-top-left-radius: 50px;border-top-right-radius: 50px;">
                                                <div style="width: 30px;height: 8px;border: 2px solid;border-radius: 25px;"></div>
                                            </div>
                                            <div style="height: calc(100% - 50px);"
                                                 class="m-3 rounded bg-white border">
                                                <div class="position-relative" style="height: 180px;border-radius: inherit;">
                                                    <img class="thumbnail w-100 h-100" style="border-radius: inherit;">
                                                    <div class="bg-secondary text-light py-0 px-2 small" style="position: absolute;bottom: 40px;right: 0;">
                                                        Skip Ad
                                                    </div>
                                                    <div class="bg-secondary w-100"
                                                         style="height: 8px;position: absolute;bottom: 0;"></div>
                                                    <div class="bg-warning w-25"
                                                         style="height: 8px;position: absolute;bottom: 0;"></div>
                                                </div>
                                                <div style="height: 30px;"
                                                     class="d-flex align-items-center justify-content-between border-bottom px-2 py-3">
                                                    <div class="d-flex align-items-center w-75">
                                                        <div class="bg-secondary mr-1"
                                                             style="height: 25px;width: 30px;border-radius: 50%;"></div>
                                                        <div class="h-100 w-100">
                                                            <div class="bg-secondary w-50 mb-1"
                                                                 style="height: 10px;"></div>
                                                            <div class="bg-secondary w-25"
                                                                 style="height: 5px;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-end"><i class="fas fa-ellipsis-v"></i></div>
                                                </div>
                                                <div class="p-3" style="height: 10px;">
                                                    <div class="bg-secondary w-75 mb-2" style="height: 20px;"></div>
                                                    <div class="bg-secondary w-25 mb-1" style="height: 20px;"></div>
                                                </div>
                                            </div>
                                        </main>
                                    </div>
                                </div>
                                <div class="tab-pane fade p-3" id="desktop">
                                    <div class="preview-format-1" style="display: none;">
                                        <nav class="navbar bg-secondary p-0 px-3">
                                            <small class="text-light">Telcast</small>
                                        </nav>
                                        <main class="row mx-0" style="height: 200px;">
                                            <div class="col-7 py-3 px-0">
                                                <div class="border mb-3 position-relative" style="height: 120px;">
                                                    <img class="thumbnail w-100 h-100">
                                                    <div class="bg-secondary text-light py-0 px-2 small"
                                                         style="position: absolute;bottom: 10px;right: 0;">
                                                        Skip Ad
                                                    </div>
                                                    <div class="bg-secondary w-100"
                                                         style="height: 2px;position: absolute;bottom: 0;"></div>
                                                    <div class="bg-warning w-25"
                                                         style="height: 2px;position: absolute;bottom: 0;"></div>
                                                </div>
                                                <div class="bg-secondary w-75 mb-1" style="height: 15px;"></div>
                                                <div class="row mx-0" style="height: 25px;">
                                                    <div class="col-1 bg-secondary"></div>
                                                    <div class="col-8 pl-1 pr-0" style="height: 10px;">
                                                        <div class="bg-secondary w-50 mb-1" style="height: 5px;"></div>
                                                        <div class="bg-secondary w-50 mb-1" style="height: 5px;"></div>
                                                        <div class="bg-secondary w-25 mb-1" style="height: 5px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-5 py-3 pr-0">
                                                <div class="row mx-0 border p-1 mb-1" style="height: 50px;">
                                                    <div class="col-4 bg-secondary"></div>
                                                    <div class="col-8 pl-1 pr-0" style="height: 10px;">
                                                        <div class="bg-secondary mb-1" style="height: 10px;"></div>
                                                        <div class="bg-secondary w-75 mb-1" style="height: 10px;"></div>
                                                        <div class="bg-secondary w-50" style="height: 10px;"></div>
                                                    </div>
                                                </div>
                                                <div class="row mx-0 border p-1 mb-1" style="height: 50px;">
                                                    <div class="col-4 bg-secondary"></div>
                                                    <div class="col-8 pl-1 pr-0" style="height: 10px;">
                                                        <div class="bg-secondary mb-1" style="height: 10px;"></div>
                                                        <div class="bg-secondary w-75 mb-1"
                                                             style="height: 10px;"></div>
                                                        <div class="bg-secondary w-50" style="height: 10px;"></div>
                                                    </div>
                                                </div>
                                                <div class="row mx-0 border p-1 mb-1" style="height: 50px;">
                                                    <div class="col-4 bg-secondary"></div>
                                                    <div class="col-8 pl-1 pr-0" style="height: 10px;">
                                                        <div class="bg-secondary mb-1" style="height: 10px;"></div>
                                                        <div class="bg-secondary w-75 mb-1"
                                                             style="height: 10px;"></div>
                                                        <div class="bg-secondary w-50" style="height: 10px;"></div>
                                                    </div>
                                                </div>
                                                <div class="row mx-0 border p-1" style="height: 50px;">
                                                    <div class="col-4 bg-secondary"></div>
                                                    <div class="col-8 pl-1 pr-0" style="height: 10px;">
                                                        <div class="bg-secondary mb-1" style="height: 10px;"></div>
                                                        <div class="bg-secondary w-75 mb-1"
                                                             style="height: 10px;"></div>
                                                        <div class="bg-secondary w-50" style="height: 10px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </main>
                                    </div>
                                    <div class="preview-format-2" style="display: none;">
                                        <nav class="navbar bg-secondary p-0 px-3">
                                            <small class="text-light">Telcast</small>
                                        </nav>
                                        <main class="row mx-0" style="height: 200px;">
                                            <div class="col-7 py-3 px-0">
                                                <div class="border mb-3 position-relative"
                                                     style="height: 120px;background: lightgrey;">
                                                    <div class="w-100" style="height: 5px;position: absolute;bottom: 15px;background: darkgray;"></div>
                                                    <div class="w-25" style="height: 5px;position: absolute;bottom: 15px;background: #86c240;"></div>
                                                    <div class="bg-secondary w-100" style="height: 15px;position: absolute;bottom: 0;">
                                                        <div class="d-flex justify-content-between align-items-center h-100">
                                                            <div class="h-100 d-flex flex-column justify-content-center">
                                                                <i class="fas fa-play-circle text-light fa-xs pl-1 h-auto"></i>
                                                            </div>
                                                            <div class="h-100 d-flex flex-column justify-content-center">
                                                                <i class="fas fa-expand text-light fa-xs mr-1"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-secondary w-75 mb-1" style="height: 15px;"></div>
                                                <div class="row mx-0" style="height: 25px;">
                                                    <div class="col-1 bg-secondary"></div>
                                                    <div class="col-8 pl-1 pr-0" style="height: 10px;">
                                                        <div class="bg-secondary w-50 mb-1" style="height: 5px;"></div>
                                                        <div class="bg-secondary w-50 mb-1" style="height: 5px;"></div>
                                                        <div class="bg-secondary w-25 mb-1" style="height: 5px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-5 py-3 pr-0">
                                                <div class="d-flex">
                                                    <div class="position-relative">
                                                        <img class="thumbnail" style="height: 40px;width: 70px;object-fit: contain;">
                                                        <div class="text-light time" style="position: absolute;bottom: 2px;right: 3px;font-size: 10px;line-height: normal;">
                                                            05:30
                                                        </div>
                                                    </div>
                                                    <div class="pl-1 pr-0 d-flex flex-column justify-content-between">
                                                        <div class="d-block text-wrap font-weight-bold" style="font-size: 8px;line-height: normal;">Your video ad title goes here
                                                        </div>
                                                        <div style="font-size: 8px;line-height: normal;">Oberlo </div>
                                                        <div style="line-height: normal;font-size: 8px;">167K views </div>
                                                    </div>
                                                </div>
                                                <hr class="my-2 border-top">
                                                <div class="row mx-0 border p-1 mb-1" style="height: 50px;">
                                                    <div class="col-4 bg-secondary"></div>
                                                    <div class="col-8 pl-1 pr-0" style="height: 10px;">
                                                        <div class="bg-secondary mb-1" style="height: 10px;"></div>
                                                        <div class="bg-secondary w-75 mb-1" style="height: 10px;"></div>
                                                        <div class="bg-secondary w-50" style="height: 10px;"></div>
                                                    </div>
                                                </div>
                                                <div class="row mx-0 border p-1 mb-1" style="height: 50px;">
                                                    <div class="col-4 bg-secondary"></div>
                                                    <div class="col-8 pl-1 pr-0" style="height: 10px;">
                                                        <div class="bg-secondary mb-1" style="height: 10px;"></div>
                                                        <div class="bg-secondary w-75 mb-1"
                                                             style="height: 10px;"></div>
                                                        <div class="bg-secondary w-50" style="height: 10px;"></div>
                                                    </div>
                                                </div>
                                                <div class="row mx-0 border p-1" style="height: 50px;">
                                                    <div class="col-4 bg-secondary"></div>
                                                    <div class="col-8 pl-1 pr-0" style="height: 10px;">
                                                        <div class="bg-secondary mb-1" style="height: 10px;"></div>
                                                        <div class="bg-secondary w-75 mb-1" style="height: 10px;"></div>
                                                        <div class="bg-secondary w-50" style="height: 10px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </main>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane container fade" id="step2" style="display:none;">
                <h4 class="text-center mb-4 beast_subtitle">Next, choose the locations and languages of your customers</h4>
                <div class="row">
                    <div class="col-7">
                        <fieldset class="mb-4">
                            <label class="text-white">{{ __('Where are your customers located?') }}</label>
                            <select class="selectpicker" multiple data-live-search="true"  id="countries" name="countries" >
                                <option value="Afghanistan" countryid="AF">Afghanistan</option>
                                <option value="Albania" countryid="AL">Albania</option>
                                <option value="Algeria" countryid="DZ">Algeria</option>
                                <option value="Andorra" countryid="AD">Andorra</option>
                                <option value="Angola" countryid="AO">Angola</option>
                                <option value="Anguilla" countryid="AI">Anguilla</option>
                                <option value="Antigua and Barbuda" countryid="AG">Antigua and Barbuda</option>
                                <option value="Argentina" countryid="AR">Argentina</option>
                                <option value="Armenia" countryid="AM">Armenia</option>
                                <option value="Australia" countryid="AU">Australia</option>
                                <option value="Austria" countryid="AT">Austria</option>
                                <option value="Azerbaijan" countryid="AZ">Azerbaijan</option>
                                <option value="Bahamas" countryid="BS">Bahamas</option>
                                <option value="Bahrain" countryid="BH">Bahrain</option>
                                <option value="Bangladesh" countryid="BD">Bangladesh</option>
                                <option value="Barbados" countryid="BB">Barbados</option>
                                <option value="Belarus" countryid="BY">Belarus</option>
                                <option value="Belgium" countryid="BE">Belgium</option>
                                <option value="Belize" countryid="BZ">Belize</option>
                                <option value="Benin" countryid="BJ">Benin</option>
                                <option value="Bermuda" countryid="BM">Bermuda</option>
                                <option value="Bhutan" countryid="BT">Bhutan</option>
                                <option value="Bolivia" countryid="BO">Bolivia</option>
                                <option value="Bosnia and Herzegovina" countryid="BA">Bosnia and Herzegovina
                                </option>
                                <option value="Botswana" countryid="BW">Botswana</option>
                                <option value="Brazil" countryid="BR">Brazil</option>
                                <option value="Brunei Darussalam" countryid="BN">Brunei Darussalam</option>
                                <option value="Bulgaria" countryid="BG">Bulgaria</option>
                                <option value="Burkina Faso" countryid="BF">Burkina Faso</option>
                                <option value="Burundi" countryid="BI">Burundi</option>
                                <option value="Cambodia" countryid="KH">Cambodia</option>
                                <option value="Cameroon" countryid="CM">Cameroon</option>
                                <option value="Canada" countryid="CA">Canada</option>
                                <option value="Cape Verde" countryid="CV">Cape Verde</option>
                                <option value="Cayman Islands" countryid="KY">Cayman Islands</option>
                                <option value="Central African Republic" countryid="CF">Central African Republic
                                </option>
                                <option value="Chad" countryid="TD">Chad</option>
                                <option value="Chile" countryid="CL">Chile</option>
                                <option value="China" countryid="CN">China</option>
                                <option value="Colombia" countryid="CO">Colombia</option>
                                <option value="Comoros" countryid="KM">Comoros</option>
                                <option value="Congo" countryid="CG">Congo</option>
                                <option value="Costa Rica" countryid="CR">Costa Rica</option>
                                <option value="Croatia (Hrvatska)" countryid="HR">Croatia (Hrvatska)</option>
                                <option value="Cuba" countryid="CU">Cuba</option>
                                <option value="Cyprus" countryid="CY">Cyprus</option>
                                <option value="Czech Republic" countryid="CZ">Czech Republic</option>
                                <option value="Denmark" countryid="DK">Denmark</option>
                                <option value="Djibouti" countryid="DJ">Djibouti</option>
                                <option value="Dominica" countryid="DM">Dominica</option>
                                <option value="Dominican Republic" countryid="DO">Dominican Republic</option>
                                <option value="Ecuador" countryid="EC">Ecuador</option>
                                <option value="Egypt" countryid="EG">Egypt</option>
                                <option value="El Salvador" countryid="SV">El Salvador</option>
                                <option value="Equatorial Guinea" countryid="GQ">Equatorial Guinea</option>
                                <option value="Eritrea" countryid="ER">Eritrea</option>
                                <option value="Estonia" countryid="EE">Estonia</option>
                                <option value="Ethiopia" countryid="ET">Ethiopia</option>
                                <option value="Faroe Islands" countryid="FO">Faroe Islands</option>
                                <option value="Fiji" countryid="FJ">Fiji</option>
                                <option value="Finland" countryid="FI">Finland</option>
                                <option value="France" countryid="FR">France</option>
                                <option value="French Guiana" countryid="GF">French Guiana</option>
                                <option value="French Polynesia" countryid="PF">French Polynesia</option>
                                <option value="French Southern Territories" countryid="TF">French Southern
                                    Territories
                                </option>
                                <option value="Gabon" countryid="GA">Gabon</option>
                                <option value="Gambia" countryid="GM">Gambia</option>
                                <option value="Georgia" countryid="GE">Georgia</option>
                                <option value="Germany" countryid="DE">Germany</option>
                                <option value="Ghana" countryid="GH">Ghana</option>
                                <option value="Greece" countryid="GR">Greece</option>
                                <option value="Greenland" countryid="GL">Greenland</option>
                                <option value="Grenada" countryid="GD">Grenada</option>
                                <option value="Guadeloupe" countryid="GP">Guadeloupe</option>
                                <option value="Guam" countryid="GU">Guam</option>
                                <option value="Guatemala" countryid="GT">Guatemala</option>
                                <option value="Guinea" countryid="GN">Guinea</option>
                                <option value="Guinea-Bissau" countryid="GW">Guinea-Bissau</option>
                                <option value="Guyana" countryid="GY">Guyana</option>
                                <option value="Haiti" countryid="HT">Haiti</option>
                                <option value="Honduras" countryid="HN">Honduras</option>
                                <option value="Hong Kong" countryid="HK">Hong Kong</option>
                                <option value="Hungary" countryid="HU">Hungary</option>
                                <option value="Iceland" countryid="IS">Iceland</option>
                                <option value="India" countryid="IN">India</option>
                                <option value="Isle of Man" countryid="IM">Isle of Man</option>
                                <option value="Indonesia" countryid="ID">Indonesia</option>
                                <option value="Iran" countryid="IR">Iran</option>
                                <option value="Iraq" countryid="IQ">Iraq</option>
                                <option value="Ireland" countryid="IE">Ireland</option>
                                <option value="Israel" countryid="IL">Israel</option>
                                <option value="Italy" countryid="IT">Italy</option>
                                <option value="Ivory Coast" countryid="CI">Ivory Coast</option>
                                <option value="Jersey" countryid="JE">Jersey</option>
                                <option value="Jamaica" countryid="JM">Jamaica</option>
                                <option value="Japan" countryid="JP">Japan</option>
                                <option value="Jordan" countryid="JO">Jordan</option>
                                <option value="Kazakhstan" countryid="KZ">Kazakhstan</option>
                                <option value="Kenya" countryid="KE">Kenya</option>
                                <option value="Kiribati" countryid="KI">Kiribati</option>
                                <option value="North Korea" countryid="KP">North Korea</option>
                                <option value="South Korea" countryid="KR">South Korea</option>
                                <option value="Kosovo" countryid="XK">Kosovo</option>
                                <option value="Kuwait" countryid="KW">Kuwait</option>
                                <option value="Kyrgyzstan" countryid="KG">Kyrgyzstan</option>
                                <option value="Lao" countryid="LA">Lao</option>
                                <option value="Latvia" countryid="LV">Latvia</option>
                                <option value="Lebanon" countryid="LB">Lebanon</option>
                                <option value="Lesotho" countryid="LS">Lesotho</option>
                                <option value="Liberia" countryid="LR">Liberia</option>
                                <option value="Libyan Arab Jamahiriya" countryid="LY">Libyan Arab Jamahiriya
                                </option>
                                <option value="Liechtenstein" countryid="LI">Liechtenstein</option>
                                <option value="Lithuania" countryid="LT">Lithuania</option>
                                <option value="Luxembourg" countryid="LU">Luxembourg</option>
                                <option value="Macedonia" countryid="MK">Macedonia</option>
                                <option value="Madagascar" countryid="MG">Madagascar</option>
                                <option value="Malawi" countryid="MW">Malawi</option>
                                <option value="Malaysia" countryid="MY">Malaysia</option>
                                <option value="Maldives" countryid="MV">Maldives</option>
                                <option value="Mali" countryid="ML">Mali</option>
                                <option value="Malta" countryid="MT">Malta</option>
                                <option value="Marshall Islands" countryid="MH">Marshall Islands</option>
                                <option value="Martinique" countryid="MQ">Martinique</option>
                                <option value="Mauritania" countryid="MR">Mauritania</option>
                                <option value="Mauritius" countryid="MU">Mauritius</option>
                                <option value="Mexico" countryid="MX">Mexico</option>
                                <option value="Micronesia, Federated States of" countryid="FM">Micronesia, Federated
                                    States of
                                </option>
                                <option value="Moldova, Republic of" countryid="MD">Moldova, Republic of</option>
                                <option value="Monaco" countryid="MC">Monaco</option>
                                <option value="Mongolia" countryid="MN">Mongolia</option>
                                <option value="Montenegro" countryid="ME">Montenegro</option>
                                <option value="Montserrat" countryid="MS">Montserrat</option>
                                <option value="Morocco" countryid="MA">Morocco</option>
                                <option value="Mozambique" countryid="MZ">Mozambique</option>
                                <option value="Myanmar" countryid="MM">Myanmar</option>
                                <option value="Namibia" countryid="NA">Namibia</option>
                                <option value="Nauru" countryid="NR">Nauru</option>
                                <option value="Nepal" countryid="NP">Nepal</option>
                                <option value="Netherlands" countryid="NL">Netherlands</option>
                                <option value="Netherlands Antilles" countryid="AN">Netherlands Antilles</option>
                                <option value="New Caledonia" countryid="NC">New Caledonia</option>
                                <option value="New Zealand" countryid="NZ">New Zealand</option>
                                <option value="Nicaragua" countryid="NI">Nicaragua</option>
                                <option value="Niger" countryid="NE">Niger</option>
                                <option value="Nigeria" countryid="NG">Nigeria</option>
                                <option value="Northern Mariana Islands" countryid="MP">Northern Mariana Islands
                                </option>
                                <option value="Norway" countryid="NO">Norway</option>
                                <option value="Oman" countryid="OM">Oman</option>
                                <option value="Pakistan" countryid="PK">Pakistan</option>
                                <option value="Palau" countryid="PW">Palau</option>
                                <option value="Palestine" countryid="PS">Palestine</option>
                                <option value="Panama" countryid="PA">Panama</option>
                                <option value="Papua New Guinea" countryid="PG">Papua New Guinea</option>
                                <option value="Paraguay" countryid="PY">Paraguay</option>
                                <option value="Peru" countryid="PE">Peru</option>
                                <option value="Philippines" countryid="PH">Philippines</option>
                                <option value="Poland" countryid="PL">Poland</option>
                                <option value="Portugal" countryid="PT">Portugal</option>
                                <option value="Puerto Rico" countryid="PR">Puerto Rico</option>
                                <option value="Qatar" countryid="QA">Qatar</option>
                                <option value="Reunion" countryid="RE">Reunion</option>
                                <option value="Romania" countryid="RO">Romania</option>
                                <option value="Russian Federation" countryid="RU">Russian Federation</option>
                                <option value="Rwanda" countryid="RW">Rwanda</option>
                                <option value="Saint Kitts and Nevis" countryid="KN">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia" countryid="LC">Saint Lucia</option>
                                <option value="Saint Vincent and the Grenadines" countryid="VC">Saint Vincent and
                                    the Grenadines
                                </option>
                                <option value="Samoa" countryid="WS">Samoa</option>
                                <option value="San Marino" countryid="SM">San Marino</option>
                                <option value="Sao Tome and Principe" countryid="ST">Sao Tome and Principe</option>
                                <option value="Saudi Arabia" countryid="SA">Saudi Arabia</option>
                                <option value="Senegal" countryid="SN">Senegal</option>
                                <option value="Serbia" countryid="RS">Serbia</option>
                                <option value="Seychelles" countryid="SC">Seychelles</option>
                                <option value="Sierra Leone" countryid="SL">Sierra Leone</option>
                                <option value="Singapore" countryid="SG">Singapore</option>
                                <option value="Slovakia" countryid="SK">Slovakia</option>
                                <option value="Slovenia" countryid="SI">Slovenia</option>
                                <option value="Solomon Islands" countryid="SB">Solomon Islands</option>
                                <option value="Somalia" countryid="SO">Somalia</option>
                                <option value="South Africa" countryid="ZA">South Africa</option>
                                <option value="Spain" countryid="ES">Spain</option>
                                <option value="Sri Lanka" countryid="LK">Sri Lanka</option>
                                <option value="St. Helena" countryid="SH">St. Helena</option>
                                <option value="St. Pierre and Miquelon" countryid="PM">St. Pierre and Miquelon
                                </option>
                                <option value="Sudan" countryid="SD">Sudan</option>
                                <option value="Suriname" countryid="SR">Suriname</option>
                                <option value="Svalbard and Jan Mayen Islands" countryid="SJ">Svalbard and Jan Mayen
                                    Islands
                                </option>
                                <option value="Swaziland" countryid="SZ">Swaziland</option>
                                <option value="Sweden" countryid="SE">Sweden</option>
                                <option value="Switzerland" countryid="CH">Switzerland</option>
                                <option value="Syrian Arab Republic" countryid="SY">Syrian Arab Republic</option>
                                <option value="Taiwan" countryid="TW">Taiwan</option>
                                <option value="Tajikistan" countryid="TJ">Tajikistan</option>
                                <option value="Tanzania" countryid="TZ">Tanzania</option>
                                <option value="Thailand" countryid="TH">Thailand</option>
                                <option value="Togo" countryid="TG">Togo</option>
                                <option value="Tokelau" countryid="TK">Tokelau</option>
                                <option value="Tonga" countryid="TO">Tonga</option>
                                <option value="Trinidad and Tobago" countryid="TT">Trinidad and Tobago</option>
                                <option value="Tunisia" countryid="TN">Tunisia</option>
                                <option value="Turkey" countryid="TR">Turkey</option>
                                <option value="Turkmenistan" countryid="TM">Turkmenistan</option>
                                <option value="Tuvalu" countryid="TV">Tuvalu</option>
                                <option value="Uganda" countryid="UG">Uganda</option>
                                <option value="Ukraine" countryid="UA">Ukraine</option>
                                <option value="United Arab Emirates" countryid="AE">United Arab Emirates</option>
                                <option value="United Kingdom" countryid="GB">United Kingdom</option>
                                <option value="United States" countryid="US">United States</option>
                                <option value="United States minor outlying islands" countryid="UM">United States
                                    minor outlying islands
                                </option>
                                <option value="Uruguay" countryid="UY">Uruguay</option>
                                <option value="Uzbekistan" countryid="UZ">Uzbekistan</option>
                                <option value="Vanuatu" countryid="VU">Vanuatu</option>
                                <option value="Venezuela" countryid="VE">Venezuela</option>
                                <option value="Vietnam" countryid="VN">Vietnam</option>
                                <option value="Virgin Islands (U.S.)" countryid="VI">Virgin Islands (U.S.)</option>
                                <option value="Wallis and Futuna Islands" countryid="WF">Wallis and Futuna Islands
                                </option>
                                <option value="Yemen" countryid="YE">Yemen</option>
                                <option value="Zambia" countryid="ZM">Zambia</option>
                                <option value="Zimbabwe" countryid="ZW">Zimbabwe</option>
                            </select>
                        </fieldset>
                        <fieldset class="mb-4" style="margin-top: 140px;">
                            <label class="text-white">{{ __('Languages') }}</label>
                            <select multiple="multiple" class="custom-select select-select2 languages" id="languages" name="languages">
                                <option value="Afrikaans">Afrikaans</option>
                                <option value="Albanian">Albanian</option>
                                <option value="Arabic">Arabic</option>
                                <option value="Armenian">Armenian</option>
                                <option value="Basque">Basque</option>
                                <option value="Bengali">Bengali</option>
                                <option value="Bulgarian">Bulgarian</option>
                                <option value="Catalan">Catalan</option>
                                <option value="Cambodian">Cambodian</option>
                                <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                                <option value="Croatian">Croatian</option>
                                <option value="Czech">Czech</option>
                                <option value="Danish">Danish</option>
                                <option value="Dutch">Dutch</option>
                                <option value="English">English</option>
                                <option value="Estonian">Estonian</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finnish">Finnish</option>
                                <option value="French">French</option>
                                <option value="Georgian">Georgian</option>
                                <option value="German">German</option>
                                <option value="Greek">Greek</option>
                                <option value="Gujarati">Gujarati</option>
                                <option value="Hebrew">Hebrew</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Hungarian">Hungarian</option>
                                <option value="Icelandic">Icelandic</option>
                                <option value="Indonesian">Indonesian</option>
                                <option value="Irish">Irish</option>
                                <option value="Italian">Italian</option>
                                <option value="Japanese">Japanese</option>
                                <option value="Javanese">Javanese</option>
                                <option value="Korean">Korean</option>
                                <option value="Latin">Latin</option>
                                <option value="Latvian">Latvian</option>
                                <option value="Lithuanian">Lithuanian</option>
                                <option value="Macedonian">Macedonian</option>
                                <option value="Malay">Malay</option>
                                <option value="Malayalam">Malayalam</option>
                                <option value="Maltese">Maltese</option>
                                <option value="Maori">Maori</option>
                                <option value="Marathi">Marathi</option>
                                <option value="Mongolian">Mongolian</option>
                                <option value="Nepali">Nepali</option>
                                <option value="Norwegian">Norwegian</option>
                                <option value="Persian">Persian</option>
                                <option value="Polish">Polish</option>
                                <option value="Portuguese">Portuguese</option>
                                <option value="Punjabi">Punjabi</option>
                                <option value="Quechua">Quechua</option>
                                <option value="Romanian">Romanian</option>
                                <option value="Russian">Russian</option>
                                <option value="Samoan">Samoan</option>
                                <option value="Serbian">Serbian</option>
                                <option value="Slovak">Slovak</option>
                                <option value="Slovenian">Slovenian</option>
                                <option value="Spanish">Spanish</option>
                                <option value="Swahili">Swahili</option>
                                <option value="Swedish ">Swedish</option>
                                <option value="Tamil">Tamil</option>
                                <option value="Tatar">Tatar</option>
                                <option value="Telugu">Telugu</option>
                                <option value="Thai">Thai</option>
                                <option value="Tibetan">Tibetan</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Turkish">Turkish</option>
                                <option value="Ukrainian">Ukrainian</option>
                                <option value="Urdu">Urdu</option>
                                <option value="Uzbek">Uzbek</option>
                                <option value="Vietnamese">Vietnamese</option>
                                <option value="Welsh">Welsh</option>
                                <option value="Xhosa">Xhosa</option>
                            </select>
                        </fieldset>
                        <!-- <div class="alert alert-secondary" style="line-height: initial;">
                            <i class="fas fa-info-circle my-auto mr-2 fa-lg"></i>Your ads can show to people in or who share interest in your locations, and to people who speak the languages you select.
                        </div> -->
                    </div>
                    <div class="col-5" >
                        <div class="estimated_panel bg-light rounded-lg px-4 py-3" style="background-color:white;">
                            <label class="font-weight-bold text-white">{{ __('Estimated weekly performance') }}</label>
                            <fieldset class="mb-3 pb-3 border-bottom">
                                <label class="font-weight-bold m-0 text-white">{{ __('6.5K - 12K') }}</label>
                                <div class="text-white">Impressions</div>
                                <div class="text-white">An impression is counted each time your ad is shown. The amount of impressions won’t affect your cost.
                                </div>
                            </fieldset>
                            <fieldset class="mb-3 pb-3 border-bottom">
                                <label class="font-weight-bold m-0 text-white">{{ __('2.4K - 5.3K') }}</label>
                                <div class="text-white">Views</div>
                                <div class="text-white">A view is counted when someone shows interest and watches 30 seconds of your video ad (or the duration if it's shorter than 30 seconds) or interacts with the ad.
                                </div>
                            </fieldset>
                            <fieldset>
                                <label class="font-weight-bold m-0 text-white">{{ __('USD2.12 - USD6.00') }}</label>
                                <div class="text-white">Average cost-per-view (CPV)</div>
                                <div class="text-white">The average amount you'll pay every time your ad gets a view.</div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane container fade" id="step3" style="display:none;">
                <h4 class="text-center mb-4 beast_subtitle">Select the gender and age of your customers</h4>
                <div class="row">
                    <div class="col-7">
                        <div class="row mx-0 mb-4">
                            <div class="col">
                                <label class="text-white">{{ __('Gender') }}</label>
                                <fieldset class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="gender-1" name="gender-1" value="yes" >
                                    <label class="form-check-label text-white" for="gender-1">Male</label>
                                </fieldset>
                                <fieldset class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="gender-2" name="gender-2" value="yes" >
                                    <label class="form-check-label text-white" for="gender-2">Female</label>
                                </fieldset>
                                <fieldset class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="gender-3" name="gender-3" value="yes" >
                                    <label class="form-check-label text-white" for="gender-3">Others</label>
                                </fieldset>
                                <input type="text" id="gender_range" name="gender_range" hidden ></input>
                            </div>
                            <div class="col">
                                <label class="text-white">{{ __('Age') }}</label>
                                <fieldset class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="age-1" name="age-1" value="yes" >
                                    <label class="form-check-label text-white" for="age-1">18-24</label>
                                </fieldset>
                                <fieldset class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="age-2" name="age-2" value="yes" >
                                    <label class="form-check-label text-white" for="age-2">25-34</label>
                                </fieldset>
                                <fieldset class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="age-3" name="age-3" value="yes" >
                                    <label class="form-check-label text-white" for="age-3">35-44</label>
                                </fieldset>
                                <fieldset class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="age-4" name="age-4" value="yes" >
                                    <label class="form-check-label text-white" for="age-4">45-54</label>
                                </fieldset>
                                <fieldset class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="age-5" name="age-5" value="yes" >
                                    <label class="form-check-label text-white" for="age-5">55-64</label>
                                </fieldset>
                                <fieldset class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="age-6" name="age-6" value="yes" >
                                    <label class="form-check-label text-white" for="age-6">65+</label>
                                </fieldset>
                                <input type="text" name="age_range" id="age_range" hidden ></input>
                            </div>
                        </div>
                        <!-- <div class="alert alert-secondary" style="line-height: initial;">
                            <i class="fas fa-info-circle my-auto mr-2 fa-lg"></i>Your ads can show to a specific set of potential customers who are likely to be within a particular age range or gender.
                        </div> -->
                    </div>
                    <div class="col-5">
                        <div class="estimated_panel rounded-lg px-4 py-3 ">
                            <label class="font-weight-bold text-white">{{ __('Estimated weekly performance') }}</label>
                            <fieldset class="mb-3 pb-3 border-bottom">
                                <label class="font-weight-bold m-0 text-white">{{ __('6.5K - 12K') }}</label>
                                <div class="text-white">Impressions</div>
                                <div class="text-white">An impression is counted each time your ad is shown. The amount of impressions won’t affect your cost.
                                </div>
                            </fieldset>
                            <fieldset class="mb-3 pb-3 border-bottom">
                                <label class="font-weight-bold m-0 text-white">{{ __('2.4K - 5.3K') }}</label>
                                <div class="text-white">Views</div>
                                <div class="text-white">A view is counted when someone shows interest and watches 30 seconds of your video ad (or the duration if it's shorter than 30 seconds) or interacts with the ad.
                                </div>
                            </fieldset>
                            <fieldset>
                                <label class="font-weight-bold m-0 text-white">{{ __('USD2.12 - USD6.00') }}</label>
                                <div class="text-white">Average cost-per-view (CPV)</div>
                                <div class="text-white">The average amount you'll pay every time your ad gets a view.</div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane container fade" id="step4" style="display:none;">
                <h4 class="text-center mb-4 beast_subtitle text-white">Now, tell us if you want to reach people with specific interests</h4>
                <div class="row">
                    <div class="col-7">
                        <section class="select-video font_type">
                            <div class="container">
                                <h1 class="turget text-center text-white">Almost done! Set a budget that's right for you</h1>
                                <div class="container-fluid">
                                    <p class="ad mt-5 text-center text-white">Set a daily budget</p>
                                    <div class="container-fluid d-flex justify-content-around">
                                        <span class="text-white">0$</span>
                                        <input type="range" min="1" max="200" value="50" class="slider" id="myRange">
                                        <input id="demo" name="budget" class="daily_budget"></input>
                                    </div>
                                    <p class="mt-5 text-center text-white">Estmated weekly performance</p>
                                    <div class="col-md-8 d-flex justify-content-around square mx-auto">
                                        <div class="col-4">
                                            <p class="text-center text-white">$0-$10</p>
                                            <hr>
                                            <p class="text-center text-white">Views</p>
                                        </div>
                                        <div class="col-6">
                                            <p class="text-center text-white">$8.00-$10.00</p>
                                            <hr>
                                            <p class="text-center text-white">Average cost-pow-view(cpu)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-5">
                        <div class="estimated_panel bg-light rounded-lg px-4 py-3">
                            <label class="font-weight-bold text-white">{{ __('Estimated weekly performance') }}</label>
                            <fieldset class="mb-3 pb-3 border-bottom">
                                <label class="font-weight-bold m-0 text-white">{{ __('6.5K - 12K') }}</label>
                                <div class="text-white">Impressions</div>
                                <div class="text-white">An impression is counted each time your ad is shown. The amount of impressions won’t affect your cost.
                                </div>
                            </fieldset>
                            <fieldset class="mb-3 pb-3 border-bottom">
                                <label class="font-weight-bold m-0 text-white">{{ __('2.4K - 5.3K') }}</label>
                                <div class="text-white">Views</div>
                                <div class="text-white">A view is counted when someone shows interest and watches 30 seconds of your video ad (or the duration if it's shorter than 30 seconds) or interacts with the ad.
                                </div>
                            </fieldset>
                            <fieldset>
                                <label class="font-weight-bold m-0 text-white">{{ __('USD2.12 - USD6.00') }}</label>
                                <div class="text-white">Average cost-per-view (CPV)</div>
                                <div class="text-white">The average amount you'll pay every time your ad gets a view.</div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" style="margin-top: 120px; margin-bottom: 20px;">
                <div class="col-9">
                    <button type="button" class="prev_btn" id="prv_btn" onclick="ToPrev()">Previous</button>
                </div>
                <div class="col-1">
                    <div >
                        <button type="button" class="next_btn" id="next_btn" onclick="ToNext()" style="display: block;"> Next </button>
                    </div>
                    <div>
                        <button type="button" class="next_btn" data-bs-toggle="modal" data-bs-target="#progressModal" id="hidden_next" style="display: none;" onclick="ToNext()"> Next </button>
                    </div>
                </div>
            <div>
        </form>
    </div>

    <div class="modal" id="progressModal" >
        <div class="modal-dialog">
            <div class="modal-content">
<!-- progressing -->
                <div class="progress">
                    <div class="bar" id="bar"></div >
                    <div class="percent">0%</div >
                </div>
<!-- progressing -->
            </div>
        </div>
    </div>

</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="http://malsup.github.io/jquery.form.js"></script>

<script>
// uploading progressing
    (function() {
        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');

        $('form').ajaxForm({
            beforeSend: function() {
                status.empty();
                var percentVal = '0%';
                var posterValue = $('#video').value;

                console.log('1', posterValue);

                bar.width(percentVal)
                percent.html(percentVal);
            },

            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },

            success: function() {
                var percentVal = 'Wait, Saving';
                bar.width(percentVal)
                percent.html(percentVal);
            },

            complete: function(xhr) {
                status.html(xhr.responseText);
                alert('Uploaded Successfully');
                window.location.href = "/createcampaign";
            }
        });
    })();

// uploading progress
    function _changeVisible(current, changeable) {
        document.getElementById(current).classList.add('fade')
        document.getElementById(current).classList.remove('active')
        document.getElementById(changeable).classList.add('active')
        document.getElementById(changeable).classList.remove('fade')

        document.getElementById(current).style.display = 'none'
        document.getElementById(changeable).style.display = 'block'
    }
    function ToNext() {
        currentstep = document.getElementsByClassName('tab-pane container active')[0].id
        // console.log('current', currentstep)
        switch(currentstep) {
            case 'step1':
                // var btn = document.getElementById('next_btn')
                // console.log(btn)
                var result = _validate()
                if (result == 0 ){
                    $('#alert_name').show().delay(3000).fadeOut();
                }
                if(result == 1) {
                    $('#alert_video').show().delay(3000).fadeOut();
                }
                // if(result == 2) {
                //     this._changeVisible('step1', 'step2')
                // }
                if(result == 2 || result == 3) {
                    this._changeVisible('step1', 'step2')
                }
                break
            case 'step2':
                this._changeVisible('step2', 'step3')
                break
            case 'step3':
                _gender()
                this._changeVisible('step3', 'step4')
                document.getElementById('next_btn').style.display = 'none'
                document.getElementById('hidden_next').style.display = 'block'
                break
            case 'step4':
                // document.getElementById('next_btn').type = 'submit'

                // var btn = document.getElementById('hidden_next').type 
                // var_dump(btn)
                document.getElementById('hidden_next').type = 'submit'
                break
        }
    }
    function ToPrev() {
        currentstep = document.getElementsByClassName('tab-pane container active')[0].id
        console.log('current', currentstep)
        switch(currentstep) {
            case 'step1':
                console.log('0')
            break
            case 'step2':
                this._changeVisible('step2', 'step1')
            break
            case 'step3':
                this._changeVisible('step3', 'step2')
            break
            case 'step4':
                this._changeVisible('step4', 'step3')
            break
        }
    }
    function openfile() {
        document.getElementById('video').click()
    }
    function onChangePostFile(e) {

        var fileElem = e.target;
        var imgElem = document.getElementById('preview_image');
        var videoElem = document.getElementById('preview_video');

        var file = fileElem.files[0];
        var fr = new FileReader();
        fr.onload = function(e) {
            imgElem.style = '';
            imgElem.src = this.result;
        };
        switch (file.type) {
            case 'image/jpeg':
            case 'image/jpg':
            case 'image/png':
                fr.readAsDataURL(file);
                break;
            default:
                videoElem.style.display = 'block';
                document.getElementById('video').style.display= 'none';
                document.getElementById('uploadimg').style.display= 'none';
                videoElem.src = URL.createObjectURL(file);
        }
    }
//validate each field
    function _validate() {
        var title = document.getElementById('title').value
        var videofile = document.getElementById('video').value
        var videourl = document.getElementById('videourl').value
        
        if(title == '') {
            return 0
        } else {
            // if(videofile == ''){
            //     return 1
            // } else {
            //     return 2
            // }
            if(videofile == '' && videourl == '' ){
                return 1;
            }
            if(videofile == '' && videourl != ''){
                return 2;
            }
            if(videofile != '' && videourl == ''){
                return 3;
            }
        }
    }
// video visible change
    $("#ishave").click(function(){
        if ($("#ishave").is(":checked")) { 
            $("#no").hide();
            $("#yes").show();
        }else {
            $("#yes").hide();
            $("#no").show();
        }
    })
//gender & age
    function _gender(){
        var genderValue1 = document.getElementById('gender-1').checked
        var genderValue2 = document.getElementById('gender-2').checked
        var genderValue3 = document.getElementById('gender-3').checked
        var finalgender = ''
        var finalage    = ''
        if (genderValue1 == true) {
            finalgender += ' male '
        }
        if (genderValue2 == true) {
            finalgender += ' female '
        }
        if (genderValue3 == true) {
            finalgender += ' others '
        }
        document.getElementById('gender_range').value = finalgender
        // console.log(document.getElementById('gender_range').value)

        var ageValue1 = document.getElementById('age-1').checked
        var ageValue2 = document.getElementById('age-2').checked
        var ageValue3 = document.getElementById('age-3').checked
        var ageValue4 = document.getElementById('age-4').checked
        var ageValue5 = document.getElementById('age-5').checked
        var ageValue6 = document.getElementById('age-6').checked

        if (ageValue1 == true ) {
            finalage += ' 18-24 '
        }
        if (ageValue2 == true ) {
            finalage += ' 25-34 '
        }
        if (ageValue3 == true ) {
            finalage += ' 35-44 '
        }
        if (ageValue4 == true ) {
            finalage += ' 45-54 '
        }
        if (ageValue5 == true ) {
            finalage += ' 55-64 '
        }
        if (ageValue6 == true ) {
            finalage += ' 65 '
        }

        document.getElementById('age_range').value = finalage
        // console.log(document.getElementById('age_range').value)
    }
//budget
    var slider = document.getElementById("myRange");
    	var output = document.getElementById("demo");
    	output.value = slider.value + '$';
    	slider.oninput = function() {
    		output.value = this.value + '$';
    		var value = (this.value-this.min)/(this.max-this.min)*100
  			this.style.background = 'linear-gradient(to right, white 0%, white ' + value + '%, #1C1E1E ' + value + '%, #1C1E1E 100%)';
    };

</script>

@endsection
