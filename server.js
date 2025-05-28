const express = require('express');
const bodyParser = require('body-parser');
const session = require('express-session');
const path = require('path');

const app = express();
const PORT = 3000;

app.use(bodyParser.urlencoded({ extended: true }));

app.use(session({
  secret: 'secret',
  resave: false,
  saveUninitialized: true,
}));

app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'index.html'));
});

// ✅ Fix 405: redirect GETs to homepage
app.get('/login', (req, res) => res.redirect('/'));
app.get('/play', (req, res) => res.redirect('/'));

// Handle login
app.post('/login', (req, res) => {
  const { who, pass } = req.body;
  if (who === 'user@example.com' && pass === '123') {
    req.session.user = who;
    res.send(`<h2>Welcome, ${who}!</h2><a href="/">Back</a>`);
  } else {
    res.send(`<h2>Login failed</h2><a href="/">Try again</a>`);
  }
});

// Handle play
app.post('/play', (req, res) => {
  if (!req.session.user) {
    return res.send(`<h2>Please login first</h2><a href="/">Login</a>`);
  }

  const userMove = req.body.move;
  const moves = ['Rock', 'Paper', 'Scissors'];
  const computerMove = moves[Math.floor(Math.random() * 3)];

  let result;
  if (userMove === computerMove) result = "It's a tie!";
  else if (
    (userMove === 'Rock' && computerMove === 'Scissors') ||
    (userMove === 'Paper' && computerMove === 'Rock') ||
    (userMove === 'Scissors' && computerMove === 'Paper')
  ) result = "You win!";
  else result = "You lose!";

  res.send(`
    <h2>You chose: ${userMove}</h2>
    <h2>Computer chose: ${computerMove}</h2>
    <h2>${result}</h2>
    <a href="/">Play Again</a>
  `);
});

app.listen(PORT, () => {
  console.log(`✅ Server running: http://localhost:${PORT}`);
});
