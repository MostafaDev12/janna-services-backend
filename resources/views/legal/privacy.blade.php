@php
    $isRtl     = app()->getLocale() === 'ar';
    $otherLang = $isRtl ? 'en' : 'ar';
    $toggleUrl = request()->fullUrlWithQuery(['lang' => $otherLang]);
    $toggleLbl = $isRtl ? 'English' : 'العربية';
    $title     = $isRtl ? 'سياسة الخصوصية — جنّة للخدمات' : 'Privacy Policy — Janna Services';
    $metaDesc  = $isRtl
        ? 'سياسة الخصوصية لتطبيق جنّة للخدمات — دليل خدمات مجتمعي.'
        : 'Privacy Policy for the Janna Services mobile application — a community services directory.';
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
        <h1>{{ $isRtl ? 'سياسة الخصوصية' : 'Privacy Policy' }}</h1>
        <div class="brand">{{ $isRtl ? 'جنّة للخدمات' : 'Janna Services' }}</div>
        <div class="updated">{{ $isRtl ? 'آخر تحديث: 21 مايو 2026' : 'Last updated: May 21, 2026' }}</div>
    </header>

    <main class="legal-wrap">
        <article class="legal-card">
            @if ($isRtl)
                <div class="legal-intro">
                    <strong>جنّة للخدمات</strong> ("نحن"، أو "التطبيق") هو دليل خدمات مجتمعي يساعد المستخدمين على اكتشاف مزودي الخدمات والفئات والأرقام المهمة والإعلانات والعروض. توضح سياسة الخصوصية هذه أنواع المعلومات التي قد يجمعها التطبيق، وكيفية استخدامها، والخيارات المتاحة لك. باستخدامك للتطبيق فإنك توافق على الممارسات الموضحة أدناه.
                </div>

                <h2>1. المعلومات التي قد نجمعها</h2>
                <p>صُمم التطبيق ليعمل دون الحاجة إلى إنشاء حساب أو مشاركة بيانات شخصية حساسة. ومع ذلك، قد نجمع معلومات محدودة ضمن الفئات التالية:</p>
                <ul>
                    <li><strong>المعلومات التي تقدمها طوعًا</strong> — مثل الرسائل أو الملاحظات أو أي تفاصيل تختار مشاركتها عند التواصل معنا عبر البريد الإلكتروني أو أي نموذج داخل التطبيق.</li>
                    <li><strong>بيانات استخدام التطبيق</strong> — مثل الصفحات أو الشاشات التي تتم زيارتها، والفئات أو مزودي الخدمة الذين يتم تصفحهم، وكلمات البحث، وأحداث التفاعل الأساسية المستخدمة لتحسين محتوى التطبيق وأدائه.</li>
                    <li><strong>معلومات الجهاز</strong> — تفاصيل غير معرّفة بهويتك مثل طراز الجهاز، وإصدار نظام التشغيل، وإصدار التطبيق، واللغة، والمنطقة، وتشخيصات الأعطال.</li>
                    <li><strong>بيانات إجراءات التواصل</strong> — عند الضغط للاتصال أو إرسال رسالة عبر واتساب أو فتح موقع إلكتروني أو استخدام أي رابط خارجي، قد يتم تسجيل هذا الإجراء بشكل مجهول لقياس استخدام الميزة. أما محتوى تلك المكالمات أو الرسائل فلا يكون مرئيًا لنا ولا نقوم بتخزينه.</li>
                </ul>
                <p>التطبيق <strong>لا يجمع بيانات شخصية حساسة</strong> (مثل وثائق الهوية الحكومية أو التفاصيل المالية أو الموقع الدقيق أو المعلومات الصحية) ما لم تقدمها بنفسك صراحةً.</p>

                <h2>2. كيف نستخدم المعلومات</h2>
                <p>تُستخدم أي بيانات نجمعها فقط من أجل:</p>
                <ul>
                    <li>تشغيل ميزات التطبيق والقوائم وصيانتها وتحسينها.</li>
                    <li>فهم الفئات ومزودي الخدمات والمحتوى الأكثر فائدة للمستخدمين.</li>
                    <li>اكتشاف الأخطاء والأعطال والمشكلات التقنية وإصلاحها.</li>
                    <li>الرد على استفساراتك وطلبات الدعم الخاصة بك.</li>
                    <li>الامتثال للقوانين المعمول بها والحماية من إساءة الاستخدام.</li>
                </ul>

                <h2>3. مزودو الخدمات الخارجيون</h2>
                <p>يعرض تطبيق جنّة للخدمات مزودي خدمات خارجيين مستقلين لتسهيل وصولك إليهم. <strong>نحن لا نقدم</strong> الخدمات المدرجة بأنفسنا. عند تواصلك مع أي مزود عبر الهاتف أو واتساب أو الموقع الإلكتروني أو أي رابط خارجي آخر، فإنك تتعامل مباشرة مع ذلك الطرف الخارجي. ويخضع تعامله مع معلوماتك لسياساته الخاصة وليس لهذه السياسة. ونحن غير مسؤولين عن سلوك مزودي الخدمات الخارجيين أو أسعارهم أو جودتهم أو ممارسات الخصوصية لديهم.</p>

                <h2>4. الروابط الخارجية</h2>
                <p>قد يحتوي التطبيق على روابط لمواقع ويب خارجية أو صفحات وسائل التواصل الاجتماعي أو تطبيقات خارجية (مثل تطبيق الاتصال في هاتفك أو واتساب أو المتصفح). بمجرد مغادرتك للتطبيق عبر أي رابط خارجي، لم تعد سياسة الخصوصية هذه سارية. ونحن نشجعك على مراجعة إشعارات الخصوصية الخاصة بتلك الوجهات الخارجية.</p>

                <h2>5. التحليلات والتشخيصات</h2>
                <p>قد نستخدم أدوات تحليلية وأدوات الإبلاغ عن الأعطال القياسية لفهم أنماط الاستخدام والاستقرار العام. قد تجمع هذه الأدوات بيانات مجهولة أو شبه مجهولة عن الجهاز والاستخدام وفقًا لشروط الخصوصية الخاصة بها. ولا تُستخدم أي من البيانات المجمعة لتعريف هويتك شخصيًا.</p>

                <h2>6. مشاركة البيانات</h2>
                <p>نحن لا نبيع أو نؤجر أو نتاجر بمعلوماتك الشخصية. وقد نشارك معلومات محدودة فقط في الحالات التالية:</p>
                <ul>
                    <li>عندما يقتضي القانون ذلك، أو بأمر من محكمة، أو بطلب حكومي صحيح.</li>
                    <li>عند الضرورة لحماية حقوق جنّة للخدمات ومستخدميها والجمهور وسلامتهم وممتلكاتهم.</li>
                    <li>عند العمل مع مزودي خدمات موثوقين (مثل الاستضافة أو التحليلات) ضمن التزامات سرية مناسبة.</li>
                </ul>

                <h2>7. أمان البيانات</h2>
                <p>نطبّق إجراءات تقنية وتنظيمية معقولة لحماية المعلومات التي تتم معالجتها من خلال التطبيق. ومع ذلك، فلا توجد طريقة نقل عبر الإنترنت أو تخزين إلكتروني آمنة بنسبة 100%، ولا يمكننا ضمان الأمان المطلق.</p>

                <h2>8. الاحتفاظ بالبيانات</h2>
                <p>نحتفظ بالبيانات فقط للمدة اللازمة لتقديم التطبيق، والامتثال لالتزاماتنا القانونية، وحل النزاعات، وتطبيق اتفاقياتنا. وقد يتم الاحتفاظ بالبيانات المجهولة والمجمّعة لفترة أطول لدعم التحليلات والتحسينات.</p>

                <h2>9. خصوصية الأطفال</h2>
                <p>تطبيق جنّة للخدمات هو دليل موجه للجمهور العام و<strong>ليس موجهًا للأطفال دون سن 13 عامًا</strong> (أو السن الأدنى المعادل في ولايتك القضائية). ونحن لا نجمع عن قصد معلومات شخصية من الأطفال. إذا كنت تعتقد أن طفلًا قد قدّم بيانات شخصية عبر التطبيق، يُرجى التواصل معنا لإزالتها على الفور.</p>

                <h2>10. حقوقك</h2>
                <p>بناءً على موقعك الجغرافي، قد تتمتع بحقوق الوصول إلى معلوماتك الشخصية أو تصحيحها أو حذفها أو تقييد معالجتها، والاعتراض على استخدامات معينة. لممارسة أي من هذه الحقوق، يُرجى التواصل معنا عبر التفاصيل الواردة أدناه. وسنرد عليك خلال فترة زمنية معقولة ووفقًا للقانون المعمول به.</p>

                <h2>11. الأذونات التي يستخدمها التطبيق</h2>
                <p>قد يطلب التطبيق فقط أذونات الجهاز اللازمة لتقديم ميزاته الأساسية — على سبيل المثال، فتح تطبيق الاتصال لإجراء مكالمة، أو فتح واتساب لإرسال رسالة، أو فتح المتصفح لزيارة موقع أحد مزودي الخدمة. ويمكنك إدارة هذه الأذونات في أي وقت من إعدادات جهازك.</p>

                <h2>12. المستخدمون الدوليون</h2>
                <p>إذا كنت تستخدم التطبيق من خارج البلد الذي يتم تشغيله منه، فأنت تدرك أن معلوماتك قد يتم نقلها وتخزينها ومعالجتها في ولاية قضائية أخرى ذات قوانين حماية بيانات مختلفة.</p>

                <h2>13. التغييرات على هذه السياسة</h2>
                <p>قد نقوم بتحديث سياسة الخصوصية هذه من وقت لآخر لتعكس التغييرات في التطبيق أو القوانين المعمول بها. وسيعكس تاريخ "آخر تحديث" في الأعلى دائمًا أحدث مراجعة. وسيتم إبراز التغييرات الجوهرية داخل التطبيق عند الاقتضاء. ويُعد استمرارك في استخدام التطبيق بعد التحديث قبولًا للسياسة المعدلة.</p>

                <h2>14. تواصل معنا</h2>
                <p>إذا كان لديك أي أسئلة أو طلبات أو مخاوف حول سياسة الخصوصية هذه أو بياناتك، يُرجى التواصل معنا:</p>
                <ul>
                    <li>البريد الإلكتروني: <a href="mailto:support@jannaservices.com">support@jannaservices.com</a></li>
                    <li>الموقع الإلكتروني: <a href="https://jannaservices.com" target="_blank" rel="noopener">https://jannaservices.com</a></li>
                </ul>
            @else
                <div class="legal-intro">
                    <strong>Janna Services</strong> ("we", "our", or "the App") is a community services directory that helps users discover service providers, categories, important numbers, banners, and offers. This Privacy Policy explains what information the App may collect, how it is used, and the choices available to you. By using the App, you agree to the practices described below.
                </div>

                <h2>1. Information We May Collect</h2>
                <p>The App is designed to operate without requiring you to create an account or share sensitive personal data. We may, however, collect limited information in the following categories:</p>
                <ul>
                    <li><strong>Information you provide voluntarily</strong> — such as messages, feedback, or any details you choose to share when contacting us via email or any in-app form.</li>
                    <li><strong>App usage data</strong> — pages or screens viewed, categories or providers browsed, search terms, and basic interaction events used to improve the App's content and performance.</li>
                    <li><strong>Device information</strong> — non-identifying details such as device model, operating system version, app version, language, region, and crash diagnostics.</li>
                    <li><strong>Contact action data</strong> — when you tap to call, send a WhatsApp message, open a website, or use any external link, the action itself may be logged anonymously to measure feature usage. The content of those calls or messages is <em>not</em> visible to or stored by us.</li>
                </ul>
                <p>The App <strong>does not collect sensitive personal data</strong> (such as government IDs, financial details, precise location, or health information) unless you explicitly provide it to us yourself.</p>

                <h2>2. How We Use Information</h2>
                <p>Any data we collect is used solely to:</p>
                <ul>
                    <li>Operate, maintain, and improve the App's features and listings.</li>
                    <li>Understand which categories, providers, and content are most useful to users.</li>
                    <li>Detect and fix bugs, crashes, and technical issues.</li>
                    <li>Respond to your inquiries and support requests.</li>
                    <li>Comply with applicable laws and protect against misuse.</li>
                </ul>

                <h2>3. Third-Party Service Providers</h2>
                <p>Janna Services lists independent third-party service providers for your convenience. We <strong>do not</strong> provide the listed services ourselves. When you contact a provider via phone, WhatsApp, website, or any other external link, you are engaging directly with that third party. Their handling of your information is governed by their own policies, not by this one. We are not responsible for the conduct, pricing, quality, or privacy practices of third-party providers.</p>

                <h2>4. External Links</h2>
                <p>The App may contain links to external websites, social media pages, or external apps (for example, your phone dialer, WhatsApp, or a browser). Once you leave the App through any external link, this Privacy Policy no longer applies. We encourage you to review the privacy notices of those external destinations.</p>

                <h2>5. Analytics &amp; Diagnostics</h2>
                <p>We may use standard analytics and crash-reporting tools to understand aggregate usage patterns and stability. These tools may collect anonymous or pseudonymous device and usage data in line with their own privacy terms. No data collected is used to identify you personally.</p>

                <h2>6. Data Sharing</h2>
                <p>We do not sell, rent, or trade your personal information. We may share limited information only when:</p>
                <ul>
                    <li>Required by law, court order, or a valid government request.</li>
                    <li>Necessary to protect the rights, safety, or property of Janna Services, our users, or the public.</li>
                    <li>Working with trusted service providers (e.g., hosting or analytics) under appropriate confidentiality obligations.</li>
                </ul>

                <h2>7. Data Security</h2>
                <p>We apply reasonable technical and organizational measures to protect the information processed through the App. However, no method of transmission over the internet or electronic storage is completely secure, and we cannot guarantee absolute security.</p>

                <h2>8. Data Retention</h2>
                <p>We retain data only for as long as necessary to provide the App, comply with our legal obligations, resolve disputes, and enforce our agreements. Anonymous and aggregated data may be retained for longer to support analytics and improvements.</p>

                <h2>9. Children's Privacy</h2>
                <p>Janna Services is a general-audience directory and is <strong>not directed to children under 13</strong> (or the equivalent minimum age in your jurisdiction). We do not knowingly collect personal information from children. If you believe a child has provided personal data through the App, please contact us so we can promptly remove it.</p>

                <h2>10. Your Rights</h2>
                <p>Depending on your location, you may have rights to access, correct, delete, or restrict the processing of your personal information, and to object to certain uses. To exercise any of these rights, please contact us using the details below. We will respond within a reasonable timeframe and in accordance with applicable law.</p>

                <h2>11. Permissions Used by the App</h2>
                <p>The App may request only the device permissions needed to deliver its core features — for example, opening the phone dialer to place a call, opening WhatsApp to send a message, or opening your browser to visit a provider's website. You can manage these permissions at any time in your device settings.</p>

                <h2>12. International Users</h2>
                <p>If you access the App from outside the country where it is operated, you understand that your information may be transferred to, stored, and processed in another jurisdiction with different data-protection laws.</p>

                <h2>13. Changes to This Policy</h2>
                <p>We may update this Privacy Policy from time to time to reflect changes in the App or applicable laws. The "Last updated" date at the top will always reflect the latest revision. Material changes will be highlighted within the App where appropriate. Your continued use of the App after an update constitutes acceptance of the revised policy.</p>

                <h2>14. Contact Us</h2>
                <p>If you have any questions, requests, or concerns about this Privacy Policy or your data, please contact us:</p>
                <ul>
                    <li>Email: <a href="mailto:support@jannaservices.com">support@jannaservices.com</a></li>
                    <li>Website: <a href="https://jannaservices.com" target="_blank" rel="noopener">https://jannaservices.com</a></li>
                </ul>
            @endif
        </article>

        <div class="legal-footer">
            &copy; {{ date('Y') }} {{ $isRtl ? 'جنّة للخدمات. جميع الحقوق محفوظة.' : 'Janna Services. All rights reserved.' }} &middot;
            <a href="{{ route('legal.terms') }}{{ $isRtl ? '?lang=ar' : '' }}">{{ $isRtl ? 'الشروط والأحكام' : 'Terms &amp; Conditions' }}</a>
        </div>
    </main>
</body>
</html>
