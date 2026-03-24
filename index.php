<?php
$nombre = isset($_GET['nombre']) ? htmlspecialchars(trim($_GET['nombre']), ENT_QUOTES, 'UTF-8') : 'Amigo/a';
$nombre = $nombre ?: 'Amigo/a';

$frases = [
  ["emoji" => "🍺", "texto" => "Advertencia: el nivel de vergüenza en la pista de baile es DIRECTAMENTE proporcional a los tragos. Planifica bien."],
  ["emoji" => "🕺", "texto" => "Si dices que no sabes bailar... esta noche te vamos a desmentir frente a todos."],
  ["emoji" => "😂", "texto" => "Los que digan 'solo un ratito' son exactamente los que terminan a las 4am pidiendo otro trago."],
  ["emoji" => "🥴", "texto" => "Dresscode: cualquier cosa que no te dé vergüenza ver en foto al día siguiente. O que sí. Total."],
  ["emoji" => "🍹", "texto" => "Prometemos que el DJ va a poner buena música. Y si no... los tragos te van a hacer creer que sí."],
];
$frase = $frases[array_rand($frases)];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>¡Te esperamos, <?= $nombre ?>! 🎉</title>
  <link href="https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:    #07050f;
      --card:  #110d1e;
      --neon1: #ff2d78;
      --neon2: #bf00ff;
      --neon3: #00e5ff;
      --neon4: #ffe600;
      --text:  #f0e8ff;
      --muted: #7a6a99;
    }

    html, body {
      min-height: 100vh;
      background: var(--bg);
      font-family: 'Outfit', sans-serif;
      color: var(--text);
      overflow-x: hidden;
    }

    /* ── Luces ── */
    .lights { position: fixed; inset: 0; z-index: 0; pointer-events: none; overflow: hidden; }
    .beam {
      position: absolute; top: -30%; width: 3px; height: 80vh;
      border-radius: 4px; transform-origin: top center;
      opacity: 0; animation: sweep linear infinite; filter: blur(2px);
    }
    @keyframes sweep {
      0%   { transform: rotate(-50deg); opacity: 0; }
      10%  { opacity: 0.35; }
      50%  { opacity: 0.15; }
      90%  { opacity: 0.35; }
      100% { transform: rotate(50deg); opacity: 0; }
    }
    .particle {
      position: absolute; border-radius: 50%;
      animation: rise linear infinite; pointer-events: none;
    }
    @keyframes rise {
      0%   { transform: translateY(110vh) scale(1);   opacity: 0; }
      10%  { opacity: 0.7; }
      80%  { opacity: 0.4; }
      100% { transform: translateY(-10vh) scale(0.3); opacity: 0; }
    }

    /* ── Layout ── */
    .page {
      position: relative; z-index: 1; min-height: 100vh;
      display: flex; flex-direction: column; align-items: center;
      padding: 40px 20px 70px;
    }

    /* ── Disco ball ── */
    .disco {
      font-size: clamp(64px, 13vw, 100px);
      line-height: 1; margin-bottom: 16px;
      animation: sway 3s ease-in-out infinite;
      filter: drop-shadow(0 0 20px #bf00ff88) drop-shadow(0 0 40px #ff2d7844);
    }
    @keyframes sway {
      0%,100% { transform: rotate(-8deg) scale(1); }
      25%     { transform: rotate(0deg)  scale(1.06); }
      50%     { transform: rotate(8deg)  scale(1); }
      75%     { transform: rotate(0deg)  scale(1.06); }
    }

    /* ── Card ── */
    .card {
      max-width: 640px; width: 100%;
      background: var(--card);
      border-radius: 28px;
      border: 1px solid #ffffff14;
      box-shadow: 0 0 0 1px #ffffff08, 0 0 40px #bf00ff33, 0 0 80px #ff2d7822, inset 0 1px 0 #ffffff12;
      padding: 52px 44px 48px;
      text-align: center;
      position: relative; overflow: hidden;
    }
    .card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
      background: linear-gradient(90deg, var(--neon1), var(--neon2), var(--neon3), var(--neon4), var(--neon1));
      background-size: 300% 100%; animation: slide-grad 3s linear infinite;
    }
    @keyframes slide-grad { 0% { background-position: 0% 0%; } 100% { background-position: 300% 0%; } }
    .card::after {
      content: ''; position: absolute; inset: 0; z-index: 0;
      background: radial-gradient(ellipse 60% 40% at 50% 0%, #bf00ff1a 0%, transparent 70%),
                  radial-gradient(ellipse 40% 30% at 80% 100%, #ff2d781a 0%, transparent 70%);
      pointer-events: none;
    }
    .card > * { position: relative; z-index: 1; }

    /* ── Chip ── */
    .chip {
      display: inline-flex; align-items: center; gap: 6px;
      background: #ffffff0a; border: 1px solid #ffffff18; border-radius: 100px;
      padding: 6px 16px; font-size: 11px; font-weight: 700;
      letter-spacing: 2px; text-transform: uppercase; color: var(--neon3); margin-bottom: 22px;
    }
    .chip::before { content: '●'; font-size: 8px; animation: blink 1s ease-in-out infinite alternate; }
    @keyframes blink { from { opacity: 0.3; } to { opacity: 1; } }

    /* ── Título ── */
    .title {
      font-family: 'Black Han Sans', sans-serif;
      font-size: clamp(38px, 9vw, 72px);
      line-height: 0.95; letter-spacing: -1px; margin-bottom: 8px;
    }
    .title .t1 { display: block; color: var(--text); }
    .title .t2 {
      display: block;
      background: linear-gradient(90deg, var(--neon1), var(--neon2));
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
      filter: drop-shadow(0 0 12px #bf00ff88);
    }

    /* ── Nombre ── */
    .nombre-wrap { margin: 16px 0 24px; }
    .nombre-label {
      font-size: 11px; font-weight: 600; letter-spacing: 3px;
      text-transform: uppercase; color: var(--muted); margin-bottom: 6px;
    }
    .nombre {
      font-family: 'Black Han Sans', sans-serif;
      font-size: clamp(30px, 7vw, 54px);
      background: linear-gradient(90deg, var(--neon3), var(--neon4));
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
      filter: drop-shadow(0 0 10px #00e5ff66);
    }

    .intro {
      font-size: 16px; font-weight: 400; color: #b8a8d4;
      margin-bottom: 32px; line-height: 1.65;
    }

    /* ── Info ── */
    .info-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; margin-bottom: 28px; }
    .info-box {
      background: #ffffff07; border: 1px solid #ffffff14; border-radius: 16px;
      padding: 18px 10px; transition: background .2s, border-color .2s, transform .2s;
    }
    .info-box:hover { background: #ffffff0f; border-color: #bf00ff55; transform: translateY(-4px); }
    .info-icon { font-size: 28px; display: block; margin-bottom: 8px; }
    .info-label { font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); margin-bottom: 5px; }
    .info-value { font-size: 14px; font-weight: 700; color: var(--text); line-height: 1.35; }

    /* ── Divider ── */
    .divider {
      display: flex; align-items: center; gap: 12px;
      margin: 8px 0 24px; color: var(--muted);
      font-size: 11px; letter-spacing: 2px; text-transform: uppercase;
    }
    .divider::before, .divider::after {
      content: ''; flex: 1; height: 1px;
      background: linear-gradient(90deg, transparent, #ffffff18, transparent);
    }

    /* ── Frase ── */
    .meme-block {
      background: #ffffff06; border: 1px solid #ff2d7833;
      border-radius: 18px; padding: 22px 20px; margin-bottom: 28px;
    }
    .meme-emoji-big { font-size: 42px; display: block; margin-bottom: 10px; animation: wiggle 1.8s ease-in-out infinite; }
    @keyframes wiggle { 0%,100% { transform: rotate(-6deg); } 50% { transform: rotate(6deg); } }
    .meme-text { font-size: 15px; font-weight: 600; color: #e0c8ff; line-height: 1.6; font-style: italic; }

    /* ── Stickers ── */
    .stickers { font-size: 24px; letter-spacing: 10px; margin-bottom: 24px; opacity: 0.6; }

    /* ── Countdown ── */
    .cd-label { font-size: 10px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: var(--muted); margin-bottom: 12px; }
    .countdown { display: flex; justify-content: center; gap: 10px; margin-bottom: 36px; }
    .count-box {
      background: #ffffff08; border: 1px solid #ffffff14; border-radius: 14px;
      padding: 14px 16px; min-width: 68px; position: relative; overflow: hidden;
    }
    .count-box::before { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, #bf00ff11, transparent); }
    .count-num {
      font-family: 'Black Han Sans', sans-serif; font-size: 30px;
      display: block; line-height: 1;
      background: linear-gradient(180deg, #fff, #b8a8d4);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .count-lbl { font-size: 9px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; color: var(--muted); margin-top: 5px; display: block; }

    /* ── CTA ── */
    .cta {
      display: block;
      background: linear-gradient(135deg, var(--neon1), var(--neon2));
      color: #fff; font-family: 'Outfit', sans-serif; font-size: 17px; font-weight: 800;
      padding: 18px 36px; border-radius: 100px; text-decoration: none; letter-spacing: 0.3px;
      box-shadow: 0 0 24px #bf00ff55, 0 4px 20px #ff2d7844;
      transition: transform .2s, box-shadow .2s; margin-bottom: 12px;
    }
    .cta:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 0 36px #bf00ff88, 0 8px 28px #ff2d7866; }
    .cta:active { transform: scale(0.98); }

    .footer-note { font-size: 13px; color: var(--muted); margin-top: 22px; line-height: 1.6; }
    .footer-note strong { color: var(--neon3); }

    @media (max-width: 500px) {
      .card { padding: 44px 22px 40px; }
      .info-grid { grid-template-columns: 1fr; }
      .countdown { gap: 7px; }
      .count-box { min-width: 58px; padding: 12px 10px; }
    }
  </style>
</head>
<body>

<div class="lights" id="lights"></div>

<div class="page">
  <div class="disco">🪩</div>

  <div class="card">

    <div class="chip">Invitación exclusiva</div>

    <h1 class="title">
      <span class="t1">¡Esta noche</span>
      <span class="t2">la rompes!</span>
    </h1>

    <div class="nombre-wrap">
      <div class="nombre-label">Para</div>
      <div class="nombre"><?= $nombre ?> 🎉</div>
    </div>

    <p class="intro">
      Se viene el cumple y <strong>no te podés quedar en casa</strong>.<br>
      Noche de tragos, música y decisiones cuestionables 🥂
    </p>

    <div class="info-grid">
      <div class="info-box">
        <span class="info-icon">📅</span>
        <div class="info-label">Cuándo</div>
        <div class="info-value">Sábado<br>28 de Marzo</div>
      </div>
      <div class="info-box">
        <span class="info-icon">🎰</span>
        <div class="info-label">Dónde</div>
        <div class="info-value">Boliche<br><strong>Vila Bela</strong></div>
      </div>
      <div class="info-box">
        <span class="info-icon">🕘</span>
        <div class="info-label">A las</div>
        <div class="info-value">21:00 hs<br>¡puntual!</div>
      </div>
    </div>

    <div class="divider">😂 advertencia importante 😂</div>

    <div class="meme-block">
      <span class="meme-emoji-big"><?= $frase['emoji'] ?></span>
      <p class="meme-text"><?= $frase['texto'] ?></p>
    </div>

    <div class="stickers">🍾 💃 🕺 🎶 🥃</div>

    <div class="cd-label">⏳ cuenta regresiva para la noche</div>
    <div class="countdown">
      <div class="count-box">
        <span class="count-num" id="cd-d">--</span>
        <span class="count-lbl">días</span>
      </div>
      <div class="count-box">
        <span class="count-num" id="cd-h">--</span>
        <span class="count-lbl">horas</span>
      </div>
      <div class="count-box">
        <span class="count-num" id="cd-m">--</span>
        <span class="count-lbl">min</span>
      </div>
      <div class="count-box">
        <span class="count-num" id="cd-s">--</span>
        <span class="count-lbl">seg</span>
      </div>
    </div>

    <a class="cta" href="https://wa.me/59160004774?text=<?= urlencode('¡Confirmado! 🍾 Ahí voy esta noche al boliche 🕺🎉') ?>" target="_blank">
      🥳 ¡Confirmar por WhatsApp!
    </a>

    <p class="footer-note">
      Sin <strong><?= $nombre ?></strong> la noche no es lo mismo.<br>
      Te esperamos en <strong>Vila Bela</strong> 🎊
    </p>

  </div>
</div>

<script>
  // Countdown — 28 marzo 2026 a las 21:00
  const fiesta = new Date('2026-03-28T21:00:00');
  function tick() {
    const diff = fiesta - new Date();
    if (diff <= 0) {
      document.querySelector('.countdown').innerHTML =
        '<p style="font-size:20px;font-weight:900;color:#ff2d78;letter-spacing:1px">🎉 ¡ES ESTA NOCHE! ¡VAMOS! 🕺</p>';
      return;
    }
    const pad = n => String(Math.floor(n)).padStart(2,'0');
    document.getElementById('cd-d').textContent = pad(diff / 86400000);
    document.getElementById('cd-h').textContent = pad((diff % 86400000) / 3600000);
    document.getElementById('cd-m').textContent = pad((diff % 3600000)  / 60000);
    document.getElementById('cd-s').textContent = pad((diff % 60000)    / 1000);
  }
  tick(); setInterval(tick, 1000);

  // Luces y partículas
  const lightsEl = document.getElementById('lights');
  const beamColors = ['#ff2d78','#bf00ff','#00e5ff','#ffe600','#ff6b00'];
  for (let i = 0; i < 10; i++) {
    const b = document.createElement('div');
    b.className = 'beam';
    b.style.cssText = `
      left:${10 + i * 8}%;
      background: linear-gradient(180deg, ${beamColors[i % beamColors.length]}, transparent);
      animation-duration:${4 + Math.random()*5}s;
      animation-delay:${Math.random()*5}s;
      width:${2 + Math.random()*4}px;
    `;
    lightsEl.appendChild(b);
  }
  const pColors = ['#ff2d78','#bf00ff','#00e5ff','#ffe600'];
  for (let i = 0; i < 35; i++) {
    const p = document.createElement('div');
    const sz = Math.random()*6+3;
    p.className = 'particle';
    p.style.cssText = `
      left:${Math.random()*100}%;
      width:${sz}px; height:${sz}px;
      background:${pColors[Math.floor(Math.random()*pColors.length)]};
      box-shadow:0 0 6px currentColor;
      animation-duration:${6+Math.random()*8}s;
      animation-delay:${Math.random()*8}s;
    `;
    lightsEl.appendChild(p);
  }
</script>

</body>
</html>
