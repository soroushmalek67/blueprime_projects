<!doctype html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/normalize.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/vendor/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/application.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/sign-in.css') }}">
    </head>

    <body>
        <div class="container">
            {{ $content }}
        </div>

        <footer class="footer">
           <p>&copy; {{date("Y")}} firmogram.com. All rights reserved &nbsp;|  <a href="http://support.firmogram.ca/" target="_blank"> &nbsp;Support &nbsp;</a> | <a href="http://firmogram.com/terms" target="_blank">&nbsp;Privacy Policy&nbsp; </a> | <a href="http://firmogram.com/privacy-policy" target="_blank">&nbsp;Terms of Use&nbsp;</a> </p>
        </footer>

<!--
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 id="myModalLabel" style="color:darkblue">Terms & Services</h3>
              </div>
              <div class="modal-body" style="color:black;height:500px;overflow: auto">

                <div style="color:black;min-height:500px;overflow:auto">
                    <div>
                      <ol>
                        <li>
                          Subject to the terms of this Agreement and payment of all applicable fees or right to use of a trial version or upon login, firmogram analytics Inc (FAI) grants to Licensee a non-exclusive and non-transferable licence to use FIRMOGRAM “the Software” solely for the internal business purposes of the Licensee.
                        </li>
                        <li>
                          FAI makes no warranty, either expressed or implied, with respect to the software and specifically disclaims all other warranties, including warranties for merchantability, non-infringement, and suitability for any particular purpose.
                        </li>
                        <li>
                          The copyright, patents, trademarks and all other intellectual property rights in the Software and related documentation are owned by and remain the property of FAI.
                        </li>
                        <li>
                          Licensee does not obtain any rights in the Software other than those expressly granted in this Agreement.
                        </li>
                        <li>
                          Except as expressly permitted by this Agreement or authorised in writing by a director of FAI, Licensee shall not, nor permit others to:
                          <ol>
                            <li>
                              Use, copy, modify, create derivative works from or distribute the Software, any part of it, or any copy, adaptation, transcription, or merged portion of it, except to the extent that the foregoing acts are permitted by law;
                            </li>
                            <li>
                              Decode, reverse engineer, disassemble, decompile or otherwise translate or convert the Software or any part of it, except to the extent that the foregoing acts are permitted by law;
                            </li>
                            <li>
                              Exploit or sell the Software commercially;
                            </li>
                            <li>
                              Incorporate the Software into programs not provided by FAI;
                            </li>
                            <li>
                              Transfer, loan, lease, assign, charge, rent, or otherwise sublicense the Software, subscription, or this Agreement;
                            </li>
                            <li>
                              Use the Software in any manner that infringes the intellectual property or other rights of FAI or any other party;
                            </li>
                            <li>
                              Remove or alter any copyright, proprietary or similar notices from the Software (or any copies of it); or
                            </li>
                            <li>
                              Use the software for commercial purposes if it has been licensed to a teaching establishment or student/s for educational or testing purposes.
                            </li>
                          </ol>
                        </li>
                        <li>
                          This Agreement is the complete and exclusive statement of the agreement between the parties which supersedes all proposals or prior agreements oral or written and save as expressly set out in this Agreement all representations, conditions or warranties express or implied statutory or otherwise are excluded, to the maximum extent permitted by law.
                            </li>
                          
                             </li>
                            </li>
              FAI values your privacy and treats it with highest level of proffesionalism and care. We do not share, neither disclose to the third party the information that we collect about you or your business when you visit www.firmogram.com or its subdomains (the "Website") and when you use the services available on the Website ("Services"). We collect business information when you require to create an account to access certain features of our application software "FIRMOGRAM". By using the Website, you agree to this Policy and you consent to the transfer of all business and personal information to our servers regardless of where they are located. Please send your questions or concerns regarding privacy and data collection in our website to info@firmogram.com.
                        </li>
                      </ol>
                  </div>
                </div>

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
-->
        <script src="{{ url('assets/js/vendor/jquery.min.js') }}"></script>
        <script src="{{ url('assets/js/vendor/bootstrap.min.js') }}"></script>
    </body>
</html>