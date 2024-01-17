<?php
session_start();
class Form {
    private $url;
    private $title;
    private $metaDescription;
    private $conn; // Připojení k databázi
    public function __construct() {
        // Inicializace proměnných nebo jiné potřebné úkony při vytváření instance třídy
        $this->url = '';
        $this->title = '';
        $this->metaDescription = '';
        $this->connectToDatabase();
    }

    public function connectToDatabase() {

        // MySQL databáze
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "smate";

        // Vytvoření připojení
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Kontrola připojení
        if ($this->conn->connect_error) {
            die("Chyba připojení k databázi: " . $this->conn->connect_error);
        }
    }

    public function renderForm() {
        echo '<form method="post" action="" class="form-data">';
        echo '  <label for="url" class="common-label">URL</label>';
        echo '  <input type="text" class="url" name="url" id="url" required>';
        echo '  <br>';

        echo '  <label for="title" class="common-label">Title</label>';
        echo '  <input type="text" class="title" name="title" id="title" required>';
        echo '  <br>';

        echo '  <label for="meta_description" class="common-label">Meta Description</label>';
        echo '  <textarea name="meta_description" class="meta-description" id="meta_description" required></textarea>';
        echo '  <br>';

        echo '  <input type="submit" value="Uložit" class="submit-save">';
        echo '</form>';
    }
    public function processFormData() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Získání dat z odeslaného formuláře
            $this->url = isset($_POST['url']) ? htmlspecialchars($_POST['url'], ENT_QUOTES, 'UTF-8') : '';
            $this->title = isset($_POST['title']) ? htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8') : '';
            $this->metaDescription = isset($_POST['meta_description']) ? htmlspecialchars($_POST['meta_description'], ENT_QUOTES, 'UTF-8') : '';


            // Kontrola platnosti URL
            if ($this->isValidUrl($this->url)) {
                if (!empty($this->title) && !empty($this->metaDescription)) {
                    $this->saveDataToDatabase();
                } else {
                    echo "Všechna pole formuláře musí být vyplněna.";
                }
            } else {
                echo "Zadána URL je neplatná.";
            }
            
        }
    }
    private function isValidUrl(string $url): bool
{
    // URL začíná https nebo www a může obsahovat lomítko
    $pattern = '/^(https:\/\/|www\.)[^\/]+(\/.*)?$/';

    return (bool)preg_match($pattern, $url);
}

    public function saveDataToDatabase() {
        $currentDateTime = date('Y-m-d H:i:s');

        // V thetable přidaný nový sloupec user_id
        $user_id=$_SESSION["id"];
        
        // Připravený dotaz
        $sql = "INSERT INTO thetable (user_id, url, title, meta_description, datetime_column) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        // Vazba parametrů
        $stmt->bind_param("issss", $user_id, $this->url, $this->title, $this->metaDescription, $currentDateTime);

        // Provedení dotazu
        if ($stmt->execute() === FALSE) {
            echo "Chyba při ukládání do databáze: " . $stmt->error;
        }

        // Uzavření připraveného dotazu
        $stmt->close();
    }

    public function displayProcessedData() {
        $sql = "SELECT * FROM thetable ORDER BY datetime_column DESC LIMIT 10";
        $result = $this->conn->query($sql);
        if ($result === FALSE) {
            echo "Chyba při provádění SQL dotazu: " . $this->conn->error;
        }

        if ($result->num_rows > 0) {
            // Vypsání tabulky
            echo '<table border="1" style="width: 100%;">';
            echo '<tr><th style="width: 180px">Date</th><th style="width: 400px">URL</th><th style="width: 400px">Title</th><th style="width: 800px">Meta Description</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td style="word-wrap: break-word;">' . $row["datetime_column"] . '</td>';
                echo '<td style="word-wrap: break-word;"><a href="' . $row["url"] . '" target="_blank" cursor="pointer">' . $row["url"] . '</a></td>';
                echo '<td style="word-wrap: break-word;">' . $row["title"] . '</td>';
                echo '<td style="word-wrap: break-word;">' . $row["meta_description"] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "Žádná data k zobrazení.";
        }
    }
}

?>