<?php

if($_GET['h']){

	$email=$_GET['h'];
    $_SESSION["msg"]='';

    echo $email;
    echo md5($email);
    // $usuario = new Usuario($mysql);
    // $linha = $usuario->encontrarPorEmail($h);

	// if($linha)
	// {
	// 	$idusuario = $linha["idusuario"];
    //     $usuario->alteraFlagStatus($idusuario);

	// 	if($usuario->retornaStatus($idusuario))
	// 	{
	// 		$_SESSION["msg"]= "Cadastro Validado - Entre com seu email e senha";
	// 	}
	// 	else
	// 	{
	// 		$_SESSION["msg"]= 'Problema na validação';
	// 	}	
	// }
	// else
	// {
	// 	$_SESSION["msg"]= 'Problema na validação';
	// }	
	
}