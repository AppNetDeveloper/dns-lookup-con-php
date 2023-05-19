<!DOCTYPE html>
<html>
<head>
    <title>Búsqueda de DNS Lookup</title>
</head>
<body>
    <h1>Búsqueda de DNS Lookup</h1>
    <form method="POST" action="">
        <label for="domain">Nombre de dominio:</label>
        <input type="text" id="domain" name="domain" required>
        <button type="submit">Buscar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $domain = $_POST['domain'];
        $records = dns_get_record($domain, DNS_ANY);

        if (!empty($records)) {
            echo "<h2>Registros DNS para el dominio $domain:</h2>";

            foreach ($records as $record) {
                echo "<p><strong>Host:</strong> " . $record['host'] . "</p>";
                echo "<p><strong>Clase:</strong> " . $record['class'] . "</p>";
                echo "<p><strong>TTL:</strong> " . $record['ttl'] . "</p>";
                echo "<p><strong>Tipo:</strong> " . $record['type'] . "</p>";

                if ($record['type'] === "HINFO") {
                    echo "<p><strong>CPU:</strong> " . $record['cpu'] . "</p>";
                    echo "<p><strong>Sistema Operativo:</strong> " . $record['os'] . "</p>";
                }

                echo "<hr>";
            }
        } else {
            echo "No se encontraron registros DNS para el dominio $domain.";
        }
    }
    ?>
</body>
</html>

