<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Última Partida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #1F2326; /* Fondo principal de la paleta */
        color: #8C5C03; /* Texto principal */
        text-align: center;
    }

    .disabled {
        opacity: 0.5;
        pointer-events: none;
        cursor: not-allowed;
        background-color: #734002; /* Fondo para elementos deshabilitados */
    }

    .container {
        margin-top: 50px;
        background-color: #2A2F33; /* Fondo ligeramente más claro */
        border: 1px solid #734002; /* Borde con color de la paleta */
        border-radius: 8px;
        padding: 20px;
    }

    h2 {
        color: #F2BF27; /* Acento para el título */
        border-bottom: 2px solid #734002; /* Borde inferior */
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .card-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .warrior-card {
        width: 210px;
        height: 310px;
        perspective: 1000px;
        cursor: pointer;
    }

    .card-inner {
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.6s;
    }

    .flipped .card-inner {
        transform: rotateY(180deg);
    }

    .card-front, .card-back {
        width: 100%;
        height: 100%;
        position: absolute;
        backface-visibility: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 8px #734002; /* Sombra con color de la paleta */
    }

    .card-front {
        background: #2A2F33; /* Fondo ligeramente más claro */
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        color: #F2BF27; /* Acento para texto */
        border: 2px solid #734002; /* Borde con color de la paleta */
    }

    .card-back {
        transform: rotateY(180deg);
        background-size: cover;
        background-position: center;
        border: 2px solid #734002; /* Borde con color de la paleta */
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        padding-top: 10px;
    }

    .card-back strong {
        color: #F2BF27; /* Acento para el nombre */
        font-size: 14px;
    }

    .info-overlay {
        position: absolute;
        bottom: 0;
        background: rgba(31, 35, 38, 0.7); /* Fondo semitransparente basado en #1F2326 */
        color: #F2BF27; /* Acento para texto */
        width: 100%;
        padding: 5px;
        font-size: 12px;
        text-align: center;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .player-profile {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin-bottom: 20px;
    }

    .player-profile img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid #734002; /* Borde con color de la paleta */
        object-fit: cover;
        max-width: 100%;
        transition: border-color 0.3s;
    }

    .player-profile img:hover {
        border-color: #F2BF27; /* Acento para hover */
    }

    .player-profile h3 {
        margin-top: 10px;
        font-size: 1.2rem;
        color: #F2BF27; /* Acento para título */
    }

    .selected {
        border: 3px solid #F2BF27 !important; /* Acento para selección */
        border-radius: 10px;
    }

    .flipped .card-front {
        display: none;
    }

    .flipped .card-back {
        display: block;
    }

    .player-life {
        font-size: 1.2rem;
        font-weight: bold;
        color: #F2BF27; /* Acento en lugar de rojo */
        margin-top: 5px;
    }

    .btn-primary {
        background-color: #1F2326; /* Fondo del botón Ver Detalles */
        color: #F2BF27; /* Texto con acento */
        border: 1px solid #734002; /* Borde con color de la paleta */
        border-radius: 5px;
        padding: 10px 20px;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-primary:hover {
        background-color: #F2BF27; /* Acento para hover */
        color: #1F2326;
    }

    .btn-danger {
        background-color: #BF8415; /* Fondo del botón Iniciar Pelea */
        color: #1F2326; /* Texto oscuro para contraste */
        border: 1px solid #734002; /* Borde con color de la paleta */
        border-radius: 5px;
        padding: 12px 24px;
        font-size: 1.2rem;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-danger:hover {
        background-color: #F2BF27; /* Acento para hover */
        color: #1F2326;
    }

    .modal-content {
        background-color: #2A2F33; /* Fondo del modal */
        border: 1px solid #734002; /* Borde con color de la paleta */
        border-radius: 10px;
    }

    .modal-header {
        background-color: #1F2326; /* Fondo del encabezado */
        border-bottom: 1px solid #734002; /* Borde inferior */
    }

    .modal-title {
        color: #F2BF27; /* Acento para el título */
    }

    .btn-close {
        filter: invert(1) sepia(1) saturate(5) hue-rotate(180deg); /* Ícono blanco ajustado */
    }

    .modal-body {
        color: #8C5C03; /* Texto principal */
    }

    .list-group-item {
        background-color: #1F2326; /* Fondo de los ítems */
        color: #8C5C03; /* Texto principal */
        border: 1px solid #734002; /* Borde con color de la paleta */
    }

    .list-group-item strong {
        color: #F2BF27; /* Acento para etiquetas */
    }

    .modal-footer {
        border-top: 1px solid #734002; /* Borde superior */
    }

    .btn-secondary {
        background-color: #734002; /* Fondo del botón Cerrar */
        color: #F2BF27; /* Texto con acento */
        border: 1px solid #734002; /* Borde con color de la paleta */
    }

    .btn-secondary:hover {
        background-color: #F2BF27; /* Acento para hover */
        color: #1F2326;
    }

    #battleResultModal .modal-content {
        background-color: #2A2F33; /* Fondo del modal de resultado */
        border: 2px solid #734002; /* Borde con color de la paleta */
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .card-container {
            flex-wrap: wrap;
        }

        .warrior-card {
            width: 45%;
            max-width: 45%;
        }
    }

    @media (max-width: 576px) {
        .warrior-card {
            width: 100%;
            max-width: 100%;
        }
    }
        </style>
</head>
<body>
<?php require_once('../app/Views/preload/preload.php'); ?>
<?php require_once('../app/Views/nav/navbarJuego.php'); ?>

<div class="container">
    <h2>Última Partida</h2>

    <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#gameDetailsModal">
        Ver Detalles de la Partida
    </button>

    <?php 
    function getRandomWarriors($warriors) {
        $randomWarriors = [];
        if (!empty($warriors)) {
            for ($i = 0; $i < 5; $i++) {
                $randomWarriors[] = $warriors[array_rand($warriors)];
            }
        }
        return $randomWarriors;
    }

    $player1Cards = isset($warriors) ? getRandomWarriors($warriors) : [];
    $player2Cards = isset($warriors) ? getRandomWarriors($warriors) : [];
    ?>

    <!-- Contenedor de jugadores -->
    <div class="players-container">
    <!-- Jugador 1 -->
    <div class="player">
        <div class="player-profile" data-player="1">
            <input type="hidden" name="profile_id" id="profile_id1" value="<?= isset($profile1['profile_id']) ? esc($profile1['profile_id']) : '' ?>">
             <img src="<?= isset($profile1['profile_photo']) ? base_url($profile1['profile_photo']) : base_url('default_profile.png') ?>" alt="Perfil 1">
            <h3><?= isset($profile1['profile_name']) ? esc($profile1['profile_name']) : 'Jugador 1' ?></h3>
            <p class="player-life">❤️ Vida: <?= isset($partida['player_life']) ? esc($partida['player_life']) : '0' ?></p>
        </div>
        <div class="card-container">
            <?php foreach ($player1Cards as $w): ?>
                <div class="warrior-card" 
                    data-player="1" 
                    data-warrior-id="<?= esc($w['warrior_id']) ?>" 
                    data-power-percentage="<?= esc($w['power_percentage']) ?>" 
                    data-spell-percentage="<?= esc($w['spell_percentage']) ?>" 
                    onclick="flipCard(this)" 
                    oncontextmenu="selectCard(event, this)">
                    <div class="card-inner">
                        <div class="card-front">?</div>
                        <div class="card-back" style="background-image: url('<?= !empty($w['warrior_image']) ? base_url('uploads/' . $w['warrior_image']) : base_url('uploads/default_warrior.png') ?>');">
                            <strong><?= esc($w['warrior_name']) ?></strong>
                            <div class="info-overlay">
                                <p><strong>Raza:</strong> <?= esc($w['warrior_race']) ?></p>
                                <p><strong>Vida:</strong> <span class="warrior-life"><?= esc($w['warrior_life']) ?></span></p>
                                <p><strong>Daño:</strong> <?= esc($w['warrior_damage']) ?></p>

                                <?php if ($partida['win_condition'] == 'poder'): ?>
                                    <p><strong>Poder:</strong> <?= esc($w['power_name'] ?? 'N/A') ?></p>
                                <?php elseif ($partida['win_condition'] == 'magia'): ?>
                                    <p><strong>Hechizo:</strong> <?= esc($w['spell_name'] ?? 'N/A') ?></p>
                                <?php elseif ($partida['win_condition'] == 'suma'): ?>
                                    <p><strong>Poder:</strong> <?= esc($w['power_name'] ?? 'N/A') ?></p>
                                    <p><strong>Hechizo:</strong> <?= esc($w['spell_name'] ?? 'N/A') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Jugador 2 -->
    <div class="player">
        <div class="player-profile" data-player="2">
            <input type="hidden" name="profile_id" id="profile_id2" value="<?= isset($profile2['profile_id']) ? esc($profile2['profile_id']) : '' ?>">
            <img src="<?= isset($profile2['profile_photo']) ? base_url($profile2['profile_photo']) : base_url('default_profile.png') ?>" alt="Perfil 2">
            <h3><?= isset($profile2['profile_name']) ? esc($profile2['profile_name']) : 'Jugador 2' ?></h3>
            <p class="player-life">❤️ Vida: <?= isset($partida['player_life']) ? esc($partida['player_life']) : '0' ?></p>
        </div>
        <div class="card-container">
            <?php foreach ($player2Cards as $w): ?>
                <div class="warrior-card" 
                    data-player="2" 
                    data-warrior-id="<?= esc($w['warrior_id']) ?>" 
                    data-power-percentage="<?= esc($w['power_percentage']) ?>" 
                    data-spell-percentage="<?= esc($w['spell_percentage']) ?>" 
                    onclick="flipCard(this)" 
                    oncontextmenu="selectCard(event, this)">
                    <div class="card-inner">
                        <div class="card-front">?</div>
                        <div class="card-back" style="background-image: url('<?= !empty($w['warrior_image']) ? base_url('uploads/' . $w['warrior_image']) : base_url('uploads/default_warrior.png') ?>');">
                            <strong><?= esc($w['warrior_name']) ?></strong>
                            <div class="info-overlay">
                                <p><strong>Raza:</strong> <?= esc($w['warrior_race']) ?></p>
                                <p><strong>Vida:</strong> <span class="warrior-life"><?= esc($w['warrior_life']) ?></span></p>
                                <p><strong>Daño:</strong> <?= esc($w['warrior_damage']) ?></p>

                                <?php if ($partida['win_condition'] == 'poder'): ?>
                                    <p><strong>Poder:</strong> <?= esc($w['power_name'] ?? 'N/A') ?></p>
                                <?php elseif ($partida['win_condition'] == 'magia'): ?>
                                    <p><strong>Hechizo:</strong> <?= esc($w['spell_name'] ?? 'N/A') ?></p>
                                <?php elseif ($partida['win_condition'] == 'suma'): ?>
                                    <p><strong>Poder:</strong> <?= esc($w['power_name'] ?? 'N/A') ?></p>
                                    <p><strong>Hechizo:</strong> <?= esc($w['spell_name'] ?? 'N/A') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="text-center mt-4">
    <button class="btn btn-danger btn-lg" id="startBattle" onclick="startBattle()">🔥 Iniciar Pelea 🔥</button>
</div>



<!-- Modal para detalles de la partida -->
<div class="modal fade" id="gameDetailsModal" tabindex="-1" aria-labelledby="gameDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gameDetailsModalLabel">Detalles de la Partida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> <?= isset($partida['id']) ? esc($partida['id']) : 'N/A' ?></li>
                    <li class="list-group-item"><strong>Nombre:</strong> <?= isset($partida['game_name']) ? esc($partida['game_name']) : 'N/A' ?></li>
                    <li class="list-group-item"><strong>Modo:</strong> <?= isset($partida['game_mode']) ? esc($partida['game_mode']) : 'N/A' ?></li>
                    <li class="list-group-item"><strong>Duración:</strong> <?= isset($partida['duration']) ? esc($partida['duration']) . ' minutos' : 'N/A' ?></li>
                    <li class="list-group-item"><strong>Condición de Victoria:</strong> <?= isset($partida['win_condition']) ? esc($partida['win_condition']) : 'N/A' ?></li>
                    <li class="list-group-item"><strong>Estado:</strong> <?= isset($partida['status']) ? esc($partida['status']) : 'N/A' ?></li>
                    <li class="list-group-item"><strong>Vida del Jugador:</strong> <?= isset($partida['player_life']) ? esc($partida['player_life']) : 'N/A' ?></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal de resultado de batalla -->
<div class="modal fade" id="battleResultModal" tabindex="-1" aria-labelledby="battleResultModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: white; color: black; border: 2px solid red;">
      <div class="modal-header">
        <h5 class="modal-title" id="battleResultModalLabel">⚔️ Resultado de la Batalla</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" id="battleResultText" style="text-align: center; font-size: 18px;">
        <!-- Aquí se mostrará el resultado -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    // Voltea la carta según el jugador
    function flipCard(card) {
        card.classList.toggle("flipped");
    }

    // Selecciona una carta
    // Selecciona una carta
    function selectCard(event, card) {
    event.preventDefault();

    // Obtiene las cartas seleccionadas del jugador
    const player = card.getAttribute("data-player");
    const selectedCards = document.querySelectorAll(`.warrior-card[data-player="${player}"].selected`);

    if (selectedCards.length < 2) {
        card.classList.add("selected");
    } else {
        alert("¡Solo puedes seleccionar dos cartas por jugador!");
    }
    }
    function startBattle() {
    let selectedCards = document.querySelectorAll(".warrior-card.selected");

    if (selectedCards.length < 2) {
        alert("¡Cada jugador debe seleccionar una carta antes de iniciar la pelea!");
        return;
    }

    let player1Card = document.querySelector('.warrior-card[data-player="1"].selected');
    let player2Card = document.querySelector('.warrior-card[data-player="2"].selected');

    if (!player1Card || !player2Card) {
        alert("¡Cada jugador debe seleccionar su carta!");
        console.error("Error: No se encontraron las cartas seleccionadas.");
        return;
    }

    let card1Data = extractCardData(player1Card);
    let card2Data = extractCardData(player2Card);

    if (!card1Data || !card2Data) {
        console.error("Error: No se pudo extraer la información de las cartas.");
        return;
    }

    console.log("Carta 1:", card1Data);
    console.log("Carta 2:", card2Data);

    let battleMode = "<?= isset($partida['win_condition']) ? esc($partida['win_condition']) : '' ?>";

    let winner = determineWinner(card1Data, card2Data);
    let loser = winner === card1Data ? card2Data : card1Data;

    console.log(`Ganador: ${winner.name}, Perdedor: ${loser.name}`);

    let powerResult = calculatePower(winner, battleMode);

    console.log(`Daño causado: ${powerResult}`);

    let remainingDamage = powerResult - loser.life;
    loser.life = Math.max(0, loser.life - powerResult);

    if (remainingDamage > 0) {
        updatePlayerLife(loser.player, remainingDamage);
    }

    console.log(`Vida restante del perdedor (${loser.name}): ${loser.life}`);
    console.log(`Daño restante aplicado al jugador: ${remainingDamage}`);

    if (loser.life <= 0) {
    let loserPlayer = loser.player === "1" ? "Jugador 1" : "Jugador 2";
    let newLife = updatePlayerLife(loser.player, loser.life);

    if (newLife <= 0) {
        alert(`${loserPlayer} ha perdido la partida. ¡Fin del juego!`);

        // Determinar el ID del ganador basado en el jugador que perdió
        let winnerProfileId;

        // Accedemos al profile_id según el jugador que perdió
        if (loser.player === "1") {
            // Si el jugador que perdió es el 1, el ganador es el jugador 2
            winnerProfileId = document.querySelector('#profile_id2').value;
         
        } else {
            // Si el jugador que perdió es el 2, el ganador es el jugador 1
            winnerProfileId = document.querySelector('#profile_id1').value;
        
        }

        // Guardar la victoria en la base de datos antes de redirigir
        updateWins(winnerProfileId)
            .then(() => {
                // Aquí puedes redirigir a otra página si lo deseas
                window.location.href = "/tabla-lideres"; // Ajusta según tu ruta en CodeIgniter
            })
            .catch(error => {
                console.error("Error al actualizar victorias:", error);
                alert("Hubo un error al actualizar la victoria.");
            });

        return;
    }
}

    // Bloquear las cartas después de la batalla
    player1Card.classList.add("used", "disabled");
    player2Card.classList.add("used", "disabled");

    // Remover la selección de las cartas después de la batalla
    player1Card.classList.remove("selected");
    player2Card.classList.remove("selected");

    // Deshabilitar la funcionalidad de click en las cartas usadas
    player1Card.onclick = null;
    player2Card.onclick = null;

    let remainingCards = document.querySelectorAll(".warrior-card:not(.used)");
    if (remainingCards.length === 0) {
        shuffleCards();
    }
}

    // Extrae los datos de la carta seleccionada
function extractCardData(cardElement) {
    if (!cardElement) {
        console.error("Error: El elemento de la carta no es válido.");
        return null;
    }

    let warriorId = cardElement.getAttribute("data-warrior-id");
    let warriorNameElement = cardElement.querySelector(".card-back strong");
    
    if (!warriorId) {
        console.error("Error: No se encontró el ID del guerrero en la carta.");
        return null;
    }

    let warriorName = warriorNameElement ? warriorNameElement.innerText.trim() : `Guerrero ${warriorId}`;
    return {
        id: cardElement.getAttribute("data-warrior-id"),
        name: cardElement.querySelector(".card-back strong")?.innerText.trim() || "Guerrero",
        power: parseFloat(cardElement.getAttribute("data-power-percentage")) || 0,
        spell_power: parseFloat(cardElement.getAttribute("data-spell-percentage")) || 0,
        power_percentage: parseFloat(cardElement.getAttribute("data-power-percentage")) || 0,
        spell_percentage: parseFloat(cardElement.getAttribute("data-spell-percentage")) || 0,
        life: parseFloat(cardElement.querySelector(".warrior-life")?.innerText) || 0,
        player: cardElement.getAttribute("data-player"),
    };

   
}

function calculatePower(winner, battleMode) {
    let powerResult = 0;
    let power = winner.power || 0;
    let spellPower = winner.spell_power || 0;
    let powerPercentage = winner.power_percentage || 0;
    let spellPercentage = winner.spell_percentage || 0;

    if (battleMode === "poder") {
        powerResult = power + (power * (powerPercentage / 100));
    } else if (battleMode === "magia") {
        powerResult = spellPower + (spellPower * (spellPercentage / 100));
    } else if (battleMode === "suma") {
        let percentageSum = powerPercentage + spellPercentage;
        let powerSum = power + spellPower;
        powerResult = percentageSum * powerSum;
    }

    return Math.max(1, powerResult);
}


function determineWinner(card1, card2) {
    if (!card1 || !card2 || !card1.id || !card2.id) {
        console.error("Error: Cartas no válidas para determinar ganador.");
        return Math.random() < 0.5 ? card1 : card2;
    }

    const id1 = parseInt(card1.id);
    const id2 = parseInt(card2.id);

    const counters = {
        1: { pierde: [3, 8, 6], gana: [4, 2, 7], empata: [5, 9] },
        2: { pierde: [5, 1, 8], gana: [3, 4, 7], empata: [6, 10] },
        3: { pierde: [2, 4, 1], gana: [5, 6, 8], empata: [7, 9] },
        4: { pierde: [1, 8, 2], gana: [3, 6, 7], empata: [5, 10] },
        5: { pierde: [3, 2, 6], gana: [2, 8, 1], empata: [4, 9] },
        6: { pierde: [7, 4, 3], gana: [8, 5, 2], empata: [1, 10] },
        7: { pierde: [1, 8, 2], gana: [5, 6, 3], empata: [4, 9] },
        8: { pierde: [5, 6, 4], gana: [1, 7, 2], empata: [3, 10] },
        9: { pierde: [1, 3, 7], gana: [2, 5, 10], empata: [4, 8] },
        10: { pierde: [2, 4, 6], gana: [3, 5, 9], empata: [1, 8] }
    };

    let resultado = "";
    let ganador, perdedor;
    let dañoCausado = Math.floor(Math.random() * (200 - 100 + 1)) + 100;
    let dañoRestante = Math.floor(Math.random() * (100 - 50 + 1)) + 50;
    let vidaRestante = 0;

    if (!counters[id1] || !counters[id2]) {
        resultado = `Error: No se encontró el guerrero en el counter: ${card1.name} o ${card2.name}.`;
        mostrarModal(resultado);
        return Math.random() < 0.5 ? card1 : card2;
    }

    if (counters[id1].gana.includes(id2)) {
        ganador = card1;
        perdedor = card2;
    } else if (counters[id2].gana.includes(id1)) {
        ganador = card2;
        perdedor = card1;
    } else {
        resultado = `❓ No hay regla definida entre ${card1.name} y ${card2.name}, eligiendo aleatorio.<br>
        Ganador: ${card1.name} Perdedor: ${card2.name}<br>
        Daño causado: ${dañoCausado}<br>
         Vida restante del perdedor (${card2.name}): ${vidaRestante}<br>
         Daño restante aplicado al jugador: ${dañoRestante}`;
        
        mostrarModal(resultado);
        return Math.random() < 0.5 ? card1 : card2;
    }

    resultado = `⚔️ <strong>${ganador.name}</strong> ha derrotado a <strong>${perdedor.name}</strong>.<br>
        Ganador: ${ganador.name} Perdedor: ${perdedor.name}<br>
        Daño causado: ${dañoCausado}<br>
        Vida restante del perdedor (${perdedor.name}): ${vidaRestante}<br>
       Daño restante aplicado al jugador: ${dañoRestante}`;

    mostrarModal(resultado);

    updateWins(ganador.profile_id);

    return ganador;
}
// Función para mostrar el modal con la información
function mostrarModal(mensaje) {
    document.getElementById("battleResultText").innerHTML = mensaje;
    let modal = new bootstrap.Modal(document.getElementById("battleResultModal"));
    modal.show();
}


    
function updatePlayerLife(player, damage) {
    let playerLifeElement = document.querySelector(`.player-profile[data-player="${player}"] .player-life`);

    if (!playerLifeElement) {
        console.error(`No se encontró la vida del jugador ${player}.`);
        return;
    }

    let currentLife = parseInt(playerLifeElement.innerText.replace("❤️ Vida: ", "").trim());
    let newLife = Math.max(0, currentLife - damage);

    playerLifeElement.innerText = `❤️ Vida: ${newLife}`;

    return newLife;
}

function shuffleCards() {
    let allCards = document.querySelectorAll(".warrior-card");

    allCards.forEach(card => {
        card.classList.remove("used", "disabled", "selected", "flipped");
        card.onclick = function () {
            flipCard(this);
        };
    });

    alert("¡Se han barajado las cartas y están listas para la siguiente ronda!");
    console.log("Las cartas han sido barajadas y desbloqueadas.");
}
async function updateWins(winnerProfileId) {
   
   
    fetch("/update-wins", { 
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ profile_id: winnerProfileId })
    })

}


</script>

<footer>
<?php require_once('../app/Views/footer/footerJuego.php'); ?>
</footer>
</html>
