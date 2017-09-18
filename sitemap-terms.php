<?php
include './cms/plugin.php';
$cms = new plugin();
?>
    <!doctype php>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/fav1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <?php
        echo $cms->pageTitle("TERMS OF SERVICE | Ticket Chai");
        ?>

            <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

            <?php echo $cms->headCss(array('sitemapTerms')); ?>
    </head>

    <body class="index-page signin" ng-app="frontEnd" ng-controller="sitemap-termsController">
        <!--page loader-->
        <div class="se-pre-con"></div>
        <!--page loader-->
        <div id="fb-root"></div>
        <?php echo $cms->FbSocialScript(); ?>
            <?php include 'include/navbar.php';?>

                <div class="clearfix"></div>
                <div class="wrapper">
                    <!-- main content part starts here -->
                    <div class="main" style="background-color: transparent; margin-top:70px;">
                        <div class="clearfix"></div>
                        <!-- sitemap section starts here -->
                        <div class="section-simple2">
                            <div class="container-fluid" style="">
                                <div class="row ">
                                    <!-- sitemap header  Starts Here section_padd30-->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs ">
                                        <div class="section-heading container">
                                            <h1 class="text-fluid"><strong>TICKETCHAI TERMS OF SERVICE AGREEMENT</strong></h1>
                                            <p class="text-center col-lg-12 col-sm-12 col-xs-12" style="">
                                                Welcome to Ticketchai. Ticketchai enables people all over the world to plan, promote, and sell tickets to any event. And we make it easy for everyone to discover events, and to share the events they are attending with the people they know. The following pages contain our Terms of Service, which govern all use of our Services.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                                        <div class="sidebar-list">
                                            <ul class="list-group">
                                                <a href="sitemap-terms.php"><li class="list-group-item active" style="color:black">Terms & Condition<i class="pull-right fa fa-angle-right"></i> </li></a>
                                                <a href="sitemap-privacy&policy.php"><li class="list-group-item " style="color:black">Privacy & Policy<i class="pull-right fa fa-angle-right"></i> </li></a>
                                                <a href="sitemap-buy.php"><li class="list-group-item " style="color:black">How to Buy<i class="pull-right fa fa-angle-right"></i> </li></a>
                                                <a href="sitemap-customar-support.php"><li class="list-group-item" style="color:black">Customer Support<i class="pull-right fa fa-angle-right"></i> </li></a>
                                                <!--<a href="sitemap-sponsor.php"><li class="list-group-item" style="color:black">Our Sponsor<i class="pull-right fa fa-angle-right"></i> </li></a>-->
                                                <a href="sitemap.php"><li class="list-group-item" style="color:black">Sitemap<i class="pull-right fa fa-angle-right"></i> </li></a>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 visible-xs ">
                                        <div class="section-heading container">
                                            <h1 class="text-fluid"><strong>TERMS OF SERVICE</strong></h1>
                                            <p class="text-center col-lg-12 col-sm-12 col-xs-12" style="">These Terms of Service (this 'Agreement'), constitute a legal agreement between www.ticketchai ('the service'), a service of The Ticket Chai (“the Company”) and you. This Agreement governs your use of the Software and Service (as defined below). By clicking 'I Accept,' you agree to all terms and conditions of this Agreement.<br/><br/>

If you are entering into this Agreement on behalf of a company or other organization, you hereby warrant and represent that you are authorized to enter into this Agreement on behalf of such company or other organization. In such an event, “you” and “your” will refer and apply to that company or other legal entity.<br/><br/>

The service may contain links to third party websites that are not owned or controlled by The Ticket Chai. The Ticket Chai has no control over, and assumes no responsibility for the content, privacy policy, or practices of any third party websites. In addition, The Ticket Chai will not and cannot censor or edit the content of any third party site. By using the service, you expressly relieve The Ticket Chai from any and all liability arising from your use of any third party website, service or entity. <br/><br/>

