<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte</title>
</head>
<body>
<h2>Abrir chamado!</h2>
<?php 
    if (isset($_POST['acao'])) {            
        $pergunta = $_POST['pergunta'];
        $email = $_POST['email'];
        $token = md5(uniqid());
        $sql = \MySql::conectar()->prepare("INSERT INTO chamados VALUES(null,?,?,?)");
        $sql->execute(array($pergunta,$email,$token ));
        // Enviar email dizendo que o chamado foi aberto
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.hostinger.com.br';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'contato@sitedan.com.br';                     // SMTP username
            $mail->Password   = '681015';                               // SMTP password
            $mail->SMTPSecure = 'tsl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('contato@sitedan.com.br', 'Danilo');
            $mail->addAddress($email, '');     // Add a recipient
                     

            // Content
            $mail->isHTML(true);  
            $mail->charSet = "UTF-8";                                // Set email format to HTML
            $mail->Subject = 'Seu chamado foi aberto!';
            $url = BASE.'chamado?token='.$token;    
            $informacoes = '
            Olá, seu chamado foi criado com sucesso!</br>Utilize o link abaixo para interagir:</br>
            <a href="'.$url.'">Acessar chamado!</a>';
            $mail->Body    = $informacoes;
            
            $mail->send();
            echo 'Mensagem enviada';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        echo '<script>alert("Seu chamado foi aberto com sucesso! Você receberá as informações no e-mail para interagir.")</script>';
    }
?>

<style>
    input,textarea{
        width:100%;
        margin: 5px 0;
    }
    textarea{
        height: 120px;
    }
</style>
<form action="" method="post">
    <input type="email" name="email" placeholder="Seu e-mail...">
    </br>
    <textarea name="pergunta" placeholder="Sua pergunta..."></textarea>
    </br>
    <input type="submit" name="acao" value="Enviar!">
</form> 
</body>
</html>


