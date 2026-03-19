<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Felicia Yong</title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/main.css?dev=<?= rand(); ?>">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Nunito-Regular', sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            text-align: center;
        }

        .login-header {
            margin-bottom: 30px;
        }

        .login-header h1 {
            font-family: 'Tenor-Regular';
            font-size: 28px;
            color: #2d3748;
            margin: 0 0 10px 0;
        }

        .login-header p {
            color: #718096;
            font-size: 14px;
            margin: 0;
        }

        .admin-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            margin-right: 8px;
            vertical-align: middle;
        }

        .admin-icon svg {
            width: 100%;
            height: 100%;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .login-header .admin-icon {
            margin-right: 10px;
        }

        .login-button .admin-icon,
        .error-message .admin-icon {
            margin-right: 8px;
            vertical-align: text-bottom;
        }

        .error-message {
            background-color: #fed7d7;
            color: #c53030;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #fc8181;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-size: 14px;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
            font-family: 'Nunito-Light';
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .login-button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            font-family: 'Nunito-SemiBold';
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .login-footer a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>
                    <span class="admin-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 4v2"></path>
                            <path d="M4.9 6.1l1.4 1.4"></path>
                            <path d="M3 12h2"></path>
                            <path d="M4.9 17.9l1.4-1.4"></path>
                            <path d="M17.7 17.9l-1.4-1.4"></path>
                            <path d="M19 12h2"></path>
                            <path d="M17.7 6.1l-1.4 1.4"></path>
                        </svg>
                    </span>
                    Admin Login
                </h1>
                <p>Felicia Yong Art Dashboard</p>
            </div>

            <?php if ($result == 0) { ?>
                <div class="error-message">
                    <span class="admin-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                            <path d="M12 9v4"></path>
                            <path d="M12 17h0.01"></path>
                        </svg>
                    </span>
                    Invalid username or password. Please try again.
                </div>
            <?php } ?>

            <form action="" method="post" accept-charset="utf-8">
                <div class="form-group">
                    <label for="adminusername">Username</label>
                    <input type="text"
                           name="adminusername"
                           id="adminusername"
                           class="form-control"
                           placeholder="Enter your username"
                           maxlength="80"
                           required
                           autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                           name="adminpassword"
                           id="password"
                           class="form-control"
                           placeholder="Enter your password"
                           required>
                </div>

                <button type="submit" name="submit" class="login-button">
                    <span class="admin-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    Sign In
                </button>
            </form>

            <div class="login-footer">
                <a href="<?= base_url(); ?>">← Back to Website</a>
            </div>
        </div>
    </div>
</body>
</html>