In case of inconsistency between Terms of Service and Privacy Policy, these Terms of Service shall prevail.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 sitemap-right" style="visibility: visible; animation-duration: 1s; animation-delay: 0.15s; animation-name: fadeInUp;">
                                        <div class="row sitemap_terms">
                                            <div class="media">

                                                <ul class="media-list">
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num1}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>TERMS OF SERVICE</strong></h6>
                                                            <p>
                                                                These Terms of Service (this 'Agreement'), constitute a legal agreement between www.ticketchai ('the service'), a service of The Ticket Chai (“the Company”) and you. This Agreement governs your use of the Software and Service (as defined below). By clicking 'I Accept,' you agree to all terms and conditions of this Agreement.<br/><br/>

If you are entering into this Agreement on behalf of a company or other organization, you hereby warrant and represent that you are authorized to enter into this Agreement on behalf of such company or other organization. In such an event, “you” and “your” will refer and apply to that company or other legal entity.<br/><br/>

The service may contain links to third party websites that are not owned or controlled by The Ticket Chai. The Ticket Chai has no control over, and assumes no responsibility for the content, privacy policy, or practices of any third party websites. In addition, The Ticket Chai will not and cannot censor or edit the content of any third party site. By using the service, you expressly relieve The Ticket Chai from any and all liability arising from your use of any third party website, service or entity. <br/><br/>

In case of inconsistency between Terms of Service and Privacy Policy, these Terms of Service shall prevail.
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num2}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>DISCLAIMERS AND LIMITATION OF LIABILITY</strong></h6>
                                                            <p>
                                                                By using the service, you expressly agree that use of the www.ticketchai web site is at your sole risk. The service is provided on an "AS IS" and "as available" basis. Neither The Ticket Chai nor its affiliates, subsidiaries or designees nor each of their respective officers, directors, employees, agents, third-party content providers, designers, contractors, distributors, merchants, sponsors, licensors or the like (collectively, "Associates") warrant that use of the service will be uninterrupted or error-free. Neither the company nor its Associates warrant the accuracy, integrity or completeness of the content provided on the website i.e. www.ticketchai or the products or services offered for sale on www.ticketchai. Further, the company makes no representation that content provided on www.ticketchai is applicable to, or appropriate for use in, locations outside of Bangladesh. The Company and its Associates specifically disclaim all warranties, whether expressed or implied, including but not limited to warranties of title, merchantability or fitness for a particular purpose. No oral advice or written information given by the Company or its Associates shall create a warranty. Some states do not allow the exclusion or limitation of certain warranties, so the above limitation or exclusion may not apply to you. <br/><br/>

Under no circumstances shall the Company or its Associates be liable for any direct, indirect, incidental, special or consequential damages that result from your use of or inability to use the service, including but not limited to reliance by you on any information obtained from www.ticketchai website that results in mistakes, omissions, interruptions, deletion or corruption of files, viruses, delays in operation or transmission, or any failure of performance. The foregoing Limitation of Liability shall apply in any action, whether in contract, tort or any other claim, even if an authorized representative of the company has been advised of or should have knowledge of the possibility of such damages. <br/> <br/>

In addition, to the extent permitted by applicable law, we are not liable, and you agree not to hold The Ticket Chai and its Associates responsible, for any damages or losses (including, but not limited to, loss of money, goodwill or reputation, profits, or other intangible losses or any special, indirect, or consequential damages) resulting directly or indirectly from: <br/>
                                                            </p>
                                                            <p style="margin-left:10%;">
