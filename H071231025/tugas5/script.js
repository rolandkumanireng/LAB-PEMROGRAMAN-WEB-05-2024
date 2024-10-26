const suits = ['S', 'H', 'D', 'C'];
const values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
let deck = [];
let playerHand = [];
let dealerHand = [];
let balance = 1000; 
let bet = 0; 

const cardImageUrls = {
  S:  [
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/S01.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/S02.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/S03.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/S04.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/S05.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/S06.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/S07.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/S08.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/S09.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/S10.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/SC1J.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/SC2Q.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/SC3K.jpg'
    ],
  H:  [
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/H01.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/H02.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/H03.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/H04.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/H05.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/H06.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/H07.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/H08.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/H09.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/H10.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/HC1J.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/HC2Q.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/HC3K.jpg'
    ],
  D:  [
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/D01.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/D02.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/D03.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/D04.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/D05.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/D06.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/D07.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/D08.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/D09.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/D10.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/DC1J.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/DC2Q.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/DC3K.jpg'
    ],
  C: [
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/C01.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/C02.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/C03.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/C04.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/C05.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/C06.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/C07.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/C08.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/C09.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/C10.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/CC1J.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/CC2Q.jpg',
    'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/CC3K.jpg'
    ]
};

function createDeck() {
  deck = [];
  for (let suit of suits) {
    for (let value of values) {
      deck.push({ suit, value, image: cardImageUrls[suit][values.indexOf(value)] });
    }
  }
}

function shuffleDeck() {
  for (let i = deck.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [deck[i], deck[j]] = [deck[j], deck[i]];
  }
}

function dealCard() {
  return deck.pop();
}

function calculateHandValue(hand) {
  let value = 0;
  let hasAce = false;
  for (let card of hand) {
    if (card.value === 'A') {
      hasAce = true;
      value += 11;
    } else if (['K', 'Q', 'J'].includes(card.value)) {
      value += 10;
    } else {
      value += parseInt(card.value);
    }
  }
  if (hasAce && value > 21) value -= 10;
  return value;
}

function updateHandDisplay(hand, elementId) {
  const handElement = document.getElementById(elementId);
  handElement.innerHTML = '';
  for (let card of hand) {
    const cardElement = document.createElement('img');
    cardElement.className = 'card';
    cardElement.src = card.image;
    cardElement.alt = `${card.value} of ${card.suit}`;
    handElement.appendChild(cardElement);
  }
}

function startNewGame() {
  if (bet <= 0) {
    alert('Silakan taruh taruhan terlebih dahulu!');
    return;
  }

    
 

  createDeck();
  shuffleDeck();
  playerHand = [dealCard(), dealCard()];
  dealerHand = [dealCard(), dealCard()];
  updateHandDisplay(playerHand, 'playerHand');
  updateHandDisplay([dealerHand[0], { value: 'back', suit: 'back', image: 'https://www.marytcusack.com/maryc/decks/Images/Cards/DedaloApeiron/zback.jpg' }], 'dealerHand');
  document.getElementById('result').textContent = '';
  document.getElementById('hitButton').disabled = false;
  document.getElementById('standButton').disabled = false;
}

function hit() {
  playerHand.push(dealCard());
  updateHandDisplay(playerHand, 'playerHand');
  if (calculateHandValue(playerHand) > 21) {
    endGame('Anda kalah!');
  }
}

function stand() {
  showDealerCards().then(() => {
    while (calculateHandValue(dealerHand) < 17) {
      dealerHand.push(dealCard());
    }
    updateHandDisplay(dealerHand, 'dealerHand');
    const playerValue = calculateHandValue(playerHand);
    const dealerValue = calculateHandValue(dealerHand);
    determineWinner(playerValue, dealerValue);
  });
}

function showDealerCards() {
  return new Promise(resolve => {
    const dealerElement = document.getElementById('dealerHand');
    dealerElement.innerHTML = '';
    dealerHand.forEach((card, index) => {
      const cardElement = document.createElement('img');
      cardElement.className = 'card';
      cardElement.src = card.image;
      cardElement.alt = `${card.value} of ${card.suit}`;
      dealerElement.appendChild(cardElement);
      if (index === 0) {
        setTimeout(() => {
          dealerElement.innerHTML = '';
          dealerHand.forEach((card) => {
            const cardElement = document.createElement('img');
            cardElement.className = 'card';
            cardElement.src = card.image;
            cardElement.alt = `${card.value} of ${card.suit}`;
            dealerElement.appendChild(cardElement);
          });
          resolve();
        }, 1000);
      }
    });
  });
}

function determineWinner(playerValue, dealerValue) {
  setTimeout(() => {
    if (dealerValue > 21 || playerValue > dealerValue) {
      endGame('Anda menang!');
    } else if (playerValue < dealerValue) {
      endGame('Anda kalah!');
    } else {
      endGame('Seri!');
    }
  }, 1000); 
}

function endGame(message) {
  document.getElementById('result').textContent = message;
  document.getElementById('hitButton').disabled = true;
  document.getElementById('standButton').disabled = true;

  const playerValue = calculateHandValue(playerHand);
  const dealerValue = calculateHandValue(dealerHand);

  if (message === 'Anda menang!') {
    balance += bet * 2;
    showAlert(`Selamat! Anda menang! Saldo baru Anda: ${balance}`);
  } else if (message === 'Seri!') {
    balance += bet;
    showAlert(`Seri! Saldo Anda tetap: ${balance}`);
  } else {
    showAlert(`Anda kalah! Saldo baru Anda: ${balance}`);
  }

  updateBalanceDisplay();
  bet = 0;
}

function showAlert(message) {
  setTimeout(() => {
    alert(message);
  }, 1000); 
}

function updateBalanceDisplay() {
  document.getElementById('balanceDisplay').textContent = balance;
}

function placeBet() {
  const betInput = document.getElementById('betInput');
  bet = parseInt(betInput.value);

  if (isNaN(bet) || bet <= 0) {
    alert('Masukkan jumlah taruhan yang valid!');
    return;
  }

  if (bet > balance) {
    alert('Taruhan tidak boleh lebih besar dari saldo!');
    return;
  }

  balance -= bet;
  updateBalanceDisplay();
  alert(`Taruhan Anda sebesar ${bet} telah diterima. Selamat bermain!`);
  startNewGame();
}

document.getElementById('hitButton').addEventListener('click', hit);
document.getElementById('standButton').addEventListener('click', stand);
document.getElementById('newGameButton').addEventListener('click', startNewGame);
document.getElementById('betButton').addEventListener('click', placeBet);

updateBalanceDisplay();