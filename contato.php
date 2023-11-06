<?php 
$mensagem = "Quase lá. Só mais um passo...";
$mensagem_class = "";
$nome = "";
$email = "";
$escolha = "";
$msg = "";

if (isset($_POST["nome"], $_POST["email"], $_POST["msg"])) {
    $conexao = new PDO("mysql:host=127.0.0.1;dbname=paper", "root","");

    $nome = filter_input(INPUT_POST, "nome", FILTER_UNSAFE_RAW);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $escolha = filter_input(INPUT_POST, "escolha", FILTER_SANITIZE_EMAIL);
    $msg = filter_input(INPUT_POST, "msg", FILTER_UNSAFE_RAW);

    if (!$nome || !$email || !$escolha) {
        $mensagem = "Algo deu errado. Confira seus dados";
        $mensagem_class = "erro";
    } else {
        $stm = $conexao->prepare('INSERT INTO contato (nome, email, escolha, msg) VALUES (:nome, :email, :escolha, :msg)');
        $stm->bindParam('nome', $nome);
        $stm->bindParam('email', $email);
        $stm->bindParam('escolha', $escolha);
        $stm->bindParam('msg', $msg);
        $stm->execute();


        $mensagem = "Tudo certo. Agora deixa com a gente";
        $mensagem_class = "sucesso";
        $nome = "";
        $email = "";
        $escolha = "";
        $msg = "";
    }
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
    <link rel="stylesheet" href="./css/style.css">

</head>
<body>
    <header class="header-bg">
        <div class="header container">
        <a href="./"><img src="./img/bikcraft.svg" alt="Bickreft"></a>

        <nav aria-label="primaria">
            <ul class="header-menu">
            <li><a href="./index.html">Home</a></li>
            <li><a href="./seguros.html">Seguros</a></li>
            <li><a href="contato.php">Contato</a></li>
            </ul>
        </nav>

        </div>
    </header>
    <main>
        <form method="POST" class="fadeInLeft" data-anime="800 ">
            <label>Seu nome</label>
            <input type="text" name="nome" value="<?= $nome ?>" required />
            <label>Email</label>
            <input type="email" name="email" value="<?= $email ?>" required />
            <label>Modelo</label>
            <select name="escolha" id="escolha" value="<?= $escolha ?>" required>
                <option value="Magic Might">magic might</option>
                <option value="Nimbus Stark">nimbus stark</option>
                <option value="Nebula Cosmic">nebula cosmic</option>
            </select>
            <label></label>
            <textarea name="msg" placeholder="Digite aqui se deseja fazer alguma alteração específica..."><?=$msg?></textarea>
            <button class="enviar-botao" type="submit" >PEÇA JÁ A SUA</button>
        </form>
        <div class="mensagem fadeInLeft<?= $mensagem_class ?>" data-anime="200">
            <?=$mensagem?>
        </div>
    </main>
    
    <footer class="footer-bg">
        <div class="footer container">
            <img src="././img/bikcraft.svg" alt="Bickreft">
            <div class="footer-contato">
                <h3>Contato</h3>
                <ul class="footer-conteudo">
                    <li><a href="tel:+5531982202631">31 98220-2631</a></li>
                    <li><a href="mailto:contato@Bickreft.com">contato@Bickreft.com</a></li>
                    <li>Rua Paulo Moreira Brandão, 186 - Copacabana</li>
                    <li>Ponte Nova - MG</li>
                </ul>
                <div class="footer-redes">
                    <a href="./"><img src="./img/redes/instagram.svg" alt="Rede social - instagram"></a>
                    <a href="./"><img src="./img/redes/facebook.svg" alt="Rede social - facebook.svg"></a>
                    <a href="./"><img src="./img/redes/youtube.svg" alt="Rede social - youtube"></a>
                </div>
            </div>
            <div class="footer-informacoes">
                <h3>Informações</h3>
                <nav>
                    <ul>

                        <li><a href="./seguros.html">Seguros</a></li>
                        <li><a href="./contato.html">Contato</a></li>
                        <li><a href="./termo.html">Termos e Condições</a></li>
                    </ul>
                </nav>
            </div>
            <p class="footer-copy">Bikcraft © Alguns direitos reservados.</p>
        </div>
    </footer>
    <script src="./js/plugins/simple-anime.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>