* Your use of or your inability to use our sites, services and tools;<br/>
* The content, actions, or inactions of third parties, including items listed using our sites, services, or tools or the destruction of allegedly fake items;<br/>
* A suspension or other action taken with respect to your account;<br/>
* The duration or manner in which your listings appear in search results as set forth in the Listing Conditions Section below;<br/>
* Your need to modify practices, content, or behavior or your loss of or inability to do business, as a result of changes to this User Agreement or our policies;<br/> The Company reserves the right to modify its policies and this User Agreement at any time consistent with the provisions outlined herein.
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num3}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>INDEMNITY</strong></h6>
                                                            <p>
                                                                You agree to indemnify and hold harmless The Company & Associates and The Service from any claim, action, demand, loss or damages (including legal fees) made or incurred by any third party arising out of or relating to content you upload, share, refer, your violation of these Terms of Service, or your violation of any rights of a third party.
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num4}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>ELIGIBILITY</strong></h6>
                                                            <p>
                                                                By using the service, you affirm that you are 18 years of age or older, or are an emancipated minor, or possess legal parental or guardian consent, and are competent to enter into the terms, conditions, obligations, affirmations, representations, and warranties set forth in these Terms of Service, and to abide by and comply with these Terms of Service. You affirm that you are over the age of 13, as the Service is not intended for children under the age of 13.
                                                            </p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num5}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>USER REGISTRATION AND OBLIGATION

</strong></h6>
                                                            <p>In order to use the service you must complete the registration process. You agree that any and all information provided during the registration process (Data you willingly provide for completion of registration as unique user herein referred as “Registration Data”) is true, accurate, up-to-date and complete. You also agree to update and maintain Registration data so that it is true, accurate, up-to-date and complete.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num6}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>
MEMBERS ACCOUNT, PASSWORD, AND SECURITY</strong></h6>
                                                            <p>Upon completing the registration process you will set a unique user ID and password for your account. You and you alone are solely responsible for maintaining the confidentiality of your password and information associated with your account that you desire to remain confidential. You also agree that you are responsible for any and all activities that may take place, or occur under your password and account. You further agree to notify the company in the event of your password or account has been used without the proper authorization or there are other breaches of security of which you become aware. You also agree to exit from your account at the end of each session. The company prohibits the sale or transfer of control of any www.ticketchai.org account by the registered account holder to any other individual or party.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num7}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>PRIVACY</strong></h6>
                                                            <p>We do not sell or rent your personal information to third parties for their marketing purposes without your explicit consent. We use your information only as described in www.ticketchai.org privacy policy. We view protection of users' privacy as a very important Community principle. We store and process your information on computers located in the United States that are protected by physical as well as technological security devices. You can access and modify the information you provide us and choose not to receive certain communications by signing in to your account. For a complete description of how we use and protect your personal information, see the www.ticketchai.org Privacy Policy. If you object to your information being transferred or used in this way please do not use the service.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num8}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>
AUTHORIZATION TO CONTACT YOU AND RECODING CALL</strong></h6>
                                                            <p>You authorize the Company, its affiliates, agents, and independent contractors to contact you at any telephone number (including telephone numbers associated with mobile, cellular, wireless, or similar devices), email, Mail at mailing address you provide to us or from which you place a call to us, or any telephone number, email address, mailing address at which we reasonably believe we may reach you, using any means of communication, including, but not limited to, calls, text messages and letters using an automatic telephone dialing system and/or prerecorded messages, even if you incur charges for receiving such communications.<br/><br/>

You understand and agree that the Company may, without further notice or warning and in its discretion, monitor or record telephone conversations you or anyone acting on your behalf has with the Company or its agents for quality control and training purposes or for its own protection. You acknowledge and understand that, while your communications with the Company may be overheard, monitored, or recorded without further notice or warning, not all telephone lines or calls may be recorded by the Company, and the Company does not guarantee that recordings of any particular telephone calls will be retained or retrievable.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num9}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>PRODUCT DISPLAY/COLORS</strong></h6>
                                                            <p>www.ticketchai.org attempts to display product images shown on the site as accurately as possible. However, we cannot guarantee that the color you see matches the product color, as the display of the color depends, in part, upon the monitor you are using.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num10}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>CONTENTS</strong></h6>
                                                            <p>When providing us with content or posting content on www.ticketchai.org, you grant us a non-exclusive, worldwide, perpetual, irrevocable, royalty-free, sublicensable (through multiple tiers) right to exercise any and all copyright, trademark, publicity, and database rights you have in the content, in any media known now or in the future.<br/><br/>

