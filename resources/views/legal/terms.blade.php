@php
    $isRtl     = app()->getLocale() === 'ar';
    $otherLang = $isRtl ? 'en' : 'ar';
    $toggleUrl = request()->fullUrlWithQuery(['lang' => $otherLang]);
    $toggleLbl = $isRtl ? 'English' : 'العربية';
    $title     = $isRtl ? 'الشروط والأحكام — جنّة للخدمات' : 'Terms & Conditions — Janna Services';
    $metaDesc  = $isRtl
        ? 'الشروط والأحكام التي تحكم استخدام تطبيق جنّة للخدمات.'
        : 'Terms and Conditions governing the use of the Janna Services mobile application.';
@endphp
<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $metaDesc }}">
    @if ($isRtl)
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    @endif
    <style>
        :root {
            --brand-primary: #0F4C45;
            --brand-secondary: #F2A11F;
            --text: #1f2937;
            --muted: #6b7280;
            --bg: #f7f8fa;
            --card: #ffffff;
            --border: #e5e7eb;
        }
        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body {
            font-family: {{ $isRtl ? "'Cairo'," : '' }} system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: var(--text);
            background: var(--bg);
            line-height: 1.75;
            -webkit-font-smoothing: antialiased;
        }
        .legal-header {
            background: linear-gradient(135deg, var(--brand-primary), #1a6b62);
            color: #fff;
            padding: 2.25rem 1rem;
            text-align: center;
            position: relative;
        }
        .legal-header h1 {
            margin: 0 0 .35rem;
            font-size: 1.85rem;
            font-weight: 800;
            letter-spacing: -.01em;
        }
        .legal-header .brand { font-weight: 600; opacity: .95; }
        .legal-header .updated {
            margin-top: .35rem;
            font-size: .9rem;
            opacity: .9;
        }
        .lang-toggle {
            position: absolute;
            top: 1rem;
            {{ $isRtl ? 'left' : 'right' }}: 1rem;
            background: rgba(255,255,255,.18);
            color: #fff;
            border: 1px solid rgba(255,255,255,.4);
            padding: .35rem .85rem;
            border-radius: 999px;
            font-size: .85rem;
            font-weight: 600;
            text-decoration: none;
            backdrop-filter: blur(4px);
            transition: background .15s;
        }
        .lang-toggle:hover { background: rgba(255,255,255,.3); }
        .legal-wrap {
            max-width: 820px;
            margin: -1.25rem auto 2.5rem;
            padding: 0 1rem;
        }
        .legal-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.75rem 1.5rem;
            box-shadow: 0 4px 18px rgba(0,0,0,.04);
        }
        .legal-card h2 {
            color: var(--brand-primary);
            font-size: 1.2rem;
            margin: 1.75rem 0 .55rem;
            font-weight: 700;
            border-bottom: 1px solid var(--border);
            padding-bottom: .4rem;
        }
        .legal-card h2:first-of-type { margin-top: .25rem; }
        .legal-card p, .legal-card li { font-size: 1rem; }
        .legal-card ul {
            padding-{{ $isRtl ? 'right' : 'left' }}: 1.25rem;
            padding-{{ $isRtl ? 'left' : 'right' }}: 0;
            margin: .5rem 0 1rem;
        }
        .legal-card li { margin-bottom: .35rem; }
        .legal-card a {
            color: var(--brand-primary);
            text-decoration: none;
            border-bottom: 1px solid rgba(15,76,69,.3);
        }
        .legal-card a:hover { border-bottom-color: var(--brand-primary); }
        .legal-intro {
            background: rgba(15,76,69,.06);
            border-{{ $isRtl ? 'right' : 'left' }}: 4px solid var(--brand-primary);
            padding: .9rem 1rem;
            border-radius: 8px;
            margin-bottom: 1.25rem;
        }
        .legal-footer {
            text-align: center;
            color: var(--muted);
            font-size: .85rem;
            padding: 1.25rem 1rem 2rem;
        }
        .legal-footer a { color: var(--muted); text-decoration: none; }
        .legal-footer a:hover { color: var(--brand-primary); }
        @media (max-width: 540px) {
            .legal-header { padding: 1.75rem 1rem 2rem; }
            .legal-header h1 { font-size: 1.5rem; }
            .legal-card { padding: 1.25rem 1rem; border-radius: 12px; }
            .legal-card h2 { font-size: 1.05rem; }
            .legal-card p, .legal-card li { font-size: .96rem; }
            .lang-toggle { top: .6rem; padding: .25rem .7rem; font-size: .78rem; }
        }
    </style>
