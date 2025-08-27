<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUKABINTANG01 RAW SCRIPT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Source+Code+Pro:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* SEMUA CSS DARI KODE ANDA DITARUH DI SINI */
        :root {
            --neon-green: #00ff41; --neon-cyan: #00ffff; --neon-pink: #ff0080; --neon-purple: #8a2be2;
            --dark-bg: #0a0a0a; --darker-bg: #050505; --terminal-bg: #0d1117; --grid-color: rgba(0, 255, 65, 0.1);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Source Code Pro', monospace; background: var(--dark-bg);
            background-image: linear-gradient(rgba(0,255,65,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0,255,65,0.03) 1px, transparent 1px);
            background-size: 20px 20px; min-height: 100vh; color: var(--neon-green); overflow-x: hidden; position: relative;
        }
        .scanlines {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;
            background: linear-gradient(transparent 50%, rgba(0, 255, 65, 0.02) 50%);
            background-size: 100% 2px; animation: scanlines 0.1s linear infinite;
        }
        @keyframes scanlines { 0% { transform: translateY(0px); } 100% { transform: translateY(2px); } }
        .glitch-effect { position: relative; }
        .glitch-effect::before, .glitch-effect::after {
            content: attr(data-text); position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        }
        .glitch-effect::before { animation: glitch-1 2s infinite; color: var(--neon-cyan); z-index: -1; }
        .glitch-effect::after { animation: glitch-2 2s infinite; color: var(--neon-pink); z-index: -2; }
        @keyframes glitch-1 { 0%, 14%, 15%, 49%, 50%, 99%, 100% { transform: translate(0); } 15%, 49% { transform: translate(-2px, -1px); } }
        @keyframes glitch-2 { 0%, 20%, 21%, 62%, 63%, 99%, 100% { transform: translate(0); } 21%, 62% { transform: translate(2px, 1px); } }
        .container { width: 100%; max-width: 800px; margin: 0 auto; padding: 20px; position: relative; z-index: 1; }
        .terminal-header {
            background: linear-gradient(45deg, var(--terminal-bg), #1a1a2e); border: 2px solid var(--neon-green);
            border-radius: 10px 10px 0 0; padding: 15px; display: flex; align-items: center;
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.3), inset 0 0 20px rgba(0, 255, 65, 0.1);
        }
        .terminal-buttons { display: flex; gap: 8px; margin-right: 15px; }
        .terminal-btn { width: 12px; height: 12px; border-radius: 50%; border: 1px solid; }
        .btn-close { background: #ff5f57; border-color: #ff5f57; }
        .btn-minimize { background: #ffbd2e; border-color: #ffbd2e; }
        .btn-maximize { background: var(--neon-green); border-color: var(--neon-green); }
        .terminal-title { font-family: 'Orbitron', monospace; font-weight: 700; color: var(--neon-green); text-shadow: 0 0 10px var(--neon-green); animation: pulse 2s ease-in-out infinite alternate; }
        @keyframes pulse { from { text-shadow: 0 0 10px var(--neon-green); } to { text-shadow: 0 0 20px var(--neon-green), 0 0 30px var(--neon-green); } }
        .main-title { text-align: center; margin: 30px 0; }
        .title {
            font-family: 'Orbitron', monospace; font-size: 4rem; font-weight: 900;
            background: linear-gradient(45deg, var(--neon-green), var(--neon-cyan), var(--neon-pink));
            background-size: 300% 300%; background-clip: text; -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            animation: gradient-shift 3s ease infinite; text-shadow: 0 0 30px rgba(0, 255, 65, 0.5);
        }
        @keyframes gradient-shift { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
        .subtitle { font-family: 'Source Code Pro', monospace; color: var(--neon-cyan); text-align: center; margin-top: 10px; text-shadow: 0 0 10px var(--neon-cyan); }
        .terminal-body {
            background: var(--terminal-bg); border: 2px solid var(--neon-green); border-top: none;
            border-radius: 0 0 10px 10px; padding: 30px;
            box-shadow: 0 0 20px rgba(0, 255, 65, 0.3), inset 0 0 50px rgba(0, 0, 0, 0.5);
        }
        .command-line { display: flex; align-items: center; margin-bottom: 20px; font-family: 'Source Code Pro', monospace; }
        .prompt { color: var(--neon-pink); margin-right: 10px; text-shadow: 0 0 5px var(--neon-pink); }
        .cursor { width: 2px; height: 20px; background: var(--neon-green); animation: cursor-blink 1s infinite; margin-left: 5px; }
        @keyframes cursor-blink { 0%, 50% { opacity: 1; } 51%, 100% { opacity: 0; } }
        .form-group { margin-bottom: 25px; }
        .label { display: block; margin-bottom: 10px; color: var(--neon-cyan); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; text-shadow: 0 0 10px var(--neon-cyan); }
        .content-type-select {
            width: 100%; padding: 15px; background: var(--darker-bg); border: 2px solid var(--neon-green);
            border-radius: 5px; color: var(--neon-green); font-family: 'Source Code Pro', monospace; font-size: 1rem;
            transition: all 0.3s ease; box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .content-type-select:focus { outline: none; border-color: var(--neon-cyan); box-shadow: 0 0 20px rgba(0, 255, 255, 0.5), inset 0 0 10px rgba(0, 0, 0, 0.5); }
        .content-type-select option { background: var(--darker-bg); color: var(--neon-green); }
        .textarea {
            width: 100%; min-height: 400px; padding: 20px; background: var(--darker-bg);
            border: 2px solid var(--neon-green); border-radius: 5px; color: var(--neon-green);
            font-family: 'Source Code Pro', monospace; font-size: 1rem; line-height: 1.6;
            resize: vertical; transition: all 0.3s ease; box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.7);
        }
        .textarea:focus { outline: none; border-color: var(--neon-cyan); box-shadow: 0 0 30px rgba(0, 255, 255, 0.3), inset 0 0 20px rgba(0, 0, 0, 0.7); }
        .textarea::placeholder { color: rgba(0, 255, 65, 0.5); }
        .submit-btn {
            width: 100%; padding: 20px; background: linear-gradient(45deg, var(--darker-bg), var(--terminal-bg));
            border: 2px solid var(--neon-green); border-radius: 5px; color: var(--neon-green);
            font-family: 'Orbitron', monospace; font-size: 1.2rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 2px; cursor: pointer;
            transition: all 0.3s ease; position: relative; overflow: hidden;
        }
        .submit-btn:hover { border-color: var(--neon-cyan); color: var(--neon-cyan); box-shadow: 0 0 30px rgba(0, 255, 255, 0.5), inset 0 0 30px rgba(0, 255, 255, 0.1); transform: translateY(-2px); }
        .submit-btn::before {
            content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        .submit-btn:hover::before { left: 100%; }
        .loading { display: none; text-align: center; margin-top: 30px; padding: 20px; border: 1px solid var(--neon-pink); border-radius: 5px; background: rgba(255, 0, 128, 0.05); }
        .loading-text { color: var(--neon-pink); font-size: 1.1rem; margin-bottom: 15px; text-shadow: 0 0 10px var(--neon-pink); }
        .progress-bar { width: 100%; height: 4px; background: var(--darker-bg); border-radius: 2px; overflow: hidden; margin-bottom: 10px; }
        .progress-fill { height: 100%; background: linear-gradient(90deg, var(--neon-pink), var(--neon-purple)); width: 0%; }
        .progress-fill.active { animation: progress 2s ease-out forwards; }
        @keyframes progress { to { width: 100%; } }
        .result-container {
            margin-top: 30px; padding: 25px; background: var(--darker-bg); border: 2px solid var(--neon-green);
            border-radius: 5px; display: none; box-shadow: 0 0 20px rgba(0, 255, 65, 0.3);
        }
        .result-label { color: var(--neon-green); font-weight: bold; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px; text-shadow: 0 0 10px var(--neon-green); }
        .result-url {
            background: var(--terminal-bg); padding: 15px; border-radius: 5px; color: var(--neon-cyan);
            font-family: 'Source Code Pro', monospace; word-break: break-all; border: 1px solid var(--neon-cyan);
            text-shadow: 0 0 5px var(--neon-cyan);
        }
        .copy-btn {
            margin-top: 15px; padding: 12px 25px; background: var(--darker-bg); color: var(--neon-pink);
            border: 2px solid var(--neon-pink); border-radius: 5px; cursor: pointer; font-family: 'Source Code Pro', monospace;
            font-weight: bold; text-transform: uppercase; transition: all 0.3s ease;
        }
        .copy-btn:hover { background: var(--neon-pink); color: var(--darker-bg); box-shadow: 0 0 20px rgba(255, 0, 128, 0.5); }
        .footer { margin-top: 50px; text-align: center; color: rgba(0, 255, 65, 0.7); font-family: 'Source Code Pro', monospace; padding: 20px; border-top: 1px solid rgba(0, 255, 65, 0.3); }
        .hacker-text { font-family: 'Source Code Pro', monospace; color: var(--neon-green); text-shadow: 0 0 5px var(--neon-green); }
        @media (max-width: 768px) { .title { font-size: 2.5rem; } .terminal-body { padding: 20px; } .textarea { min-height: 300px; } }
        #matrixCanvas { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: -1; opacity: 0.1; }
    </style>
</head>
<body>
    <div class="scanlines"></div>
    <canvas id="matrixCanvas"></canvas>
    
    <div class="container">
        <div class="terminal-header">
            <div class="terminal-buttons">
                <div class="terminal-btn btn-close"></div>
                <div class="terminal-btn btn-minimize"></div>
                <div class="terminal-btn btn-maximize"></div>
            </div>
            <div class="terminal-title">CYBER_TERMINAL_v2.1.337</div>
        </div>

        <div class="main-title">
            <h1 class="title glitch-effect" data-text="SUKABINTANG01 RAW SCRIPT">SUKABINTANG01 RAW SCRIPT</h1>
            <p class="subtitle">&gt;&gt;&gt; INITIALIZING PROTOCOL... ACCESS GRANTED &lt;&lt;&lt;</p>
        </div>

        <div class="terminal-body">
            <div class="command-line">
                <span class="prompt">root@sukabintang01:~$</span>
                <span class="hacker-text">paste --create --secure</span>
                <div class="cursor"></div>
            </div>
            
            <form id="paste-form">
                <div class="form-group">
                    <label class="label" for="content-type">[ FILE TYPE ]</label>
                    <select class="content-type-select" id="content-type" name="language">
                        <option value="txt">PLAIN_TEXT.txt</option>
                        <option value="js">JAVASCRIPT.js</option>
                        <option value="html">HYPERTEXT.html</option>
                        <option value="css">STYLESHEET.css</option>
                        <option value="py">PYTHON_SCRIPT.py</option>
                        <option value="json">JSON_DATA.json</option>
                        <option value="md">MARKDOWN.md</option>
                        <option value="xml">XML_STRUCTURE.xml</option>
                        <option value="sh">SHELL_SCRIPT.sh</option>
                        <option value="sql">DATABASE_QUERY.sql</option>
                        <option value="php">PHP_CODE.php</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="label" for="content-input">[ DATA INPUT STREAM ]</label>
                    <textarea class="textarea" id="content-input" name="content" 
                        placeholder=">>> ENTER YOUR CODE OR TEXT HERE..."></textarea>
                </div>

                <button type="submit" class="submit-btn" id="submit-btn">
                    <span>EXECUTE UPLOAD RAW</span>
                </button>
            </form>

            <div class="loading" id="loading">
                <div class="loading-text">PROCESSING DATA...</div>
                <div class="progress-bar">
                    <div class="progress-fill" id="progress-fill"></div>
                </div>
                <div class="hacker-text">
                    <div id="loading-status">Initializing secure connection...</div>
                </div>
            </div>

            <div class="result-container" id="result-container">
                <div class="result-label">[ SECURE RAW URL GENERATED ]</div>
                <div class="result-url" id="result-url"></div>
                <button class="copy-btn" onclick="copyToClipboard()">COPY TO CLIPBOARD</button>
            </div>
        </div>

        <div class="footer">
            <div class="hacker-text">© 2025 SUKABINTANG01_PASTE_SYSTEM | SUKABINTANG01_SECURED</div>
        </div>
    </div>

    <script>
        // --- Matrix Rain Effect ---
        const canvas = document.getElementById('matrixCanvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        const matrix = "アァカサタナハマヤャラワガザダバパイィキシチニヒミリヰギジヂビピウゥクABCDEFGHIJKLMNOPQRSTUVWXYZ123456789@#$%^&*()*&^%";
        const characters = matrix.split('');
        const fontSize = 12;
        const columns = canvas.width / fontSize;
        const drops = Array(Math.floor(columns)).fill(1);
        
        function drawMatrix() {
            ctx.fillStyle = 'rgba(10, 10, 10, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = '#00ff41';
            ctx.font = fontSize + 'px monospace';
            for (let i = 0; i < drops.length; i++) {
                const text = characters[Math.floor(Math.random() * characters.length)];
                ctx.fillText(text, i * fontSize, drops[i] * fontSize);
                if (drops[i] * fontSize > canvas.height && Math.random() > 0.975) {
                    drops[i] = 0;
                }
                drops[i]++;
            }
        }
        setInterval(drawMatrix, 33);
        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });

        // --- Form Submission Logic ---
        const form = document.getElementById('paste-form');
        const submitBtn = document.getElementById('submit-btn');
        const loadingEl = document.getElementById('loading');
        const progressFill = document.getElementById('progress-fill');
        const loadingStatus = document.getElementById('loading-status');
        const resultContainer = document.getElementById('result-container');
        const resultUrlEl = document.getElementById('result-url');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            initiatePasteUpload();
        });

        function initiatePasteUpload() {
            const formData = new FormData(form);
            const content = formData.get('content').trim();

            if (!content) {
                alert('ERROR: DATA INPUT STREAM IS EMPTY.');
                return;
            }

            // --- UI Changes for Loading ---
            submitBtn.disabled = true;
            resultContainer.style.display = 'none';
            loadingEl.style.display = 'block';
            progressFill.classList.add('active');

            const hackingMessages = [
                'Establishing secure tunnel...', 'Bypassing firewall protocols...',
                'Encrypting data with AES-256...', 'Generating quantum hash...',
                'Uploading to secure server...', 'Creating raw access point...', 'Finalizing secure connection...'
            ];
            let messageIndex = 0;
            const messageInterval = setInterval(() => {
                if (messageIndex < hackingMessages.length) {
                    loadingStatus.textContent = hackingMessages[messageIndex];
                    messageIndex++;
                } else {
                    clearInterval(messageInterval);
                }
            }, 300);

            // --- Send Data to Server ---
            setTimeout(async () => {
                try {
                    const response = await fetch('save.php', {
                        method: 'POST',
                        body: formData
                    });
                    const result = await response.json();

                    if (result.success) {
                        resultUrlEl.textContent = result.url;
                        resultContainer.style.display = 'block';
                        resultContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        document.getElementById('content-input').value = ''; // Clear textarea
                    } else {
                        throw new Error(result.error || 'Unknown server error');
                    }
                } catch (error) {
                    alert('Upload failed: ' + error.message);
                } finally {
                    // --- Reset UI ---
                    loadingEl.style.display = 'none';
                    progressFill.classList.remove('active');
                    submitBtn.disabled = false;
                    clearInterval(messageInterval);
                }
            }, 2100); // Wait for animation to finish
        }

        function copyToClipboard() {
            const resultUrl = resultUrlEl.textContent;
            navigator.clipboard.writeText(resultUrl).then(() => {
                const copyBtn = document.querySelector('.copy-btn');
                const originalText = copyBtn.textContent;
                copyBtn.textContent = 'COPIED!';
                copyBtn.style.background = '#00ff41';
                copyBtn.style.color = '#0a0a0a';
                setTimeout(() => {
                    copyBtn.textContent = originalText;
                    copyBtn.style.background = '';
                    copyBtn.style.color = '';
                }, 2000);
            }).catch(err => {
                alert('Failed to copy URL.');
            });
        }
    </script>
</body>
</html>