For the convenience of sellers/merchants, we may offer catalogs of stock images, descriptions and product specifications that are provided by third parties (including www.ticketchai.org users). You may use catalog content solely in connection with your www.ticketchai.org listings during the time your listings are on www.ticketchai.org or later.<br/><br/>

While we try to offer reliable data, we cannot promise that the catalogs will always be accurate and up-to-date, and you agree not to hold our catalog content providers or us responsible for inaccuracies in catalogs. If you choose to include catalog content in your listings, you continue to be fully responsible for your listings and for ensuring that your listings are accurate, do not include misleading information, and comply with this User Agreement and all www.ticketchai.org policies. The catalogs may include copyrighted, trademarked or other proprietary materials. You agree not to remove any copyright, proprietary or identification markings included with the catalogs or create any derivative works based on catalog content (other than by including them in your listings).</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num11}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>LISTING CONDITION</strong></h6>
                                                            <p>By listing an item on www.ticketchai.org, you agree to pay www.ticketchai.org fees, to assume full responsibility for the content of the listing and item offered, and to accept the following listing conditions: When you list an item on www.ticketchai.org, your listing will be posted on www.ticketchai.org and can be viewed in anywhere of the website. Your listing may not be immediately searchable by keyword or category for several hours (or up to 24 hours in some circumstances), so the company, the service or its associates can't guarantee exact listing durations. Where your listing appears in search and browse results may be based on certain factors including, but not limited to, listing format, title, bidding activity, end time, keywords, price and shipping cost, feedback, and detailed seller ratings. You can read more about where your listings appear in search and browse results in Help section of the website.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num12}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>
PURCHASE CONDITION</strong></h6>
                                                            <p>You are responsible for reading the full item listing, including any instructions the seller provides, before making a share to buy one unit of the same at BDT 1.00 (Bangladeshi Taka One only). If you make a commitment to buy or you are eligible to get the same at BDT 1.00 (Bangladeshi Taka One only) or is otherwise accepted, you enter into a legally binding contract with the seller and are obligated to purchase the item. For buyer's serious expression of interest in buying the seller's item and does not create a formal contract between the buyer and the seller.<br/><br/>

We do not transfer legal ownership of items from the seller to the buyer. Apply of the transfer of ownership between the buyer and the seller when the buyer and the seller agree.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num13}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>
ERRORS OF THE SERVICE</strong></h6>
                                                            <p>Prices and availability of products and services are subject to change without notice. Errors will be corrected where discovered, and the Company reserves the right to revoke any stated offer and to correct any errors, inaccuracies or omissions including after an order has been submitted and whether or not the order has been confirmed and your credit card charged. If your credit card has already been charged for the purchase and your order is cancelled, the Company will issue a credit to your credit card account in the amount of the charge. Individual bank policies will dictate when this amount is credited to your account. If you are not fully satisfied with your purchase, you may return it in accordance with www.ticketchai.org Return Policy.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num14}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>PRICING POLICY</strong></h6>
                                                            <p>Online prices and selection generally specified by the vendor of the respective product, but may vary. Prices and offers are subject to change.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num15}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>SALES TAX POLICY</strong></h6>
                                                            <p>You and only you are responsible for paying all government fees and applicable taxes associated with our sites, services, and tools with a valid payment method by the payment due date.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num16}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>
YOUR CONDUCT AND CONTENT</strong></h6>
                                                            <p style="margin-left: 10%;">* As a user of the service (i.e. www.ticketchai.org) you may upload, submit or create content to the service including text, image, expression and video. You understand that www.ticketchai.org does not guarantee any confidentiality with respect to the Content you submit.<br/>
