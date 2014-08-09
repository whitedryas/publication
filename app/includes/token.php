<?php

/**
 * 
 * @param type $nom : nom du formulaire associé
 * @return $token, crée aléatoirement
 */
function generer_token($nom = ''){
	session_start();
	$token = uniqid(rand(), true);
	$_SESSION[$nom.'_token'] = $token;
	$_SESSION[$nom.'_token_time'] = time();
	return $token;
}


//Cette fonction vérifie le token
//Vous passez en argument le temps de validité (en secondes)
//Le referer attendu 
//Le nom optionnel si vous en avez défini un lors de la création du token
function verifier_token($temps, $nom = ''){
    session_start();
    if(isset($_SESSION[$nom.'_token']) && isset($_SESSION[$nom.'_token_time']) && isset($_POST['token']))
            if($_SESSION[$nom.'_token'] ==  filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING));
                    if($_SESSION[$nom.'_token_time'] >= (time() - $temps))
//                            if($_SERVER['HTTP_REFERER'] == $referer)
                                    return true;
    return false;
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

