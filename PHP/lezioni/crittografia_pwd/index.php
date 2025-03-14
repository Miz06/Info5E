<?php
//hash è utilizzato per la crittografia di un dato; dal dato finale non posso tornare al dato iniziale
//con un cambiamento minimo del dato iniziale l'esito finale cambia completamente
//un dato iniziale da 50 caratteri o 10 caratteri risultauna stringa finale della stessa lunghezza
//la stringa finale ottenuta è la combinazione della password + il salt (aggiunto randomaticamente dal protocollo)

//password crittografata: $2y$10$kHHQYC8aiK.TNNWFuS8HV.4wxvT/1bwVSy1iXjVbXLz3aYNvVWHVW
//  OVVERO => PREFISSO DELL'ALGORITMO IN USO: $2y$10 + SALT: $kHHQYC8aiK.TNNWFuS8HV + DATO INIZIALE: .4wxvT/1bwVSy1iXjVbXLz3aYNvVWHVW
//  SALT = 22 CARATTERI

$userpassword='P'; //$_POST['pwd'];
$hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);

echo 'password iniziale: ' . $userpassword . '<br>';
echo 'password crittografata: ' . $hashedPassword . '<br>';

if(password_verify($userpassword, $hashedPassword)) //per effettuare la verifica viene utilizzata la password iniziale + la stringa finale
    echo 'corrispondenza positiva';
else
    echo 'corrispondenza negativa';