* You (the Provider of content) shall be solely responsible for the Content submitted to the Service on by you or on your behalf. You affirm, represent, and warrant that you own or have the necessary licenses, rights, consents, and permissions to publish Content you submit; and you license to the service (www.ticketchai.org) all patent, trademarks, trace secret, copyright or other proprietary rights in and to such Content for publication on the Service pursuant to these Terms of Service.<br/>
* You further agree that Content submitted by you or on your behalf to the Service will not contain third-party copyrighted material, or material that is subject to other third party proprietary rights, unless you have permission from the rightful owner of the material or are otherwise legally entitled to post the material and to grant the service (i.e. www.ticketchai.org) all relevant licenses and permissions.<br/>
* www.ticketchai.org does not endorse any Content submitted to the Service by any user or any other licensor, or any opinion, recommendation, or advice expressed therein, and www.ticketchai.org expressly disclaims any and all liability in connection with Content. www.ticketchai.org does not permit copyright infringing activities of any kind including infringement of intellectual property rights on the Service, and the service will remove all Content if and when the Service is properly notified that infringing Content exists on the service. The Service reserves the right to remove any Content at any Time without prior notice.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num17}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>PROHIBITED USES</strong></h6>
                                                            <p>You shall not, and shall not authorize or encourage any third party to:</p><br/>
                                                            <p style="margin-left: 10%;">* Directly or indirectly generate queries, Referral Events, or impressions of or clicks on any Sponsored Like link through any automated, deceptive, fraudulent or other invalid means, including but not limited to through repeated manual clicks, the use of robots or other automated query tools and/or computer generated search requests, and/or the unauthorized use of other search engine optimization services and/or software;<br/>
* Edit, modify, filter, truncate or change the order of the information contained in any Sponsored Like Link ;<br/>
* Frame, minimize, remove or otherwise inhibit the full and complete display of any Web page accessed by an end user after clicking on any part of an Sponsored Like ("Advertiser Page");<br/>
* Redirect an end user away from any Advertiser Page provide a version of the Advertiser Page that is different from the page an end user would access by going directly to the Advertiser Page;<br/>
* Directly or indirectly access, launch, and/or activate Sponsored Like in any software application, Web site, or other means other than Your Property(ies), your twitter account and then only to the extent expressly permitted by this Agreement;<br/>
* Disseminate malware;<br/>
* Get your account suspended by Twitter/Facebook/Google and other as and when specified by the Company or the Service. Any or All suspension(s) will automatically cause www.ticketchai.org suspensions;<br/>
* Create a new account to use the Program after www.ticketchai.org has terminated this Agreement with You as a result of your breach of this Agreement;<br/>
* Engage in any action or practice that reflects poorly on www.ticketchai.org or otherwise disparages or devalues the Service’s reputation or goodwill.<br/>
* Any attempt to artificially generate clicks on your Sponsored Likes using automated software or by explicitly asking people to click on your Sponsored Likes.<br/>
* Wilfully post or create content disparaging a particular advertiser.<br/>
* Wilfully violate the terms and conditions of any of the platforms we work with including Twitter/Facebook/Google and other as and when specified by the Company or the Service.<br/>
* Attempt to disinter mediate content publishers or advertisers from the service.<br/>
* Act in any way that violates any Program Policies posted on the www.ticketchai.org Web Site, as may be revised from time to time, or any other agreement between You and the company.<br/>
</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num18}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>
GEETTING A PRODUCT AT BDT 1.00 (BANGLADESHI TAKA ONE ONLY)</strong></h6>
                                                            <p>You agree to provide www.ticketchai.org with information to enable your eligibility of getting specified products at BDT 1.00 (Bangladeshi Taka One only). This information may include:<br/>
                                                            </p><p style="margin-left:10%">
* National ID Card or Other Necessary Photo ID of the user.<br/>
* Legal name of the user.<br/>
* Contact number and email address of the user.<br/>
* Address of the user.<br/>
All products to get at BDT 1.00 (Bangladeshi Taka One only) on www.ticketchai.org which haven't been claimed within 90 days by providing such information to the company will be forfeited. You may get a product at BDT 1.00 (Bangladeshi Taka One only) on www.ticketchai.org is determined based on maximum number of your sponsored likes are to the advertiser.<br/>

If you get any product at BDT 1.00 (Bangladeshi Taka One only) on www.ticketchai.org You will not be eligible for getting a product at BDT 1.00 (Bangladeshi Taka One only) on www.ticketchai.org within 30 (thirty) days.</p>
                                                        </div>
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-left sitemap_terms">

                                                            <h4 class="">{{num19}}</h4>

                                                        </div>
                                                        <div class="media-body sitemap_terms">

                                                            <h6 style="font-size:18px;"><strong>GENERAL</strong></h6>
                                                            <p>The Service shall be deemed solely based in Bangladesh; and<br/>

