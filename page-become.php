<?php
    get_header('catalog') ;
$path = get_template_directory_uri();

$categories = get_terms( 'category' , [
    'orderby'           => 'name',
    'order'             => 'ASC',
    'hide_empty'        => false,
    'exclude'           => array(),
    'exclude_tree'      => array(),
    'include'           => array(),
    'fields'            => 'all',
    'slug'              => '',
    'parent'            => null,
    'hierarchical'      => false,
    'childless'         => false,
    'get'               => '',
    'name__like'        => '',
    'description__like' => '',
    'pad_counts'        => false,
    'offset'            => '',
    'search'            => '',
    'cache_domain'      => 'core'
] );

$texts = get_posts([
    'numberposts' => -1,
    'post_type' => 'textHome'
]);
?>


<div class="become-wr">

    <section class="become" id="become-pu-1">
        <div class="become-tit">
            <h1>Become a model</h1>
            <div>Step 1</div>
        </div>
        <div class="become-body">
            <form id="become-form-1" action="#">
                <h2 class="become-tit-sub">Basic model information</h2>
                <ul class="become-list">
                    <li>
                        <label for="become-fname">First name</label>
                        <input id="become-fname" name="become-fname" type="text" required>
                    </li>
                    <li>
                        <label for="become-lname">Last Name</label>
                        <input id="become-lname" name="become-lname" type="text" required>
                    </li>
                    <li>
                        <label for="become-sname">Scenic Name</label>
                        <input id="become-sname" name="become-sname" type="text" required>
                    </li>
                    <li>
                        <label for="become-age">Age</label>
                        <input id="become-age" name="become-age" type="text" maxlength="2" required>
                    </li>
                    <li>
                        <label for="become-phone">Phone</label>
                        <input id="become-phone" name="become-phone" type="tel" required>
                    </li>
                    <li>
                        <label for="become-mail">E-mail</label>
                        <input id="become-mail" name="become-mail" type="email" required>
                    </li>
                    <li class="centered">
                        <label for="become-city">City</label>
                        <input id="become-city" name="become-city" type="text" required>
                    </li>
                </ul>
                <div class="become-btn">
                    <input id="become-submit-1" type="submit" value="Next">
                </div>
            </form>
        </div>
    </section>

    <section class="become" id="become-pu-2">
        <div class="become-tit">
            <h1>Become a model</h1>
            <div>Step 2</div>
        </div>
        <div class="become-body">
            <form id="become-form-2" action="#">
                <h2 class="become-tit-sub">Model parameters</h2>
                <ul class="become-list">
                    <li>
                        <label for="become-height">Height: <span>160cm</span></label>
                        <input id="become-height" name="become-height" type="range" min="120" max="200" required>
                    </li>
                    <li>
                        <label for="become-bust">Bust: <span>90cm</span></label>
                        <input id="become-bust" name="become-bust" type="range" min="60" max="120" required>
                    </li>
                    <li>
                        <label for="become-waist">Waist: <span>60cm</span></label>
                        <input id="become-waist" name="become-waist" type="range" min="40" max="80" required>
                    </li>
                    <li>
                        <label for="become-hips">Hips: <span>90cm</span></label>
                        <input id="become-hips" name="become-hips" type="range" min="60" max="120" required>
                    </li>
                    <li>
                        <label for="become-hair">Hair</label>
                        <select id="become-hair" name="become-hair" required>
                            <option value=""></option>
                            <option value="Brunet">Brunet</option>
                            <option value="Red">Red</option>
                            <option value="Blond">Blond</option>
                            <option value="Brown">Brown</option>
                            <option value="Gray">Gray</option>
                            <option value="Other">Other</option>
                        </select>
                    </li>
                    <li>
                        <label for="become-eyes">Eyes</label>
                        <select id="become-eyes" name="become-eyes" required>
                            <option value=""></option>
                            <option value="Brown">Brown</option>
                            <option value="Blue">Blue</option>
                            <option value="Green">Green</option>
                            <option value="Yellow">Yellow</option>
                            <option value="Black">Black</option>
                            <option value="Grey">Grey</option>
                            <option value="Other">Other</option>
                        </select>
                    </li>
                </ul>
                <h2 class="become-tit-sub">Categories</h2>
                <ul class="become-cat">
                    <?php foreach ($categories as $category) : ?>

                        <?php
                        if($category->term_id == 1) continue; ?>

                        <li><label><input data-idcat="<?=$category->term_id?>" name="become-category" type="checkbox"><?=$category->name?></label></li>
                    <?php endforeach; ?>

                </ul>
                <div class="become-btn">
                    <input id="become-submit-2" type="submit" value="Next">
                </div>
            </form>
        </div>
    </section>

    <section class="become" id="become-pu-3">
        <div class="become-tit">
            <h1>Become a model</h1>
            <div>Step 3</div>
        </div>
        <div class="become-body">
            <form id="become-form-3" action="#">
                <h2 class="become-tit-sub">Model portfolio</h2>
                <ul class="become-list fw">
                    <li>
                        <input id="become-insta" name="become-insta" type="url" placeholder="Your Instagram profile" required>
                    </li>
                </ul>
                <div class="become-photo">
                    <div class="become-photo-dz" id="userActions">
                        <div class="become-photo-tit">Drop your photos there</div>
                        <div class="become-photo-imp">
                            Upload
                            <input name="become-photo" type="file" id="fileUpload" multiple>
                        </div>
                    </div>
                    <ul class="become-photo-ld" id="imges">

                    </ul>
                </div>
                <div class="become-about">
                    <textarea name="become-about" id="become-about" placeholder="Tell something about yourself" required></textarea>
                </div>
                <div class="become-pass">
                    Upload passport copy
                    <div class="become-pass-imp">
                        <input id="fileUploadPassport" name="become-passport" type="file">
                    </div>
                </div>
                <div class="become-agree">
                    <label><input name="become-agree" id="become-agree" type="checkbox" required>I agree to the terms of the public offer</label>
                </div>
                <div class="become-btn">
                    <input id="become-submit-3" type="submit" value="Done!">
                </div>
            </form>
            <div class="become-wait" id="become-wait">
                <div class="become-wait-iwr">
                    <img class="become-wait-logo" src="<?=$path?>/img/logo.svg" alt="">
                    <div class="become-wait-txt">Please wait a few seconds, your data is being processed...</div>
                </div>
            </div>
        </div>
    </section>

    <section class="become" id="become-pu-4">
        <div class="become-tit centered">
            <h1>Become a model</h1>
        </div>
        <div class="become-body paddings">
            <h2 class="become-tit-btn">Success!</h2>
            <p class="become-thanks">Thanks for your application.<br>Very soon, our managers will contact you,<br>stay in touch and have a nice day! </p>
            <div class="become-contact">
                <p class="become-quest">If you have any questions, you can always contact us:</p>
                <?php
                $email = get_post_meta($texts[0]->ID, 'email', true );
                $tel = get_post_meta($texts[0]->ID, 'tel', true );
                ?>
                <ul class="become-dest">
                    <li>Phone: <a href="tel:<?=$tel?>"><?=$tel?></a></li>
                    <li>Email: <a href="mailto:<?=$email?>"><?=$email?></a></li>
                </ul>
            </div>
        </div>
    </section>

