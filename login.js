const express = require('express');
const app = express();

app.use(express.urlencoded({ extended: true }));

app.get('/login', (req, res) => {
  res.send(`
    <form action="/login" method="post">
      <input type="text" name="who" placeholder="Email" />
      <input type="password" name="pass" placeholder="Password" />
      <input type="submit" value="Log In" />
    </form>
  `);
});

app.post('/login', (req, res) => {
  const { who, pass } = req.body;

  if (who === 'umsi@umich.edu' && pass === 'correctpassword') {
    res.send('Login successful');
  } else {
    res.status(401).send('Login failed');
  }
});

app.listen(3000, () => console.log('Server running on port 3000'));
