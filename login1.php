<?php require_once ('./admin/app/app_include/session.php'); ?>
<?php $token = $_SESSION["token"]; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daylogs | Home</title>
    <?php include 'web/include/meta_data.php'; ?>
    <!-- Google Analytics Start -->
    <?php include 'web/include/google_analytics.php'; ?>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="web/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="web/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="web/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="web/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="web/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="web/assets/css/main.css" rel="stylesheet">



    <!-- Main CSS File -->
    <link href="web/assets/css/main.css" rel="stylesheet">

</head>
<style>
    #tandcSec {
        display: none;
    }

    #newUserSection {
        display: none;
    }

    #new-web .login-card {
        height: auto;
    }

    #new-web #screen-body {
        padding: 60px 0 40px 0;
    }
</style>

<body class="index-page">

    <?php include 'web/include/header.php'; ?>
    <main class="main">
        <section class="h-100 gradient-form" style="background-color: #eee;">
            <div class="container">
                <div class="row justify-content-center m-5">
                    <div class="login-card">
                        <section id="login-header">
                            <div class="before-login-logo">

                                <a href="https://eduvanz.com/"><img
                                        src="https://d1idiaqkpcnv43.cloudfront.net/assets/website1.0/images/eduvanz-white-logo.png"
                                        alt="Logo" title="Logo" class="img-responsive edu-logo"></a>

                            </div>
                        </section>
                        <section id="screen-body">
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-7">

                                            <img src="https://d1idiaqkpcnv43.cloudfront.net/website1.0/images/sign-up.png"
                                                alt="Sign-up" title="Sign-up" class="img-responsive sign-up-img">

                                        </div>
                                        <div class="col-sm-12 col-md-5">
                                            <div class="login-section">
                                                <div class="text-center">
                                                    <div class="main-hd">Get started now!</div>
                                                    <div class="cont mrt5">Hello, let’s start your
                                                        loan journey with us</div>
                                                </div>

                                                <div class="mob-no-sec">
                                                    <form method="POST" name="submitlogin"
                                                        action="https://eduvanz.com/login/addOTP">
                                                        <div class="form-group">
                                                            <div class="label-sec">
                                                                <label>MOBILE NUMBER</label>
                                                            </div>
                                                            <div class="input-group">
                                                                <div class="row">
                                                                    <div class="col-sm-4 col-xs-4 pdr0">
                                                                        <div class="country-list"><select
                                                                                name="countrycode" "name=" countrycode"
                                                                                class="form-control select-brd"
                                                                                id="countrycode">
                                                                                <option value="91">India</option>
                                                                                <option value="355">Albania</option>
                                                                                <option value="213">Algeria</option>
                                                                                <option value="1">Virgin Islands
                                                                                </option>
                                                                                <option value="376">Andorra,
                                                                                    Principality Of</option>
                                                                                <option value="244">Angola</option>
                                                                                <option value="672">Norfolk Island
                                                                                </option>
                                                                                <option value="54">Argentina</option>
                                                                                <option value="374">Armenia</option>
                                                                                <option value="297">Aruba</option>
                                                                                <option value="61">Cocos (Keeling)
                                                                                    Islands</option>
                                                                                <option value="43">Austria</option>
                                                                                <option value="994">Azerbaijan</option>
                                                                                <option value="973">Bahrain</option>
                                                                                <option value="880">Bangladesh</option>
                                                                                <option value="375">Belarus</option>
                                                                                <option value="32">Belgium</option>
                                                                                <option value="501">Belize</option>
                                                                                <option value="229">Benin</option>
                                                                                <option value="975">Bhutan</option>
                                                                                <option value="591">Bolivia</option>
                                                                                <option value="387">Bosnia And
                                                                                    Herzegovina</option>
                                                                                <option value="267">Botswana</option>
                                                                                <option value="0">Zaire</option>
                                                                                <option value="55">Brazil</option>
                                                                                <option value="673">Brunei</option>
                                                                                <option value="359">Bulgaria</option>
                                                                                <option value="226">Burkina Faso
                                                                                </option>
                                                                                <option value="257">Burundi</option>
                                                                                <option value="855">Cambodia</option>
                                                                                <option value="237">Cameroon</option>
                                                                                <option value="238">Cape Verde</option>
                                                                                <option value="236">Central African
                                                                                    Republic</option>
                                                                                <option value="235">Chad</option>
                                                                                <option value="56">Chile</option>
                                                                                <option value="86">China</option>
                                                                                <option value="53">Cuba</option>
                                                                                <option value="57">Colombia</option>
                                                                                <option value="269">Mayotte</option>
                                                                                <option value="243">Congo</option>
                                                                                <option value="242">Congo, Republic Of
                                                                                    The</option>
                                                                                <option value="682">Cook Islands
                                                                                </option>
                                                                                <option value="506">Costa Rica</option>
                                                                                <option value="225">Cote D'Ivoire
                                                                                </option>
                                                                                <option value="385">Croatia (Hrvatska)
                                                                                </option>
                                                                                <option value="357">Cyprus</option>
                                                                                <option value="420">Czech Republic
                                                                                </option>
                                                                                <option value="45">Denmark</option>
                                                                                <option value="253">Djibouti</option>
                                                                                <option value="670">East Timor</option>
                                                                                <option value="593">Ecuador</option>
                                                                                <option value="20">Egypt</option>
                                                                                <option value="503">El Salvador</option>
                                                                                <option value="240">Equatorial Guinea
                                                                                </option>
                                                                                <option value="291">Eritrea</option>
                                                                                <option value="372">Estonia</option>
                                                                                <option value="251">Ethiopia</option>
                                                                                <option value="500">Falkland Islands
                                                                                </option>
                                                                                <option value="298">Faroe Islands
                                                                                </option>
                                                                                <option value="679">Fiji</option>
                                                                                <option value="358">Finland</option>
                                                                                <option value="33">France</option>
                                                                                <option value="594">French Guiana
                                                                                </option>
                                                                                <option value="689">French Polynesia
                                                                                </option>
                                                                                <option value="241">Gabon</option>
                                                                                <option value="220">Gambia</option>
                                                                                <option value="995">Georgia</option>
                                                                                <option value="49">Germany</option>
                                                                                <option value="233">Ghana</option>
                                                                                <option value="350">Gibraltar</option>
                                                                                <option value="30">Greece</option>
                                                                                <option value="299">Greenland</option>
                                                                                <option value="590">Guadeloupe</option>
                                                                                <option value="502">Guatemala</option>
                                                                                <option value="224">Guinea</option>
                                                                                <option value="245">Guinea-Bissau
                                                                                </option>
                                                                                <option value="592">Guyana</option>
                                                                                <option value="509">Haiti</option>
                                                                                <option value="504">Honduras</option>
                                                                                <option value="852">Hong Kong</option>
                                                                                <option value="36">Hungary</option>
                                                                                <option value="354">Iceland</option>
                                                                                <option value="93">Afghanistan</option>
                                                                                <option value="62">Indonesia</option>
                                                                                <option value="98">Iran</option>
                                                                                <option value="964">Iraq</option>
                                                                                <option value="353">Ireland</option>
                                                                                <option value="972">Israel</option>
                                                                                <option value="39">Italy</option>
                                                                                <option value="81">Japan</option>
                                                                                <option value="962">Jordan</option>
                                                                                <option value="7">Russian Federation
                                                                                </option>
                                                                                <option value="254">Kenya</option>
                                                                                <option value="686">Kiribati</option>
                                                                                <option value="850">Korea</option>
                                                                                <option value="82">Korea</option>
                                                                                <option value="965">Kuwait</option>
                                                                                <option value="996">Kyrgyzstan</option>
                                                                                <option value="856">Lao People</option>
                                                                                <option value="371">Latvia</option>
                                                                                <option value="961">Lebanon</option>
                                                                                <option value="266">Lesotho</option>
                                                                                <option value="231">Liberia</option>
                                                                                <option value="218">Libya</option>
                                                                                <option value="423">Liechtenstein
                                                                                </option>
                                                                                <option value="370">Lithuania</option>
                                                                                <option value="352">Luxembourg</option>
                                                                                <option value="853">Macau</option>
                                                                                <option value="389">Macedonia</option>
                                                                                <option value="261">Madagascar</option>
                                                                                <option value="265">Malawi</option>
                                                                                <option value="60">Malaysia</option>
                                                                                <option value="960">Maldives</option>
                                                                                <option value="223">Mali</option>
                                                                                <option value="356">Malta</option>
                                                                                <option value="692">Marshall Islands
                                                                                </option>
                                                                                <option value="596">Martinique</option>
                                                                                <option value="222">Mauritania</option>
                                                                                <option value="230">Mauritius</option>
                                                                                <option value="52">Mexico</option>
                                                                                <option value="691">Micronesia</option>
                                                                                <option value="373">Moldova</option>
                                                                                <option value="377">Monaco</option>
                                                                                <option value="976">Mongolia</option>
                                                                                <option value="212">Morocco</option>
                                                                                <option value="258">Mozambique</option>
                                                                                <option value="95">Myanmar</option>
                                                                                <option value="264">Namibia</option>
                                                                                <option value="674">Nauru</option>
                                                                                <option value="977">Nepal</option>
                                                                                <option value="31">Netherlands</option>
                                                                                <option value="599">Netherlands Antilles
                                                                                </option>
                                                                                <option value="687">New Caledonia
                                                                                </option>
                                                                                <option value="64">New Zealand</option>
                                                                                <option value="505">Nicaragua</option>
                                                                                <option value="227">Niger</option>
                                                                                <option value="234">Nigeria</option>
                                                                                <option value="683">Niue</option>
                                                                                <option value="47">Norway</option>
                                                                                <option value="968">Oman</option>
                                                                                <option value="92">Pakistan</option>
                                                                                <option value="680">Palau</option>
                                                                                <option value="970">Palestinian State
                                                                                </option>
                                                                                <option value="507">Panama</option>
                                                                                <option value="675">Papua New Guinea
                                                                                </option>
                                                                                <option value="595">Paraguay</option>
                                                                                <option value="51">Peru</option>
                                                                                <option value="63">Philippines</option>
                                                                                <option value="48">Poland</option>
                                                                                <option value="351">Portugal</option>
                                                                                <option value="974">Qatar</option>
                                                                                <option value="262">Reunion</option>
                                                                                <option value="40">Romania</option>
                                                                                <option value="250">Rwanda</option>
                                                                                <option value="290">Saint Helena
                                                                                </option>
                                                                                <option value="508">Saint Pierre And
                                                                                    Miquelon</option>
                                                                                <option value="685">Samoa</option>
                                                                                <option value="378">San Marino</option>
                                                                                <option value="239">Sao Tome And
                                                                                    Principe</option>
                                                                                <option value="966">Saudi Arabia
                                                                                </option>
                                                                                <option value="221">Senegal</option>
                                                                                <option value="248">Seychelles</option>
                                                                                <option value="232">Sierra Leone
                                                                                </option>
                                                                                <option value="65">Singapore</option>
                                                                                <option value="421">Slovakia</option>
                                                                                <option value="386">Slovenia</option>
                                                                                <option value="677">Solomon Islands
                                                                                </option>
                                                                                <option value="252">Somalia</option>
                                                                                <option value="27">South Africa</option>
                                                                                <option value="34">Spain</option>
                                                                                <option value="94">Sri Lanka</option>
                                                                                <option value="249">Sudan</option>
                                                                                <option value="597">Suriname</option>
                                                                                <option value="268">Swaziland</option>
                                                                                <option value="46">Sweden</option>
                                                                                <option value="41">Switzerland</option>
                                                                                <option value="963">Syria</option>
                                                                                <option value="886">Taiwan</option>
                                                                                <option value="992">Tajikistan</option>
                                                                                <option value="255">Tanzania</option>
                                                                                <option value="66">Thailand</option>
                                                                                <option value="690">Tokelau</option>
                                                                                <option value="676">Tonga</option>
                                                                                <option value="216">Tunisia</option>
                                                                                <option value="90">Turkey</option>
                                                                                <option value="993">Turkmenistan
                                                                                </option>
                                                                                <option value="688">Tuvalu</option>
                                                                                <option value="256">Uganda</option>
                                                                                <option value="380">Ukraine</option>
                                                                                <option value="971">United Arab Emirates
                                                                                </option>
                                                                                <option value="44">United Kingdom
                                                                                </option>
                                                                                <option value="598">Uruguay</option>
                                                                                <option value="998">Uzbekistan</option>
                                                                                <option value="678">Vanuatu</option>
                                                                                <option value="418">Vatican</option>
                                                                                <option value="58">Venezuela</option>
                                                                                <option value="84">Vietnam</option>
                                                                                <option value="681">Wallis And Futuna
                                                                                    Islands</option>
                                                                                <option value="967">Yemen</option>
                                                                                <option value="260">Zambia</option>
                                                                                <option value="263">Zimbabwe</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-8 col-xs-8 pdl0">

                                                                        <input type="text" id="mobile" name="mobile"
                                                                            class="form-control"
                                                                            onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                                                            value="" maxlength="10">
                                                                        <input type="hidden" name="lead_id" value="">

                                                                    </div>
                                                                </div>
                                                                <div class="help-block" id="mobile_error"></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group hidden" id="showEmail">
                                                            <div class="label-sec">
                                                                <label>EMAIL ID</label>
                                                            </div>
                                                            <input type="text" name="email" id="email"
                                                                class="form-control" value="">
                                                            <div id="matchingdata" class="error hide"></div>
                                                            <div id="insurance_error_data" class="error hide"></div>

                                                            <div class="tt" id="newUserSection"
                                                                style="justify-content:space-between; margin-top: 20px;">
                                                                <p class="TC" style="
                                                            font-family: 'Poppins';
                                                            font-style: normal;
                                                            font-weight: 400;
                                                            font-size: 12px;
                                                            line-height: 18px;
                                                            text-align: center;
                                                                color: #000000;"><input type="checkbox" id="tandc1"
                                                                        checked="" style="background:blue;"> By clicking
                                                                    CONTINUE and entering the OTP, I confirm having
                                                                    read, understood and agree to the <a
                                                                        href="https://eduvanz.com/terms"
                                                                        target="_blank"><u>Application T&amp;Cs</u></a>,
                                                                    <a href="https://eduvanz.com/privacy"
                                                                        target="_blank"><u>Privacy Policy</u></a> and <a
                                                                        href="https://eduvanz.com/legal"
                                                                        target="_blank"><u>other terms</u></a>.
                                                                </p>
                                                            </div>
                                                            <div class="help-block" id="email_error"></div>
                                                        </div>

                                                        <div class="mrt20">
                                                            <button type="button" id="submitTnC"
                                                                class="blue-btn-active btn" onclick="getOTP();">GET
                                                                OTP</button>
                                                        </div>
                                                        <div class="mrt20 text-center">
                                                            <div class="email-login">Existing user? <a
                                                                    href="https://eduvanz.com/login/emailLoginView"
                                                                    class="emailLogin">Login via Email</a></div>
                                                            <div class="tt" id="tandcSec"
                                                                style="justify-content:space-between; margin-top: 20px;">
                                                                <p class="TC" style="
                                                            font-family: 'Poppins';
                                                            font-style: normal;
                                                            font-weight: 400;
                                                            font-size: 12px;
                                                            line-height: 18px;
                                                            text-align: center;
                                                                color: #000000;"><input type="checkbox" id="tandc"
                                                                        checked="" style="background:blue;"> By clicking
                                                                    CONTINUE and entering the OTP, I confirm having
                                                                    read, understood and agree to the <a
                                                                        href="https://eduvanz.com/terms"
                                                                        target="_blank"><u>Application T&amp;Cs</u></a>,
                                                                    <a href="https://eduvanz.com/privacy"
                                                                        target="_blank"><u>Privacy Policy</u></a> and <a
                                                                        href="https://eduvanz.com/legal"
                                                                        target="_blank"><u>other terms</u></a>.
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <script src="//code.tidio.co/k06librojm4uktbmcjgxpeje3nwkdlzz.js" async></script>
    <?php include 'web/include/footer.php'; ?>
    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="web/assets/vendor/php-email-form/validate.js"></script>
    <script src="web/assets/vendor/aos/aos.js"></script>
    <script src="web/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="web/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="web/assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/manage/app-assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>
    <script src="/manage/app-assets/toast.js"></script>
    <link rel="stylesheet" href="/manage/app-assets/plugins/jquery-toast/dist/jquery.toast.min.css">



</body>

</html>