</div>

<div class="become-rights">
    <div class="become-rights-txt">
        <div>
            <p><b>MODEL RELEASE AGREEMENT</b></p>
            <p><b>THIS AGREEMENT</b> (“Agreement”) is made and entered into this <span id="date-relise">_______</span><b>DATE</b>, between the company executing this Agreement where indicated below, its assignees, licensees and successors (the “Company”), and <span id="name-relise">_______</span>(“Legal Name”), known professionally as <b>N/A</b> (“Stage Name”), an individual resident in UKRAINE <b>COUNTRY</b> (“Model”).</p>
            <p>Project: <b>Studio and Selfie Photo Set</b></p>
            <p>Date: <span id="date-relise">_______</span></p>
            <p><b>WITNESSETH:</b></p>
            <p><b>WHEREAS</b>, the Company is engaged in the business of producing or photographing explicit content, and Model wishes to perform modeling services for Company in exchange for the consideration agreed upon herein.</p>
            <p><b>NOW, THEREFORE</b>, for and in consideration of the amount set forth herein to each party by the other party, and other good and valuable consideration, the receipt of which is hereby acknowledged, the parties hereto do agree and acknowledge as follows:</p>
            <p><b>SECTION A. SERVICES</b></p>
            <p>Model agrees to photograph pictures and record videos of herself - and to appear in marketing and various social profiles which may include dating profiles under the direction of Company or any agent of Company, including without limitation any photographer, director or producer acting on behalf of Company..</p>
            <p>Model agrees to provide various pictures that may have been posted on Instagram or other Social Media of herself – which has already been shot before this agreement has been signed. Model acknowledges that the pictures provided to Company will appear in marketing and various social profiles which may include dating profiles under the direction of Company or any agent of Company, including without limitation any photographer, director or producer acting on behalf of Company.</p>
            <p><b>SECTION B. PAYMENTS</b></p>
            <p>In consideration of and in full payment for the performance of the services and the rights and licenses granted in this Agreement, the Company agrees to pay Model the following Sum <b>$20</b>
            <p><b>SECTION C. LICENSE</b></p>
            <p>1. Model grants to Company the absolute worldwide and perpetual right and license, under Model’s rights of publicity, privacy, and all other rights, to copyright, use, publish, publicly display and perform, copy, distribute in any media (including without limitation any electronic media), market and sublicense, all portraits, pictures, images, sounds, and likenesses of Model captured or recorded by herself, including modifications, derivations and composites thereof (the “Content”) in any form, format or medium, including without limitation photographs, videos, DVD’s, internet streaming video and any other digital or non-digital formats, whether now known or hereafter invented. Company may exercise its rights in the Content; including without limitation its rights to alter and combine the Content, for any purpose whatsoever without further compensation. This Section C.1 shall survive any termination of this Agreement.</p>
            <p>2. All Content, in whatever photographic, video, audio, digital or other form or format, shall constitute the sole and exclusive property of Company, and the Company shall own all rights, title and interest, including all intellectual property rights therein. Model agrees that (i) Model has no rights in the Content or in the proceeds from exploitation of the Content, (ii) Model will not assert any rights in or to the Content (including any “moral rights”, which Model expressly waives), and (iii) Model has not granted any rights that would conflict with the grant of rights herein.</p>
            <p>3. Model grants to Company the absolute right to use, in any context in Company’s sole discretion, in conjunction with the Content or its exploitation, any printer or verbal matter of any kind, including without limitation Model’s biography, pictures, audio recordings or other items provided by Model, any printed or verbal matter from any source other than Model, and any audio or visual content provided by others (which may be used, without limitation, to “double” or “dub” any performance attributed to Model). Model shall have no right whatsoever to review or approve any such use.</p>
            <p>4. As part of (and without limiting) the foregoing grant, Model expressly grants to Company all rights (including without limitation privacy and publicity rights) to identify Model in connection with any permitted Company use of the Content by Model’s Stage Name, as shown in the first paragraph above, and by any other legal, fictitious or stage name which Model has used or now or in the future uses publicly (including any trademarked names) in connection with modeling or other commercial or professional activities.</p>
            <p><b>SECTION D. REPRESENTATIONS</b></p>
            <p>1. Model hereby warrants that Model is above 18 (eighteen) years of age and has every right to contract in Model’s own name in the above regard. Model further states that Model has read the above authorization, release, and agreement prior to its execution, and that Model is fully familiar with the contents thereof.</p>
            <p>2. Model represents that all poses, positions and situations enacted (including those which involve restraint, fictional depictions of captivity, bondage and other such situations) pursuant to this Agreement, including without limitation such poses, positions and situations captured in the Content, were entered into of Models own free will, and without any force, coercion or threat whatsoever and that Model was not under the influence of any alcoholic or intoxicating substances at the time.</p>
            <p>3. Model has the right at any time to terminate any session without fear of any force, coercion or threat whatsoever. Model furthermore agrees to release the Company from all accusation of such force or coercion by the Company or its agents. Model understands that he or she shall not be entitled to payment for any session or services terminated by Model.</p>
            <p><b>4. MODEL ACKNOWLEDGES THAT COMPANY IS ENGAGED IN THE SALE AND DISTRIBUTION OF EXPLICIT MATERIALS AND MODEL WILL APPEAR IN MARKETING AND VARIOUS SOCIAL PROFILES WHICH MAY INCLUDE DATING PROFILES UNDER THE DIRECTION OF COMPANY OR ANY AGENT OF COMPANY, INCLUDING WITHOUT LIMITATION ANY PHOTOGRAPHER, DIRECTOR OR PRODUCER ACTING ON BEHALF OF COMPANY.</b></p>
            <p><b>SECTION E. MISCELLANEOUS</b></p>
            <p>1. This Agreement may be terminated by Company on notice to Model and without further payment to Model in the event that Model is, or appears to be, unable, unfit or unwilling to perform the services, if Model is involved in abuse of alcohol, drugs or other controlled substances, or if Model is charged with or proven guilty of any criminal act during the performance of Model’s services pursuant to this Agreement.</p>
            <p>2. Model is an independent contractor. Nothing in this Agreement shall be construed as creating any agency or employment relationship between Model and the Company. Model shall be responsible for all taxes related to the payments hereunder, and shall not be entitled to any employment-related benefits.</p>
            <p>3. This Agreement, and the rights contained herein, may be licensed, sold, or assigned by Company to any person or entity, without notification to or consent of Model and without further compensation to Model. Specifically, Model acknowledges that the rights, licenses and releases, as well as the representations of Model, granted and made herein extend to Company’s successors, licensees (including distributors) and assigns, and Model intends that they shall each and all benefit there from. Model’s rights and obligations hereunder are personal and non-assignable.</p>
            <p>4. In the event that any term or condition of this Agreement or the application thereof to any circumstance or situation shall be invalid or unenforceable in whole or in part, the remainder shall not be affected thereby.</p>
            <p>5. This Agreement shall be performed in UKRAINE <b>COUNTRY</b>. Notwithstanding the principles of conflicts of law, the internal laws of said state shall govern the interpretation and enforcement of this Agreement. All disputes between Model (and Model’s respective attorneys, successors, and assigns) of any kind whatsoever, arising from the transaction reflected in this Agreement (hereinafter “Arbitral Claims”) shall be resolved by arbitration (“Arbitration”). Arbitral Claims shall include, but are not limited to, contract and tort claims of all kinds, and all claims based on any federal, state or local law, statute or regulation, excepting only claims under applicable workers’ compensation law and unemployment insurance claims. Arbitration shall be final and binding upon the parties and shall be the exclusive remedy for all Arbitral Claims. THE PARTIES HEREBY WAIVE ANY RIGHTS THEY MAY HAVE TO A TRIAL BY JURY IN REGARD TO ARBITRABLE CLAIMS. Arbitration of Arbitral Claims shall be conducted in accordance with the Employment Dispute Resolution Rules of the American Arbitration Association. The prevailing party in any such Arbitration shall be entitled to recover its reasonable attorney’s fees and expenses. <b>IN WITNESS WHEREOF</b>, the parties hereto, intending to be legally bound, have executed this Agreement by their signatures below.</p>
            <p><b>MODEL</b>: (sign & print Legal name)</p>
            <p>Signature: <span id="signature-relise">_____________</span></p>
            <p>Print Name: <span id="fio-relise">____________</span></p>
            <p>Address: ___________________________________________</p>
            <p>___________________________________________</p>
            <p>Telephone Number: <span id="phone-relise">_______</span></p>
            <p>Email Address (if any): <span id="email-relise">_______</span></p>
            <p><b>COMPANY:</b></p>
            <p>ROKE MEDIA LTD</p>
            <p><img src="<?=$path?>/img/sign.png" alt=""></p>
            <p>Kevin Møller Mysing</p>
            <p><i>Director</i></p>
        </div>
        <div>
            <p><b>МОДЕЛЬНЫЙ РЕЛИЗ</b></p>
            <p><b>ЭТО СОГЛАШЕНИЕ</b>  (“Соглашение”) заключено и  вступает в силу <span id="date-relise">_______</span> <b>ДАТА</b>, между компанией, исполняющей настоящее Соглашение, указанной ниже, ее исполнителей, официальных представителей, лицензиатов, преемников (“Компания”), и <span id="name-relise">_______</span> (“Юридическое название”), известный как  <b>N/A</b> (“Сценическое имя”), проживающий в Украине <b>СТРАНА</b> (“Модель”).</p>
            <p>Проект:  <b>Studio and Selfie Photo Set</b></p>
            <p>Дата: <span id="date-relise">_______</span></p>
            <p><b>УДОСТОВЕРЯЕТ:</b></p>
            <p><b>ПРИНИМАЯ ВО ВНИМАНИЕ</b>, что Компания занимается производством или фотографированием откровенного контента, и Модель желает оказывать услуги по моделированию для Компании в обмен на вознаграждение, согласованное в настоящем документе.</p>
            <p><b>ТЕПЕРЬ, ПОЭТОМУ</b>, в отношении и с учетом суммы, указанной в настоящем документе для каждой стороны другой стороной, и других вознаграждений, получение которых настоящим подтверждается, стороны настоящего Соглашения соглашаются и подтверждают следующее:</p>
            <p><b>РАЗДЕЛ A. УСЛУГИ</b></p>
            <p>Модель соглашается делать фотографии и записывать видео о себе - и появляться в маркетинговых и различных социальных профилях, которые могут включать в себя профили знакомств под руководством Компании или любого агента Компании, в том числе любого фотографа, режиссера или продюсера, действующего от имени Компании.</p>
            <p>Модель соглашается предоставить различные фотографии, которые могли быть размещены в Instagram или других социальных сетях, - которые уже были сняты до подписания этого соглашения. Модель осведомлена, что предоставленные Компании фотографии будут появляться в маркетинговых и различных социальных профилях, которые могут включать в себя профили знакомств под руководством Компании или любого агента Компании, в том числе любого фотографа, режиссера или продюсера, действующего от имени Компании.</p>
            <p><b>РАЗДЕЛ B. ПЛАТЕЖИ</b></p>
            <p>В качестве вознаграждения за предоставление услуг, а также прав и лицензий, предоставленных в настоящем Соглашении, Компания соглашается оплатить Модели следующую сумму в размере <b>20 долларов США</b>.
            <p><b>РАЗДЕЛ C. ЛИЦЕНЗИЯ</b></p>
            <p>1. Модель предоставляет Компании абсолютное и бессрочное право и лицензию, в соответствии с правами Модели на публичность, конфиденциальность и другими авторскими правами, на использование, публикацию, копирование, распространение на любых носителях (включая, без ограничения, любые электронные СМИ),, все портреты, фотографии, изображения, звуки Модели, снятые или записанные ею, включая их модификации, деривации и композиции («Контент») в любой форме, формате или на любом носителе, включая, без ограничений, фотографии, видео, DVD-диски, потоковое видео в Интернете и любые другие цифровые или не цифровые форматы, известные сейчас или изобретенные в дальнейшем. Компания может осуществлять свои права на Контент; включая, без ограничений, права изменять и объединять Контент для любых целей без какой-либо компенсации. Этот раздел C.1 остается в силе после прекращения действия настоящего Соглашения.</p>
            <p>2. Весь Контент, в какой бы то ни было фотографической, видео, аудио, цифровой или другой форме или формате, является исключительной собственностью Компании, и Компания должна владеть всеми правами, правами собственности и интересами, включая все права на интеллектуальную собственность. Модель соглашается с тем, что (i) Модель не имеет прав на Контент или доходы от использования Контента, (ii) Модель не будет отстаивать какие-либо права на Контент (включая любые «моральные права», от которых Модель явно отказывается) и (iii) Модель не имеет каких-либо прав, которые могли бы противоречить предоставлению прав в данном документе.</p>
            <p>3. Модель предоставляет Компании абсолютное право использовать в любом контексте по собственному усмотрению Компании, в сочетании с Контентом, любой тип печатных или словесных материалов любого рода, включая, без ограничения, биографию, фотографии, аудиозаписи или другие предоставленные Моделью данные, любой печатный или устный материал из любого источника, кроме как предоставленных Моделью, и любой аудио- или визуальный контент, предоставленный другими сторонами (который может использоваться, без ограничения, для «удвоения» или «дублирования» любого размещения, приписанного Модели). Модель не имеет права пересматривать или утверждать любое такое использование.</p>
            <p>4. В рамках (и не ограничиваясь) вышеупомянутого предоставления прав, Модель явно предоставляет Компании все права (включая без ограничения права на конфиденциальность и публичность) на идентификацию Модели в связи с любым разрешенным использованием Компанией Контента по Сценическому имени Модели, как показано в первом абзаце соглашения, и под любым другим юридическим, вымышленным или сценическим именем, которое Модель использовала или использует в настоящее время или в будущем публично (включая любые торговые марки) в связи с моделингом или другой коммерческой или профессиональной деятельностью.</p>
            <p><b>РАЗДЕЛ D. ПРЕДСТАВИТЕЛЬСТВА</b></p>
            <p>1. Настоящим Модель гарантирует, что Модель старше 18 (восемнадцати) лет и имеет полное право заключать контракты от собственного имени. Модель также заявляет, что Модель ознакомилась с указанным выше до своего выполнения, и что Модель полностью знакома с содержанием данного соглашения.</p>
            <p>2. Модель представляет собой, что все позы, позиции и ситуации, принятые (включая те, которые связаны с ограничением, вымышленными изображениями плена, рабства и других подобных ситуаций) в соответствии с настоящим Соглашением, включая без ограничения такие позы, позиции и ситуации, захваченные в содержании, были введены в модели по собственной воле и без какой-либо силы, принуждения или угрозы вообще, и что модель не находилась под влиянием каких-либо алкогольных или опьяняющих веществ в то время.</p>
            <p>3. Модель имеет право в любое время прекратить любой сеанс, не опасаясь какой-либо силы, принуждения или угрозы. Модель также соглашается освободить компанию от всех обвинений в такой силе или принуждении со стороны компании или ее агентов. Модель понимает, что он или она не имеет права на оплату любого сеанса или услуг, прекращенных моделью.</p>
            <p><b>4. МОДЕЛЬ ПРИЗНАЕТ, ЧТО КОМПАНИЯ ЗАНИМАЕТСЯ ПРОДАЖЕЙ И РАСПРОСТРАНЕНИЕМ ОТКРОВЕННЫХ МАТЕРИАЛОВ, И МОДЕЛЬ ПОЯВИТСЯ В МАРКЕТИНГЕ И РАЗЛИЧНЫХ СОЦИАЛЬНЫХ ПРОФИЛЯХ, КОТОРЫЕ МОГУТ ВКЛЮЧАТЬ В СЕБЯ ПРОФИЛИ ЗНАКОМСТВ ПОД РУКОВОДСТВОМ КОМПАНИИ ИЛИ ЛЮБОГО АГЕНТА КОМПАНИИ, ВКЛЮЧАЯ, БЕЗ ОГРАНИЧЕНИЙ, ЛЮБОГО ФОТОГРАФА, ДИРЕКТОРА ИЛИ ПРОДЮСЕРА, ДЕЙСТВУЮЩЕГО ОТ ИМЕНИ КОМПАНИИ.</b></p>
            <p><b>РАЗДЕЛ Е. РАЗНОЕ</b></p>
            <p>1.  Настоящее Соглашение может быть расторгнуто Компанией по уведомлению Модели и без дальнейшей оплаты Модели, если Модель не может или не может быть не в состоянии оказывать услуги, если Модель вовлечена в злоупотребление алкоголем, наркотиками или другие контролируемые вещества, или если Модель обвиняется или доказывает свою вину в каком-либо преступном деянии во время оказания услуг Модели в соответствии с настоящим Соглашением.</p>
            <p>2. Модель является независимым подрядчиком. Ничто в настоящем Соглашении не должно толковаться как создание каких-либо агентских или трудовых отношений между моделью и компанией. Модель несет ответственность за все налоги, связанные с выплатами по настоящему Договору, и не имеет право ни на какие пособия.</p>
            <p>3. Настоящее соглашение и права, содержащиеся в нем, могут быть лицензированы, проданы или переданы компанией любому физическому или юридическому лицу без уведомления или согласия модели и без дополнительной компенсации модели. В частности, модель признает, что права, лицензии и релизы, а также представления модели, предоставленные и сделанные в настоящем документе, распространяются на правопреемников компании, лицензиатов (включая дистрибьюторов) и цессионариев, и модель намерена, чтобы они все и каждый извлекали из этого выгоду. Права и обязанности модели по настоящему договору являются личными и не могут быть уступлены.</p>
            <p>4.  В случае, если какое-либо условие или сроки  настоящего Соглашения или его применение к какому-либо обстоятельству или ситуации является недействительным или не имеющим законной силы полностью или частично, это не влияет на остальную часть.</p>
            <p>5.  Настоящее Соглашение заключается в Украине СТРАНА. Независимо от принципов коллизионного права толкование и применение настоящего Соглашения регулируются внутренним законодательством указанного государства. Все споры между моделью (и ее соответствующими поверенными, правопреемниками и правопреемниками) любого рода, возникающие в связи со сделкой, отраженной в настоящем Соглашении (далее - “арбитражные требования”), разрешаются путем арбитража (далее - “арбитраж”). Арбитражные иски включают, но не ограничиваются, контрактные и деликтные иски всех видов, а также все иски, основанные на любом федеральном, государственном или местном законе, законе или постановлении, за исключением только исков в соответствии с применимым законодательством о компенсации работникам и страховании от безработицы. Арбитраж является окончательным и обязательным для сторон и является исключительным средством правовой защиты по всем арбитражным искам. НАСТОЯЩИМ СТОРОНЫ ОТКАЗЫВАЮТСЯ ОТ ЛЮБЫХ ПРАВ, КОТОРЫЕ ОНИ МОГУТ ИМЕТЬ НА РАССМОТРЕНИЕ ДЕЛА ПРИСЯЖНЫМИ В ОТНОШЕНИИ АРБИТРАЖНЫХ ИСКОВ. Арбитраж арбитражных исков проводится в соответствии с правилами разрешения трудовых споров американской арбитражной ассоциации. Выигравшей стороной в любом таком арбитраж имеет право на возмещение и судебные расходы. <b>В удостоверение чего</b> стороны настоящего Соглашения, намереваясь быть юридически связанными, подписали настоящее Соглашение ниже.</p>
            <p><b>МОДЕЛЬ:</b>(подпись и печать юридической организации)</p>
            <p>Подпись:</p>
            <p><span id="signature-relise">_____________</span></p>
            <p>ФИО:</p>
            <p><span id="fio-relise">_____________</span></p>
            <p>Адрес:</p>
            <p>______________________________________________</p>
            <p>_____________________________________________</p>
            <p>Мобильный телефон:</p>
            <p><span id="phone-relise">_____________</span></p>
            <p>Электронный адрес (если есть):</p>
            <p><span id="email-relise">_____________</span></p>
            <p><b>КОМПАНИЯ:</b></p>
            <p>ROKE MEDIA LTD</p>
            <p><img src="<?=$path?>/img/sign.png" alt=""></p>
            <p>Kevin Møller Mysing</p>
            <p><i>Директор</i></p>
        </div>
    </div>
    <div class="become-rights-btn"><a id="rights-accept" href="#">Accept</a></div>
</div>

    <script src="<?=$path?>/js/become.js"></script>
    <script src="<?=$path?>/js/drag-a-drop.js"></script>
<?php
get_footer();