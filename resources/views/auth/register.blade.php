<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録｜舞台「スペースなスペース」</title>
    <style>
        :root {
            --color-bg: #000000;
            --color-primary: #4fa3ff;
            --color-secondary: #7b4bff;
            --color-accent: #00ff7f;
            --color-text: #ffffff;
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
            margin: 40px 0;
            text-align: center;
        }

        .logo-link img {
            max-width: 180px;
            height: auto;
        }

        .ticket-title {
            margin-top: 15px;
            font-weight: 900;
            font-size: 1.2rem;
            letter-spacing: 0.3em;
            color: var(--color-primary);
            text-transform: uppercase;
            text-shadow: 0 0 10px rgba(79, 163, 255, 0.5);
        }

        .login-section {
            max-width: 450px;
            width: 90%;
            background: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-sizing: border-box;
        }

        .section-title {
            font-size: 1rem;
            color: var(--color-accent);
            letter-spacing: 0.1em;
            margin-bottom: 25px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .section-title::before, .section-title::after {
            content: "";
            width: 20px;
            height: 1px;
            background: var(--color-accent);
            margin: 0 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            color: var(--color-primary);
            margin-bottom: 8px;
            font-weight: bold;
        }

        .login-input {
            width: 100%;
            padding: 12px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(79, 163, 255, 0.3);
            color: white;
            border-radius: 6px;
            box-sizing: border-box;
            outline: none;
        }

        .login-input:focus {
            border-color: var(--color-accent);
            box-shadow: 0 0 10px rgba(0, 255, 127, 0.2);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--color-secondary);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            box-shadow: 0 0 20px var(--color-secondary);
            filter: brightness(1.2);
        }

        .footer-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.8rem;
        }

        .footer-link a {
            color: var(--color-primary);
            text-decoration: none;
        }

        /* エラー表示用 */
        .error-message {
            color: #ff4f4f;
            font-size: 0.75rem;
            margin-top: 5px;
        }

        footer {
            margin-top: auto;
            padding: 30px 0;
            font-size: 0.7rem;
            color: #555;
        }
    </style>
</head>
<body>

    <header>
        <a href="/" class="logo-link">
            <img src="{{ asset('images/logo.png') }}" alt="ロゴ">
        </a>
        <div class="ticket-title">SIGN UP</div>
    </header>

    <section class="login-section">
        <h2 class="section-title">新規会員登録</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">お名前</label>
                <input type="text" name="name" class="login-input" value="{{ old('name') }}" required autofocus placeholder="宇宙 太郎">
                @error('name') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">メールアドレス</label>
                <input type="email" name="email" class="login-input" value="{{ old('email') }}" required placeholder="example@space.com">
                @error('email') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">パスワード</label>
                <input type="password" name="password" class="login-input" required placeholder="8文字以上の英数字">
                @error('password') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">パスワード（確認用）</label>
                <input type="password" name="password_confirmation" class="login-input" required placeholder="もう一度入力してください">
            </div>

            <button type="submit" class="btn-login">
                この内容で登録する
            </button>
        </form>

        <div class="footer-link">
            <a href="{{ route('login') }}">すでにアカウントをお持ちの方（ログイン）</a>
        </div>
    </section>

    <footer>
        &copy; {{ date('Y') }} 舞台「スペースなスペース」製作委員会
    </footer>

</body>
</html>
