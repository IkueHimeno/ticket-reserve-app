<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チケット予約｜舞台「スペースなスペース」</title>
    <style>
        :root {
            --color-bg: #000000;
            --color-primary: #4fa3ff;
            --color-secondary: #7b4bff;
            --color-accent: #00ff7f;
            --color-text: #ffffff;
            --color-section: #0f1b3d;
        }

        body {
            background-color: var(--color-bg);
            color: var(--color-text);
            font-family: 'Helvetica Neue', Arial, "Hiragino Kaku Gothic ProN", "Hiragino Sans", Meiryo, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        /* ロゴ */
        header {
            margin: 50px 0;
            text-align: center;
        }

        .logo-link img {
            max-width: 240px;
            height: auto;
            transition: 0.3s;
        }

        .content-wrapper {
            max-width: 800px;
            width: 92%;
            display: flex;
            flex-direction: column;
            gap: 40px;
            margin-bottom: 80px;
        }

        .section-title {
            font-size: 1rem;
            color: var(--color-accent);
            letter-spacing: 0.4em;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ticket-title {
            margin-top: 25px;
            font-weight: 900;
            font-size: 1.5rem;
            letter-spacing: 0.3em;
            color: var(--color-primary);
            text-transform: uppercase;
            text-align: center;
            text-shadow: 0 0 10px rgba(79, 163, 255, 0.5);
        }

        /* 空き状況 */
        .status-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 2px;
        }

        .status-table th {
            background: rgba(79, 163, 255, 0.1);
            padding: 10px;
            font-size: 0.8rem;
            color: var(--color-primary);
            text-align: center;
        }

        .status-table td {
            padding: 15px 5px;
            text-align: center;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .time-col {
            background: var(--color-section) !important;
            font-weight: bold;
            color: var(--color-text);
            width: 80px;
        }

        .status-mark {
            font-size: 1.2rem;
            font-weight: bold;
        }

        /* 注意事項 */
        .notes-section {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
        }
        .notes-scroll-box {
            height: 120px;
            overflow-y: auto;
            padding-right: 10px;
            font-size: 0.8rem;
            line-height: 1.7;
            color: #bbb;
        }
        .notes-scroll-box::-webkit-scrollbar { width: 4px; }
        .notes-scroll-box::-webkit-scrollbar-thumb { background: var(--color-primary); border-radius: 10px; }

        /* ログイン */
        .login-section {
            max-width: 400px;
            width: 100%;
            align-self: center;
            background: rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .login-input {
            width: 100%;
            padding: 12px;
            margin-bottom: 12px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(79, 163, 255, 0.3);
            color: white;
            border-radius: 6px;
            box-sizing: border-box;
        }
        .btn-login {
            width: 100%;
            padding: 12px;
            background: var(--color-secondary);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        footer {
            margin-top: auto;
            padding: 30px 0;
            font-size: 0.7rem;
            color: #555;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <a href="https://stagelp-dev.vercel.app/" class="logo-link">
            <img src="{{ asset('images/logo.png') }}" alt="ロゴ">
        </a>
        <div class="ticket-title">Ticket Reservation</div>
    </header>

    <div class="content-wrapper">
        <section class="status-section">
            <h2 class="section-title">AVAILABILITY</h2>
                <table class="status-table">
                    <thead>
                        <tr>
                            <th class="time-col">日時</th>
                            @foreach($dates as $date)
                                <th>{{ $date }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($times as $time)
                            <tr>
                                <td style="padding: 15px; color: var(--color-primary); font-weight: bold; border: 1px solid rgba(79, 163, 255, 0.2);">
                                    {{ $time }}
                                </td>
                                @foreach($dates as $date)
                                    <td style="padding: 15px; border: 1px solid rgba(79, 163, 255, 0.2); text-align: center;">
                                        @if(isset($matrix[$time][$date]))
                                            @php 
                                                $item = $matrix[$time][$date];
                                                $url = auth()->check() 
                                                    ? route('reservations.seats', ['id' => $item['id']]) 
                                                    : route('register') . '?msg=register';
                                            @endphp

                                        @if($item['status'] !== '×')
                                            <a href="{{ $url }}" 
                                            style="color: {{ $item['color'] }}; text-decoration: none; font-size: 1.5rem; font-weight: bold; text-shadow: 0 0 10px {{ $item['color'] }}; transition: 0.3s;"
                                            onmouseover="this.style.filter='brightness(1.5) scale(1.2)'"
                                            onmouseout="this.style.filter='none'"
                                            >
                                            
                                                {{ $item['status'] }}
                                            </a>
                                        @else
                                            <span style="color: {{ $item['color'] }}; font-size: 1.5rem; opacity: 0.5;">{{ $item['status'] }}</span>
                                        @endif
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </section>

        <section class="notes-section">
            <h2 class="section-title">NOTICE</h2>
            <div class="notes-scroll-box">
                先着販売となりますので、上限枚数に達し次第受付終了となります。チケット購入後の変更はシステム上承ることができません。キャンセルをご希望の場合は、マイページより操作を行なってください。一度キャンセルした予約を元に戻すことはできません。必ず日時をご確認の上、お手続きにお進みください。<br>
                チケットは当日、受付にてお受け取りいただけます。マイページにある予約一覧をスタッフへご提示ください。
                チケットの不法転売は固く禁じます。転売されたチケットは無効となり入場をお断りさせていただく場合があります。また、ダフ屋・金券ショップ・ネットオークション等での不法転売によるチケット売買に関するトラブルについて、当サイトでは一切の責任を負いかねます。<br>
                一回の購入枚数上限は4枚までとなっております。未就学児のご入場は安全上の理由によりお断りしております。<br>
                会場内での無断撮影・録音は法律により禁止されています。ライブ配信、各種撮影・録音機器、スマートフォンなどを使用しての撮影・録画・録音行為をスタッフが発見した場合、その場で機材を預かり、撮影・録画した内容を強制的に削除させて頂きます。スタッフの指示に従わずに、機材が損傷した場合、当社は一切の責任を負いません。<br>
                主催者の要因でイベントが中止になった場合は、公式ウェブサイトやソーシャルメディアで払い戻し方法をご連絡いたします。<br>
                お客様のご事情でイベント当日に来場できない場合は、如何なる理由であっても返金やその他の補償は行いません。
                イベントが延期または中止になった場合、主催者は交通費や宿泊費、その他の費用を補償する責任は負いませんので、あらかじめご了承ください。<br>   
            </div>
        </section>

        <section class="login-section" style="position: relative; z-index: 100;">
            @auth
                <h2 style="text-align:center; font-size: 1rem; margin-bottom: 20px;">ログイン中</h2>
                
                <a href="{{ url('/dashboard') }}" class="btn-login" style="display: block; width: 100%; box-sizing: border-box; text-align: center; text-decoration: none; margin-bottom: 15px;">
                    マイページに戻る
                </a>

                <form method="POST" action="{{ route('logout') }}" style="text-align: center;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #888; font-size: 0.75rem; cursor: pointer; text-decoration: underline;">
                        ログアウト
                    </button>
                </form>

            @else
                <h2 style="text-align:center; font-size: 1rem; margin-bottom: 20px;">LOGIN / SIGN IN</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="email" name="email" class="login-input" placeholder="メールアドレス" value="{{ old('email') }}" required>
                    <input type="password" name="password" class="login-input" placeholder="パスワード" required>
                    <button type="submit" class="btn-login">ログイン</button>
                </form>
                <div style="text-align: center; margin-top: 20px; font-size: 0.75rem;">
                    <a href="{{ route('register') }}" style="color: var(--color-primary); text-decoration: none; display: inline-block; padding: 10px;">
                        新規会員登録はこちら
                    </a>
                </div>
            @endauth
        </section>
    </div>

    <footer>
        &copy; {{ date('Y') }} 舞台「スペースなスペース」製作委員会
    </footer>

</body>
</html>