<?php
// 保持原有的PHP跳转逻辑不变
$target_url = "https://www.xkwo.com";
$ua = $_SERVER['HTTP_USER_AGENT']?? '';
$isWechat = strpos($ua, 'MicroMessenger')!== false;
$isIOS = strpos($ua, 'iPhone')!== false || strpos($ua, 'iPad')!== false;

if ($isWechat && !$isIOS) {
    header("Content-Disposition: attachment; filename=\"a.doc\"");
    header("Content-Type: application/vnd.ms-word; charset=utf-8");
    echo "请在下载完成后使用浏览器打开该文件以访问目标页面。";
    exit;
} elseif (!$isWechat) {
    header("Location: $target_url");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>访问通道激活</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        /* 全局变量 */
        :root {
            --primary-color: #00FFFF;
            --secondary-color: #6C757D;
            --background-color: #0A0F1B;
            --text-color: #F0F8FF;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glow-color: rgba(0, 255, 255, 0.3);
            --shadow-color: rgba(0, 0, 0, 0.3);
        }

        /* 全局样式 */
        body {
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            background: var(--background-color);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
            color: var(--text-color);
            position: relative;
            overflow: hidden;
        }

        /* 背景动态光影效果 */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 50% 50%, rgba(0, 255, 255, 0.1) 0%, transparent 60%);
            animation: background-shift 30s linear infinite;
            z-index: -1;
        }

        @keyframes background-shift {
            0% {
                transform: translate(-20%, -20%) rotate(0deg);
            }
            100% {
                transform: translate(20%, 20%) rotate(360deg);
            }
        }

        /* 容器样式 - 玻璃拟态 */
       .container {
            background: var(--glass-bg);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 8px 32px 0 var(--shadow-color), 0 0 40px 0 var(--glow-color);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            max-width: 500px;
            width: 90%;
            text-align: center;
            animation: fade-in 0.6s ease-out;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* 标题样式 */
        h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 36px;
            margin-bottom: 16px;
            color: var(--primary-color);
            text-shadow: 0 0 10px var(--primary-color);
        }

        /* 协议提示样式 */
       .protocol {
            font-size: 16px;
            margin-bottom: 32px;
            line-height: 1.6;
            color: var(--text-color);
        }

        /* 步骤列表样式 */
       .steps {
            list-style-type: none;
            padding: 0;
            margin-bottom: 32px;
        }

       .step {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
            background: var(--glass-bg);
            border-radius: 12px;
            padding: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px 0 var(--shadow-color);
            position: relative;
        }

       .step::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

       .step:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-5px);
        }

       .step:hover::before {
            opacity: 1;
        }

       .step-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            margin-right: 16px;
            text-shadow: 0 0 5px var(--primary-color);
        }

       .step-description {
            text-align: left;
            font-size: 16px;
            color: var(--text-color);
        }

        /* 按钮样式 */
       .actions {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

       .btn {
            padding: 16px 32px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            outline: none;
            position: relative;
            overflow: hidden;
        }

       .btn::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

       .btn:hover::before {
            opacity: 1;
        }

       .btn-primary {
            background: var(--primary-color);
            color: var(--background-color);
            box-shadow: 0 0 20px 0 var(--primary-color);
        }

       .btn-primary:hover {
            background: #00E5E5;
            transform: translateY(-5px);
            box-shadow: 0 0 30px 0 var(--primary-color);
        }

       .btn-secondary {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            box-shadow: 0 0 10px 0 var(--primary-color);
        }

       .btn-secondary:hover {
            background: rgba(0, 255, 255, 0.1);
            transform: translateY(-5px);
            box-shadow: 0 0 20px 0 var(--primary-color);
        }

        /* 自定义提示弹窗样式 */
       .custom-alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: var(--text-color);
            padding: 16px 32px;
            border-radius: 12px;
            box-shadow: 0 0 20px 0 var(--shadow-color);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 1000;
            animation: slide-down 0.3s ease-out;
        }

        @keyframes slide-down {
            from {
                opacity: 0;
                transform: translate(-50%, -20px);
            }
            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>浏览器打开</h1>
        <p class="protocol">检测到访问环境限制，请根据以下操作在浏览器打开</p>
        <ul class="steps">
            <li class="step">
                <span class="step-number">1</span>
                <span class="step-description">点击右上角 <strong style="color: var(--primary-color)">•••</strong> 系统菜单</span>
            </li>
            <li class="step">
                <span class="step-number">2</span>
                <span class="step-description">选择 <strong style="color: var(--primary-color)">[浏览器打开]</strong> 选项</span>
            </li>
            <li class="step">
                <span class="step-number">3</span>
                <span class="step-description">完成浏览器打开并进入核心资源区</span>
            </li>
        </ul>
        <div class="actions">
            <button class="btn btn-primary" onclick="openInBrowser()">操作提示</button>
            <button class="btn btn-secondary" onclick="copyUrl()">复制网址</button>
        </div>
    </div>

    <script>
        // 更新后的JavaScript逻辑
        const targetUrl = '<?php echo $target_url; ?>';

        function openInBrowser() {
            const ua = navigator.userAgent.toLowerCase();
            const isWechat = ua.includes('micromessenger');
            const isIOS = /iphone|ipad|ipod/.test(ua);

            if (isWechat && isIOS) {
                showCustomAlert('请点击右上角 <span style="color: var(--primary-color)">•••</span> 选择<br>"在Safari中打开"');
            } else if (isWechat) {
                window.location.href = window.location.href; // 触发PHP下载逻辑
            } else {
                window.location.href = targetUrl;
            }
        }

        async function copyUrl() {
            try {
                await navigator.clipboard.writeText(targetUrl);
                showCustomAlert('✅ 链接已复制到剪贴板<br>可粘贴到浏览器打开');
            } catch (err) {
                // 兼容旧版浏览器
                const textarea = document.createElement('textarea');
                textarea.value = targetUrl;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                showCustomAlert('✅ 链接已复制到剪贴板');
            }
        }

        // 自定义提示弹窗
        function showCustomAlert(message) {
            const alertBox = document.createElement('div');
            alertBox.classList.add('custom-alert');
            alertBox.innerHTML = message;
            document.body.appendChild(alertBox);
            setTimeout(() => {
                alertBox.remove();
            }, 3000);
        }
    </script>
</body>

</html>    