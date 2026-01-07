<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン｜舞台「スペースなスペース」</title>
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

        header {
            margin: 50px 0;
            text-align: center;
        }

        .logo-link img {
            max-width: 240px;
            height: auto;
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

        .content-wrapper {
            max-width: 800px;
            width: 92%;
            display: flex;
            flex-direction: column;
            gap: 40px;
            margin-bottom: 80px;
        }

        /* ログインフォーム */
        .login-section {
            max-width: 400px;
            width: 100%;
            align-self: center;
            background: rgba(255, 255, 255, 0.05);
            padding: 40px 30px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .login-input {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(79, 163, 255, 0.3);
            color: white;
            border-radius: 6px;
            box-sizing: border-box;
            outline: none;
        }

        .login-input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 8px rgba(79, 163, 255, 0.4);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--color-secondary);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            filter: brightness(1.2);
            transform: translateY(-1px);
        }

        .error-msg {
            color: #ff4b4b;
            font-size: 0.8rem;
            margin-bottom: 10px;
            text-align: left;
        }

        footer {
            margin-top: auto;
            padding: 30px 0;
            font-size: 0.7rem;
            color: #555;
            text-align: center;
        }

        a {
            transition: 0.3s;
        }
        a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <header>
        <a href="/" class="logo-link">
            <img src="{{ asset('images/logo.png') }}" alt="ロゴ">
        </a>
        <div class="ticket-title">User Login</div>
    </header>

    <div class="content-wrapper">
        
        <section class="login-section">            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email" class="login-input" placeholder="メールアドレス" value="{{ old('email') }}" required autofocus>
                @if($errors->has('email'))
                    <div class="error-msg">{{ $errors->first('email') }}</div>
                @endif

                <input type="password" name="password" class="login-input" placeholder="パスワード" required>
                @if($errors->has('password'))
                    <div class="error-msg">{{ $errors->first('password') }}</div>
                @endif

                <button type="submit" class="btn-login">ログイン</button>
            </form>

            <div style="text-align: center; margin-top: 25px; font-size: 0.8rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
                <p style="color: #888; margin-bottom: 10px;">はじめてご利用の方</p>
                <a href="{{ route('register') }}" style="color: var(--color-accent); text-decoration: none; font-weight: bold;">新規会員登録はこちら</a>
            </div>
        </section>

    </div>

    <footer>
        &copy; {{ date('Y') }} 舞台「スペースなスペース」製作委員会
    </footer>

</body>
</html>
