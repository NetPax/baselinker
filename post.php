<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST["name"] ?? "";
	$email = $_POST["email"] ?? "";
	$consent = $_POST["consent"] ?? "";

	if (empty($name) || strlen($name) < 3 || strlen($name) > 70) {
		die("Błąd: Niepoprawne imię.");
	}

	if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		die("Błąd: Niepoprawny adres e-mail.");
	}

	if (empty($consent)) {
		die("Błąd: Wymagana zgoda marketingowa.");
	}

	$data = array(
		"name" => $name,
		"email" => $email,
		"consent" => ($consent) ? "tak" : "nie"
	);

	$jsonData = json_encode($data, JSON_PRETTY_PRINT);

	echo "<p>Imię: " . htmlspecialchars($name) . "</p>";
	echo "<p>Adres e-mail: " . htmlspecialchars($email) . "</p>";
	echo "<p>Zgoda marketingowa: " . ($consent ? "Tak" : "Nie") . "</p>";

	echo "<pre>" . htmlspecialchars($jsonData) . "</pre>";
} else {
	header("Location: index.html");
}
?>