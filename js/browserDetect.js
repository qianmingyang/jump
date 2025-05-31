// 浏览器类型检测器
const BrowserDetector = (() => {
    // 核心UA检测规则
    const UA_RULES = {
        wechat: /MicroMessenger/i,
        qq: /(QQ\/|MQQBrowser|QQBrowserLite)/i,
        qqSpecial: /UCBrowser.*qq\//i
    };

    // 设备特征检测
    const checkUA = () => {
        const ua = navigator.userAgent;
        console.log('[DEBUG] UserAgent:', ua);

        // 微信优先检测
        if (UA_RULES.wechat.test(ua)) {
            console.log('[DETECT] 微信环境');
            return 'wechat';
        }

        // QQ系列检测
        if (UA_RULES.qq.test(ua) || UA_RULES.qqSpecial.test(ua)) {
            console.log('[DETECT] QQ环境');
            return 'qq';
        }

        return 'other';
    };

    // 显示对应面板
    const showPanel = (type) => {
        document.getElementById(`${type}-panel`).style.display = 'block';
    };

    // 字体适配逻辑
    const fontSizeAdapter = () => {
        const setRootFontSize = () => {
            document.documentElement.style.fontSize = 
                document.body.clientWidth / 15 + 'px';
        };
        setRootFontSize();
        window.addEventListener('resize', setRootFontSize);
    };

    // 初始化入口
    const init = () => {
        const target = 'https://v1.tvs1.vip/?from=github';
        const browserType = checkUA();

        if (browserType === 'wechat' || browserType === 'qq') {
            showPanel(browserType);
            fontSizeAdapter();
        } else {
            window.location.href = target;
        }
    };

    return { init };
})();

// 启动检测
window.addEventListener('load', BrowserDetector.init);
