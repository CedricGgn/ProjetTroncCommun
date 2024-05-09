const express = require('express');
const bp = require('body-parser');
const path = require('path'); // Pour obtenir les chemins absolus
const session = require('express-session');
const Twig = require("twig");

const app = express();
const PORT = 50180;

app.set('view engine', 'twig');

// Configuration des sessions
app.use(
    session({
      secret: 'votre_secret_de_session',
      resave: false,
      saveUninitialized: false,
      cookie: { secure: false }, // Utilisez secure: true en production avec HTTPS
    })
  );

// Configuration du moteur de templates Twig
app.set('view engine', 'twig');
app.set('views', path.join(__dirname, '/src/HTML')); // Indique où se trouvent les fichiers Twig

// Utilisation de body-parser
app.use(bp.json());
app.use(bp.urlencoded({ extended: true }));

// Configuration de l'emplacement des fichiers statiques
app.use(express.static(path.join(__dirname + '/src')));



app.listen(PORT, () => {
    console.log(`Server running at http://localhost:${PORT}`);
});

// --------------------------- DATABASE -------------------------------

const {Pool} = require('pg');
const pool = new Pool({
    user: 'admin',
    host: 'localhost',
    database: 'postgres',
    password: 'admin',
    port: 5432
});

pool.connect();

pool.query(`SELECT battery, brightness FROM data ORDER BY id DESC LIMIT 1`, (err, res)=>{
    if(!err) {
    console.log(res.rows); 
    } else {
    console.log(err.message);
    }
    pool.end;
})

// ------------------- Twig and page -------------------

// This section is optional and used to configure twig.
app.set("twig options", {
    allowAsync: true, // Allow asynchronous compiling
    strict_variables: false
});


app.get('/', (req,res) => {
    res.redirect('/login'); // Vous pouvez ajuster l'URL de redirection selon vos besoins
});

// Route avec vérification de session
app.get('/main', async (req, res) => {
  try {
      const result = await pool.query("SELECT battery, brightness FROM data ORDER BY id DESC LIMIT 1");

      if (result.rows.length > 0) {
        const battery = result.rows[0].battery;
        const brightness = result.rows[0].brightness;

        if (!req.session.username) {
          req.session.username = 'invité';
          return res.render('main', { 
            session : req.session,
            battery: battery,
            brightness: brightness
          });
        } else {
          res.render('main', { 
            session: req.session,
            battery: battery,
            brightness: brightness
          });
        }
      } else {
          res.render('main', {
              session: req.session,
              message: 'No data found'
          });
      }
    
  } catch (err) {
      console.error("Error querying database:", err.message);
      res.status(500).send("Internal Server Error");
  }
});



  // Route d'exemple avec vérification de session
app.get('/login', (req, res) => {
    if (req.session.username) {
      // Utilisez res.render au lieu de echo
      res.render(__dirname + '/src/HTML/login.twig', { session: req.session }); // Passez la session à Twig
    } else {
      res.render(__dirname + '/src/HTML/login.twig', { session: 'invité' });
    }
  });



app.post('/login', async (req, res) => {
    const { username, password } = req.body;
    let message = "";

    // Vérifiez si les champs sont vides
    if (!username || !password) {
        message = "Un ou plusieurs champs sont vides";
        res.render('login', { content: message });
        return;
    }

    try {
        const result = await pool.query("SELECT password_hash FROM users WHERE username = $1", [username]);
        if (result.rowCount === 0) {
            message = "Nom d'utilisateur incorrect";
            res.render('login', { content: message });
            return;
        }

        const hashedPassword = result.rows[0].password_hash;
        if (hashedPassword !== password) {
            message = "Mot de passe incorrect";
            res.render('login', { content: message });
            return;
        }

        // Si tout est correct, définissez la session et rendez la vue principale
        req.session.username = username;


        // Render the view with a JavaScript redirect

       res.redirect('/main'); // Vous pouvez ajuster l'URL de redirection selon vos besoins


    } catch (err) {
        console.error("Error querying database:", err);
        res.status(500).send("Erreur du serveur");
    }
});

// Route pour la déconnexion
app.get('/logout', (req, res) => {
    // Détruire la session
    req.session.destroy((err) => {
      if (err) {
        console.error('Erreur lors de la destruction de la session:', err);
        res.status(500).send('Erreur du serveur');
      } else {
        // Rediriger vers la page de connexion ou une autre page
        res.redirect('/login'); // Vous pouvez ajuster l'URL de redirection selon vos besoins
      }
    });
  });