</head>
<body>
    <header class="legal-header">
        <a href="{{ $toggleUrl }}" class="lang-toggle" rel="alternate" hreflang="{{ $otherLang }}">{{ $toggleLbl }}</a>
        <h1>{{ $isRtl ? 'الشروط والأحكام' : 'Terms &amp; Conditions' }}</h1>
        <div class="brand">{{ $isRtl ? 'جنّة للخدمات' : 'Janna Services' }}</div>
        <div class="updated">{{ $isRtl ? 'آخر تحديث: 21 مايو 2026' : 'Last updated: May 21, 2026' }}</div>
    </header>

    <main class="legal-wrap">
        <article class="legal-card">
            @if ($isRtl)
                <div class="legal-intro">
                    مرحبًا بك في <strong>جنّة للخدمات</strong>. تحكم هذه الشروط والأحكام ("الشروط") وصولك إلى تطبيق جنّة للخدمات والخدمات المرتبطة به (يُشار إليها مجتمعةً بـ "التطبيق") واستخدامك له. من خلال تنزيل التطبيق أو تثبيته أو استخدامه، فإنك توافق على الالتزام بهذه الشروط. وإذا كنت لا توافق، يُرجى التوقف عن استخدام التطبيق.
                </div>

                <h2>1. عن التطبيق</h2>
                <p>جنّة للخدمات هو دليل خدمات مجتمعي يعرض مزودي الخدمات والفئات وأرقام الهواتف المهمة والإعلانات والعروض. التطبيق مخصص كأداة إعلامية واكتشافية فقط. <strong>لا تقدم جنّة للخدمات بشكل مباشر</strong> الخدمات المعروضة؛ بل تربط المستخدمين فقط بمزودي خدمات خارجيين مستقلين.</p>

                <h2>2. الأهلية واستخدام التطبيق</h2>
                <p>باستخدامك للتطبيق، فإنك تؤكد أن عمرك 13 عامًا على الأقل (أو السن القانوني الأدنى في ولايتك القضائية) وأنك قادر على إبرام اتفاقية ملزمة. توافق على استخدام التطبيق فقط لأغراض قانونية وشخصية وغير تجارية، وبما يتوافق مع هذه الشروط وأي قوانين معمول بها.</p>

                <h2>3. مزودو الخدمات الخارجيون</h2>
                <p>جميع مزودي الخدمات المعروضين في التطبيق هم أطراف خارجية مستقلة. لا توظف جنّة للخدمات أي مزود ولا تشرف عليه ولا تصادق عليه ولا تعتمده ولا تضمنه. وأي اتفاقية أو معاملة أو دفعة أو نزاع بينك وبين المزود هو شأن خاص بكما. وأنت وحدك المسؤول عن تقييم المزودين قبل التواصل معهم أو التعامل معهم.</p>

                <h2>4. دقة المعلومات</h2>
                <p>نحرص على إبقاء جميع المعلومات في التطبيق — بما في ذلك تفاصيل المزودين وأرقام الهواتف والعناوين والفئات والإعلانات والعروض — دقيقة ومحدّثة. ومع ذلك، يتم تقديم المحتوى "كما هو" دون أي ضمان من أي نوع. قد تتغير المعلومات أو تكون غير مكتملة أو تحتوي على أخطاء. ويجب عليك التحقق بشكل مستقل من أي تفصيل قبل الاعتماد عليه.</p>

                <h2>5. مسؤولية المستخدم</h2>
                <p>أنت مسؤول عن:</p>
                <ul>
                    <li>قرارك بالتواصل أو التعامل أو التعاقد مع أي مزود خارجي معروض في التطبيق.</li>
                    <li>دقة المعلومات التي تشاركها عند التواصل مع المزودين.</li>
                    <li>الالتزام بجميع القوانين واللوائح المعمول بها أثناء استخدام التطبيق.</li>
                    <li>الحفاظ على أمان الجهاز الذي تم تثبيت التطبيق عليه.</li>
                </ul>

                <h2>6. الروابط الخارجية والاتصال</h2>
                <p>يتيح لك التطبيق التواصل مع المزودين والوصول إلى المعلومات عبر المكالمات الهاتفية أو واتساب أو المواقع الإلكترونية أو وسائل التواصل الاجتماعي أو الروابط الخارجية الأخرى. هذه الإجراءات تفتح تطبيقات أو خدمات خارجية <strong>غير مملوكة لجنّة للخدمات وغير مُشغَّلة من قبلها</strong>. ولسنا مسؤولين عن محتوى أو سلوك أو توافر أو رسوم أو ممارسات الخصوصية لأي وجهة خارجية. ويخضع استخدامها لشروطها الخاصة.</p>

                <h2>7. الأنشطة المحظورة</h2>
                <p>توافق على <strong>عدم</strong>:</p>
                <ul>
                    <li>استخدام التطبيق لأي غرض غير قانوني أو احتيالي أو ضار أو مسيء.</li>
                    <li>مضايقة أي مزود خدمة أو مستخدم آخر أو تهديده أو التشهير به أو إيذائه.</li>
                    <li>محاولة الوصول غير المصرح به إلى التطبيق أو خوادمه أو الأنظمة المرتبطة به.</li>
                    <li>إجراء هندسة عكسية للتطبيق أو فك تشفيره أو تعديله أو إنشاء أعمال مشتقة منه.</li>
                    <li>كشط أو نسخ أو إعادة توزيع قوائم المزودين أو أي محتوى آخر في التطبيق دون إذن.</li>
                    <li>تحميل أو نقل فيروسات أو برامج ضارة أو أي أكواد خبيثة.</li>
                    <li>التدخل في تشغيل التطبيق أو استمتاع المستخدمين الآخرين به.</li>
                </ul>

                <h2>8. الملكية الفكرية</h2>
                <p>التطبيق، بما في ذلك اسمه وشعاره وتصميمه وكوده المصدري ونصوصه ورسوماته وأي محتوى آخر (باستثناء المحتوى المملوك لمزودي الخدمات الخارجيين)، هو ملك لجنّة للخدمات ومحمي بموجب قوانين حقوق النشر والعلامات التجارية وغيرها من قوانين الملكية الفكرية. تُمنح لك ترخيصًا محدودًا وغير حصري وغير قابل للنقل وقابلًا للإلغاء لاستخدام التطبيق لأغراض شخصية وغير تجارية فقط. وجميع الحقوق الأخرى محفوظة.</p>

                <h2>9. الإعلانات والعروض والترويج</h2>
                <p>الإعلانات والعروض المعروضة في التطبيق مقدمة من مزودي خدمات أو شركاء خارجيين. ولا تضمن جنّة للخدمات توافر أي عرض أو سعره أو شروطه أو جودته. وتُجرى جميع المعاملات الناتجة عن هذه العروض مباشرة بينك وبين المزود المعني.</p>

                <h2>10. تحديد المسؤولية</h2>
                <p>إلى أقصى حد يسمح به القانون، <strong>لا تتحمل</strong> جنّة للخدمات ومالكوها وموظفوها والشركات التابعة لها أي مسؤولية عن أي أضرار مباشرة أو غير مباشرة أو عرضية أو خاصة أو تبعية أو عقابية — بما في ذلك على سبيل المثال لا الحصر فقدان الأرباح أو البيانات أو السمعة أو أي خسائر غير ملموسة أخرى — الناتجة عن:</p>
                <ul>
                    <li>استخدامك للتطبيق أو عدم قدرتك على استخدامه.</li>
                    <li>أي تفاعل أو معاملة أو نزاع مع مزود خدمة خارجي.</li>
                    <li>الأخطاء أو عدم الدقة أو الإغفال في محتوى التطبيق.</li>
                    <li>الوصول غير المصرح به إلى جهازك أو بياناتك أو تعديلها.</li>
                    <li>أي رابط أو تطبيق أو خدمة خارجية يتم الوصول إليها عبر التطبيق.</li>
                </ul>
                <p>يتم تقديم التطبيق على أساس "كما هو" و"كما هو متاح" دون أي ضمانات من أي نوع، صريحة أو ضمنية.</p>

                <h2>11. التعويض</h2>
                <p>توافق على تعويض جنّة للخدمات والشركات التابعة لها وحمايتها من أي مطالبة أو طلب أو أضرار — بما في ذلك أتعاب المحاماة المعقولة — الناشئة عن استخدامك للتطبيق أو تفاعلاتك مع مزودي الخدمات الخارجيين أو انتهاكك لهذه الشروط أو أي قانون معمول به.</p>

                <h2>12. الإيقاف والإنهاء</h2>
                <p>يجوز لنا تعليق وصولك إلى التطبيق أو تقييده أو إنهائه في أي وقت، بإشعار أو بدون إشعار، إذا اعتقدنا أنك انتهكت هذه الشروط أو أسأت استخدام التطبيق أو انخرطت في سلوك قد يضر بجنّة للخدمات أو مستخدميها أو أطراف ثالثة.</p>

                <h2>13. التغييرات على هذه الشروط</h2>
                <p>قد نقوم بتحديث هذه الشروط من وقت لآخر لتعكس التغييرات في التطبيق أو خدماتنا أو القوانين المعمول بها. وسيعكس تاريخ "آخر تحديث" في الأعلى دائمًا أحدث مراجعة. وسيتم إبراز التغييرات الجوهرية داخل التطبيق عند الاقتضاء. واستمرارك في استخدام التطبيق بعد التحديث يعني قبولك للشروط المعدلة.</p>

                <h2>14. القانون الحاكم</h2>
                <p>تخضع هذه الشروط وتُفسَّر وفقًا لقوانين الولاية القضائية التي تُشغَّل فيها جنّة للخدمات، دون اعتبار لمبادئ تنازع القوانين. وتخضع أي نزاعات تنشأ عن هذه الشروط أو التطبيق للاختصاص الحصري للمحاكم المختصة في تلك الولاية القضائية.</p>

                <h2>15. معلومات التواصل</h2>
                <p>إذا كانت لديك أي أسئلة حول هذه الشروط، يُرجى التواصل معنا:</p>
                <ul>
                    <li>البريد الإلكتروني: <a href="mailto:mostafa@vowalaa.com">mostafa@vowalaa.com</a></li>
                 </ul>
            @else
                <div class="legal-intro">
                    Welcome to <strong>Janna Services</strong>. These Terms &amp; Conditions ("Terms") govern your access to and use of the Janna Services mobile application and related services (collectively, the "App"). By downloading, installing, or using the App, you agree to be bound by these Terms. If you do not agree, please discontinue use of the App.
                </div>

                <h2>1. About the App</h2>
                <p>Janna Services is a community services directory that lists service providers, categories, important phone numbers, banners, and offers. The App is intended as an informational and discovery tool only. Janna Services <strong>does not directly provide the services</strong> listed; it simply connects users with independent third-party service providers.</p>

                <h2>2. Eligibility &amp; Use of the App</h2>
                <p>By using the App, you confirm that you are at least 13 years old (or the minimum legal age in your jurisdiction) and able to enter into a binding agreement. You agree to use the App only for lawful, personal, and non-commercial purposes, and in compliance with these Terms and any applicable laws.</p>

                <h2>3. Third-Party Service Providers</h2>
                <p>All service providers displayed in the App are independent third parties. Janna Services does not employ, supervise, endorse, certify, or guarantee any provider. Any agreement, transaction, payment, or dispute between you and a provider is strictly between the two of you. You are solely responsible for evaluating providers before contacting or engaging them.</p>

                <h2>4. Accuracy of Information</h2>
                <p>We strive to keep all information in the App — including provider details, phone numbers, addresses, categories, banners, and offers — accurate and up to date. However, content is provided "as is" without warranty of any kind. Information may change, be incomplete, or contain errors. You should independently verify any detail before relying on it.</p>

                <h2>5. User Responsibility</h2>
                <p>You are responsible for:</p>
                <ul>
                    <li>Your decision to contact, engage with, or hire any third-party provider listed in the App.</li>
                    <li>The accuracy of information you share when communicating with providers.</li>
                    <li>Compliance with all applicable laws and regulations while using the App.</li>
                    <li>Maintaining the security of the device on which the App is installed.</li>
                </ul>

                <h2>6. External Links &amp; Communication</h2>
                <p>The App allows you to contact providers and access information through phone calls, WhatsApp, websites, social media, or other external links. These actions open external apps or services that are <strong>not owned or operated by Janna Services</strong>. We are not responsible for the content, behavior, availability, fees, or privacy practices of any external destination. Use of those services is governed by their own terms.</p>

                <h2>7. Prohibited Activities</h2>
                <p>You agree <strong>not</strong> to:</p>
                <ul>
                    <li>Use the App for any unlawful, fraudulent, harmful, or abusive purpose.</li>
                    <li>Harass, threaten, defame, or harm any service provider or other user.</li>
                    <li>Attempt to gain unauthorized access to the App, its servers, or related systems.</li>
                    <li>Reverse engineer, decompile, modify, or create derivative works from the App.</li>
                    <li>Scrape, copy, or redistribute provider listings or other App content without permission.</li>
                    <li>Upload or transmit viruses, malware, or any malicious code.</li>
                    <li>Interfere with the App's operation or with other users' enjoyment of it.</li>
                </ul>

                <h2>8. Intellectual Property</h2>
                <p>The App, including its name, logo, design, source code, text, graphics, and other content (excluding content owned by third-party providers), is the property of Janna Services and is protected by copyright, trademark, and other intellectual-property laws. You are granted a limited, non-exclusive, non-transferable, revocable license to use the App for personal, non-commercial purposes only. All other rights are reserved.</p>

                <h2>9. Banners, Offers &amp; Promotions</h2>
                <p>Banners and offers displayed in the App are provided by third-party service providers or partners. Janna Services does not guarantee the availability, pricing, terms, or quality of any promotion. All transactions resulting from such offers are conducted directly between you and the relevant provider.</p>

                <h2>10. Limitation of Liability</h2>
                <p>To the maximum extent permitted by law, Janna Services, its owners, employees, and affiliates shall <strong>not be liable</strong> for any direct, indirect, incidental, special, consequential, or punitive damages — including but not limited to loss of profits, data, goodwill, or other intangible losses — arising from:</p>
                <ul>
                    <li>Your use of, or inability to use, the App.</li>
                    <li>Any interaction, transaction, or dispute with a third-party service provider.</li>
                    <li>Errors, inaccuracies, or omissions in the App's content.</li>
                    <li>Unauthorized access to or alteration of your device or data.</li>
                    <li>Any external link, app, or service accessed through the App.</li>
                </ul>
                <p>The App is provided on an "as is" and "as available" basis without warranties of any kind, whether express or implied.</p>

                <h2>11. Indemnification</h2>
                <p>You agree to indemnify and hold harmless Janna Services and its affiliates from any claim, demand, or damages — including reasonable legal fees — arising from your use of the App, your interactions with third-party providers, or your violation of these Terms or any applicable law.</p>

                <h2>12. Suspension &amp; Termination</h2>
                <p>We may suspend, restrict, or terminate your access to the App at any time, with or without notice, if we believe you have violated these Terms, misused the App, or engaged in conduct that may harm Janna Services, its users, or third parties.</p>

                <h2>13. Changes to These Terms</h2>
                <p>We may update these Terms from time to time to reflect changes to the App, our services, or applicable laws. The "Last updated" date at the top will always reflect the latest revision. Material changes will be highlighted within the App where appropriate. Your continued use of the App after an update means you accept the revised Terms.</p>

                <h2>14. Governing Law</h2>
                <p>These Terms shall be governed by and interpreted in accordance with the laws of the jurisdiction in which Janna Services is operated, without regard to its conflict-of-law principles. Any disputes arising from these Terms or the App shall be subject to the exclusive jurisdiction of the competent courts of that jurisdiction.</p>

                <h2>15. Contact Information</h2>
                <p>If you have any questions about these Terms, please contact us:</p>
                <ul>
                    <li>Email: <a href="mailto:mostafa@vowalaa.com">mostafa@vowalaa.com</a></li>
                 </ul>
            @endif
        </article>

        <div class="legal-footer">
            &copy; {{ date('Y') }} {{ $isRtl ? 'جنّة للخدمات. جميع الحقوق محفوظة.' : 'Janna Services. All rights reserved.' }} &middot;
            <a href="{{ route('legal.privacy') }}{{ $isRtl ? '?lang=ar' : '' }}">{{ $isRtl ? 'سياسة الخصوصية' : 'Privacy Policy' }}</a>
        </div>
    </main>
</body>
</html>
