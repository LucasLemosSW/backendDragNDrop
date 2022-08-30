<?php
    include "controller/config.php"; // inclui o arquivo conecta.php
    include "classes/users.php";

    $usuarios = new Users($conexao);
    $pessoas=$usuarios->listarUsuarios();
?>

<!doctype html>
<html>
    <head>
        <title>Return JSON response from AJAX using jQuery and PHP</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <table id="userTable" border="1" >
                <thead>
                    <tr>
                        <th width="5%">S.no</th>
                        <th width="20%">Username</th>
                        <th width="20%">Name</th>
                        <th width="30%">Email</th>
                        <th width="30%">Senha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pessoas as $usuario) : ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['username']; ?></td>
                            <td><?php echo $usuario['name']; ?></td>
                            <td><?php echo $usuario['email']; ?></td>  
                            <td><?php echo $usuario['password']; ?></td> 
                        </tr>                          
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>