The Service shall be deemed a passive website that does not give rise to personal jurisdiction over www.ticketchai.org. These Terms of Service shall be governed by the internal substantive laws of Peoples Republic of Bangladesh, without respect to its conflict of laws principles. Any claim or dispute between you and the service that arises in whole or in part from the Service shall be decided exclusively by a court of competent jurisdiction located in Dhaka, Bangladesh. These Terms of Service, together with the Privacy Notice at www.ticketchai.org/privacy and any other legal notices published by the company on www.ticketchai.org, shall constitute the entire agreement between you and www.ticketchai.org concerning the Service. If any provision of these Terms of Service is deemed invalid by a court of competent jurisdiction, the invalidity of such provision shall not affect the validity of the remaining provisions of these Terms of Service, which shall remain in full force and effect. No waiver of any term of this these Terms of Service shall be deemed a further or continuing waiver of such term or any other term, and www.ticketchai.org failure to assert any right or provision under these Terms of Service shall not constitute a waiver of such right or provision. The Company reserves the right to amend these Terms of Service at any time and without notice, and it is your responsibility to review these Terms of Service for any changes. Your use of the Service following any amendment of these Terms of Service will signify your assent to and acceptance of its revised terms. YOU AND www.ticketchai.org AGREE THAT ANY CAUSE OF ACTION ARISING OUT OF OR RELATED TO THE SERVICES MUST COMMENCE WITHIN ONE (1) YEAR AFTER THE CAUSE OF ACTION ACCRUES. OTHERWISE, SUCH CAUSE OF ACTION IS PERMANENTLY BARRED.</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="clearfix"></div>
                        <!-- ticketchai simple section starts here -->
                        <div class="section section-simple-close">
                            <div class="container">
                                <div class="row section_padd60">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-heading"></div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-content section_padd30 text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php include 'include/footer.php';?>


                </div>

                <!--   Core JS Files   -->
                <?php
        echo $cms->fotterJs(array('sitemap_terms'));
        echo $cms->angularJs(array('sitemapTerms_angular'));
        ?>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            // the body of this function is in assets/material-kit.js
                            //materialKit.initSliders();
                            $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);

                            window_width = $(window).width();

                            if (window_width >= 768) {
                                big_image = $('.wrapper > .header');

                                $(window).on('scroll', materialKitDemo.checkScrollForParallax);
                            }

                        });
                    </script>

                    <script type="text/javascript">
            $(document).ready(function () {
                $('#subscription').hide();
                setTimeout(function (a) {
                    $('#subscription').slideDown(1000);
                }, 15000);
                setTimeout(function (b) {
                    $('#subscription').slideUp(3000);
                }, 30000);
                $('#btn-sclose').click(function () {
                    $('#subscription').slideUp(1000);
                });

                $('#nav-search-btn').click(function () {
                    $('#nav-search-field').show();
                    $('#nav-search-btn').hide();
                });
                $('#nav-search-close').click(function () {
                    $('#nav-search-field').hide();
                    $('#rslt-div').hide();
                    $('#nav-search-btn').show();
                    $('#searchInput').val('');
                });
            });

            setTimeout(function () {
                $('#odometer1').html('50');
                $('#odometer2').html('100');
                $('#odometer3').html('200');
                $('#odometer4').html('10000');
            }, 1000);

        </script>
        <!--  Select Picker Plugin -->
        <!--searchbar script-->
    <script>
            $(document).ready(function () {
    
            $('.control').keyup(function () {

    // If value is not empty
    if ($(this).val().length == 0) {
    // Hide the element
    $('.show_hide').hide();
    } else {
    // Otherwise show it
    $('.show_hide').show();
    }
    }).keyup();
    });</script>
    <!--searchbar script-->
    </body>

    </html>